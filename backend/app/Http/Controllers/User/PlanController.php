<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Project;
use App\Models\Address;
use App\Models\UserPlanCheering;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\UserAddressRequest;
use App\Actions\PayPay\PayPayInterface;
use App\Actions\PayJp\PayJpInterface;
use Illuminate\Foundation\Exceptions\Handler;
use App\Traits\UniqueToken;
use App\Rules\UserAddressLimit;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{

  protected $user;

  protected $address;

  protected $paypay;

  protected $payjp;

  public function __construct(Address $address, PayPayInterface $paypay_interface, PayJpInterface $payjp_interface)
  {
    $this->middleware(function ($request, $next) {
        $this->user = \Auth::user();
        return $next($request);
    });

    $this->address = $address;

    $this->paypay = $paypay_interface;

    $this->payjp = $payjp_interface;
  }

  public function show(Project $project, Plan $plan){
    return view('user.plan.show', ['project' => $project, 'plan' => $plan]);
  }

  public function address(Project $project, Plan $plan){
    return view('user.plan.address',
    [
        'project' => $project,
        'user' => $this->user,
        'default_addresses' => $this->user->userAddresses,
        'plan' => $plan->load(['options' => function ($query) {
            $query->whereNull('quantity')->orWhereNotIn('quantity', [0]);
        }])
    ]);
  }

  public function addressConfirm(UserAddressRequest $request, Project $project, Plan $plan)
  {
    if($request->settlement){
      if ($request->address_type === "other_address"){
        DB::beginTransaction();
          try {
            $this->user->userAddresses()->save(
              $this->address->fill($request->allForPrepared()));
              DB::commit();
          } catch (\Exception $e) {
            DB::rollback();
            return redirect()->action([PlanController::class, 'address'], ['project' => $project, 'plan' => $plan])
                              ->withErrors('住所登録に失敗しました。管理会社に連絡をお願いします。');
          }
      } elseif ($request->has('address_type')) {
          $this->address = $request->user()->userAddresses()->findOrFail($request->address_type);
      }
    } elseif ($request->delete) {
        $UserAddress = $request->user()->userAddresses()->findOrFail($request->address_type);
        $UserAddress->delete();
        return redirect()->action([PlanController::class, 'address'], ['project' => $project, 'plan' => $plan])->with('flash_message', '選択した住所を削除しました。');
    }

    try {
      $unique_token = UniqueToken::getToken();
      $result = $this->paypay->createQrCode($unique_token, $plan->price, $project, $plan);
    } catch (\Exception $e){
      throw $e;
    }

    if ($result['resultInfo']['code'] !== 'SUCCESS'){
      // 本番環境以外通知しない
      if (app()->environment('production')){
        \Slack::send('pay pay errors', 'code => '.$result['resultInfo']['code'].' : message => '.$result['resultInfo']['message'].' : codeId => '.$result['resultInfo']['codeId']);
        \Slack::send('user detail', 'id => '.$this->user->id.' : name => '.$this->user->name);
      }
      return redirect()->back()->withErrors('決済処理に関するエラーが発生しました。管理会社に連絡をお願いします。');
    } elseif ($result['resultInfo']['code'] === 'SUCCESS'){
      try {
        DB::beginTransaction();
          // options_tableの中から、プランに紐づいていてセッションのオプションタイトルと同じオプションの行をロックする。
          $option = $plan->options()
              ->where('name', $request->selected_option)
              ->where( function ($query) {
                  $query->whereNull('quantity')->orWhereNotIn('quantity', [0]);
              })->lockForUpdate()->first();

          if (!is_null($option->quantity)) {
              $option->quantity -= 1;
          }
          $option->save();

          UserPlanCheering::create([
            'user_id' => $this->user->id,
            'plan_id' => $plan->id,
            'address_id' => $this->address->id,
            'phone_number' => $request->phone_number,
            'message_status' => 'ステータスなし',
            'selected_option' => $request->select_option,
            'merchant_payment_id' => $unique_token,
            'payment_is_finished' => false
          ]);
        DB::commit();
      } catch (\Exception $e) {
        $this->paypay->deleteQRCode($result['data']['codeId']);
        DB::rollback();
        throw $e;
        return redirect()->back()->withErrors('購入情報の登録に失敗しました。管理会社に連絡をお願いします。');
    }
  }
  return view('user.plan.select_payment', ['project' => $project, 'plan' => $plan, 'qr_code' => $result, 'unique_token' => $unique_token]);
  }

  public function joinPlanForPayJp(Project $project, Plan $plan, Request $request, string $unique_token){

    // PayJpの例外処理
    try {
      $response = $this->payjp->Payment($plan->price, $request);
    } catch(\Payjp\Error\Card $e) {
        throw $e;
    } catch (\Payjp\Error\InvalidRequest $e) {
        // Invalid parameters were supplied to Payjp's API
        throw $e;
    } catch (\Payjp\Error\Authentication $e) {
        // Authentication with Payjp's API failed
        throw $e;
    } catch (\Payjp\Error\ApiConnection $e) {
        // Network communication with Payjp failed
        throw $e;
    } catch (\Payjp\Error\Base $e) {
        // Display a very generic error to the user, and maybe send
        // yourself an email
        throw $e;
    } catch(\Exception $e){
      // Something else happened, completely unrelated to Payjp
      throw $e;
    }

    // DBの例外処理
    DB::beginTransaction();
    try {
      $user_plan_cheering = UserPlanCheering::where('merchant_payment_id', $unique_token)->first();
      $user_plan_cheering->pay_jp_id = $response->id;
      $user_plan_cheering->payment_is_finished = true;
      $user_plan_cheering->save();
      DB::commit();
    } catch (\Exception $e){
      DB::rollback();
      // 払い戻し
      $this->payjp->Refund($response->id);
      throw $e;
    }
    return redirect()->action([PlanController::class, 'success'], ['project' => $project, 'plan' => $plan]);
  }

  public function joinPlanForPayPay(Project $project, Plan $plan, Request $request, string $unique_token)
  {
    // pay payの決済詳細を取得
    try {
      $detail = $this->paypay->getPaymentDetail($unique_token);
    } catch (\Exception $e){
      // payment detailの取得でエラーが起こったら支払いをキャンセル
      $result = $this->paypay->cancelPayment($unique_token);
      // 本番環境以外通知しない
      if (app()->environment('production')){
        \Slack::send('pay pay errors', 'code => '.$result['resultInfo']['code'].' : message => '.$result['resultInfo']['message'].' : codeId => '.$result['resultInfo']['codeId']);
        \Slack::send('user detail', 'id => '.$this->user->id.' : name => '.$this->user->name);
      }
      throw $e;
    }

    // DBへの保存処理
    DB::beginTransaction();
    try {
        $user_plan_cheering = UserPlanCheering::where('merchant_payment_id', $detail['data']['merchantPaymentId'])->first();
        $user_plan_cheering->payment_is_finished = true;
        $user_plan_cheering->save();
        DB::commit();
      } catch (\Exception $e) {
        DB::rollback();
        // DBへの保存に失敗したら支払いをキャンセル
        $result = $this->paypay->cancelPayment($unique_token);
        // 本番環境以外通知しない
        if (app()->environment('production')){
          \Slack::send('pay pay errors', 'code => '.$result['resultInfo']['code'].' : message => '.$result['resultInfo']['message'].' : codeId => '.$result['resultInfo']['codeId']);
          \Slack::send('user detail', 'id => '.$this->user->id.' : name => '.$this->user->name);
        }
        throw $e;
    }
    return redirect()->action([PlanController::class, 'success'], ['project' => $project, 'plan' => $plan]);
  }

  public function success(){
    return view('user.plan.success');
  }
}
