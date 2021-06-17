<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Plan;
use App\Models\UserPlanCheering;
use App\Actions\PayPay\PayPay;
use App\Actions\PayJp\PayJp;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\User\PlanController;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JoinPlan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // パラメーターからplan id, project id, user address idを取得
        $plan = $request->route()->parameter('plan');
        $project = $request->route()->parameter('project');

        // payment画面からアクセスした確認
        $url = rtrim(url()->previous(), '/');
        $url = substr($url, strrpos($url, '/') + 1);

        // レスポンスの初期化
        $response = null;

        // paypayの処理の際に設定したセッションに値が入っているか確認
        if (session('merchant_payment_id') !== null) {
            // statusがCOMPLETEDなら支払い完了
            $response = PayPay::getPaymentDetail(session('merchant_payment_id'))['data']['status'];
        }
        // ユーザーがpayjpを利用した場合、トークンを持っているか確認
        if (isset($request['payjp-token']) && $request['payjp-token'] !== null) {
            // payjpの処理のレスポンスを取得
            $response = PayJp::payment($plan, $request);
        }
        // レスポンスがCOMPLETEDならユーザーをプランに参加させる処理を実行
        if ($response !== null && $response === "COMPLETED") {
            // ユーザーのプラン参加処理
            DB::beginTransaction();
            try {
                // options_tableの中から、プランに紐づいていてセッションのオプションタイトルと同じオプションの行をロックする。
                $option = $plan->options()
                    ->where('name', $request->session()->get('selected_option'))
                    ->where( function ($query) {
                        $query->whereNull('quantity')->orWhereNotIn('quantity', [0]);
                    })->lockForUpdate()->first();
                if (!is_null($option->quantity)) {
                    $option->quantity -= 1;
                }
                $option->save();

                $user_plan_cheering = new UserPlanCheering;
                $user_plan_cheering->user_id = Auth::id();
                $user_plan_cheering->address_id = $request->session()->get('user_address_id') ?: null;
                $user_plan_cheering->phone_number = $request->session()->get('phone_number');
                $user_plan_cheering->selected_option = $request->session()->get('selected_option');
                $plan->userPlanCheering()->save($user_plan_cheering);

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
                // こちらに決済キャンセルの処理を追加すればDBとの整合性が取れるかと思います。
                report($th);
                return back()->withErrors('エラーが発生しました。指定されたオプションは存在していないか、すでに売り切れてしまった可能性があります。');
            }
            // セッションの削除
            session()->forget('merchant_payment_id');
            session()->forget('user_address');
            session()->forget('phone_number');
            session()->forget('selected_option');
            return redirect()->action([PlanController::class, 'success'], ['project' => $project, 'plan' => $plan]);
        // ユーザーがpayment画面で支払い処理をせずに支援するボタンを押してしまった時、エラーをはく
        } elseif ($response === null && $url === 'payment') {
            return back()->withErrors('エラーが発生しました。入力内容の確認をお願いします。');
        }
        return $next($request);
    }
}
