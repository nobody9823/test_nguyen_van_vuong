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
