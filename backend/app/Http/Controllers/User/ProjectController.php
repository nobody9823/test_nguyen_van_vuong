<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\Plan\CalculationForPrice;
use App\Traits\UniqueToken;
use App\Models\Tag;
use App\Models\User;
use App\Models\Project;
use App\Models\Plan;
use App\Models\Payment;
use App\Models\Comment;
use App\Models\Profile;
use App\Models\Address;
use Carbon\Carbon;
use App\Actions\PayJp\PayJpInterface;
use App\Actions\PayPay\PayPayInterface;
use App\Http\Requests\ConfirmPaymentRequest;
use App\Http\Requests\ConsultProjectSendRequest;
use App\Mail\User\ConsultProject;
use App\Models\ProjectTagTagging;
use App\Models\UserProjectLiked;
use Exception;
use App\Notifications\PaymentNotification;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Str;
use Log;
use Mail;

class ProjectController extends Controller
{

    public function __construct(PayJpInterface $pay_jp_interface, PayPayInterface $pay_pay_interface, Payment $payment, Comment $comment, Plan $plan)
    {
        $this->middleware(function ($request, $next) {
            $this->user = \Auth::user();
            return $next($request);
        });
        $this->pay_jp = $pay_jp_interface;

        $this->pay_pay = $pay_pay_interface;

        $this->payment = $payment;

        $this->comment = $comment;

        $this->plan = $plan;

        $this->inviter_code = null;
    }

    public function index()
    {
        $tags = Tag::all();
        $user_liked = UserProjectLiked::where('user_id', Auth::id())->get();
        $projects = Project::getReleasedProject()->seeking()->getWithPaymentsCountAndSumPrice()
        ->inRandomOrder()->take(5)->get();

        // ランキング(支援総額順)
        $ranking_projects = Project::getReleasedProject()->seeking()->getWithPaymentsCountAndSumPrice()->sortedByPaymentsSumPrice()->skip(1)->take(5);

        // 応援プロジェクト（目標金額の高い順）
        // $cheer_projects = Project::getReleasedProject()->seeking()->orderBy('target_amount', 'DESC')
        //     ->inRandomOrder()->get();

        // 応援プロジェクト（目標金額の高い順）
        // $cheer_projects = Project::getReleasedProject()->seeking()->orderBy('target_amount', 'DESC')
        //     ->inRandomOrder()->get();

        // 最新のプロジェクト
        // $new_projects = Project::getReleasedProject()->seeking()->orderBy('created_at', 'DESC')
        //     ->get();

        // 人気のプロジェクト
        // $popularity_projects = Project::getReleasedProject()->seeking()->ordeyByLikedUsers()
        //     ->get();

        // 募集終了が近いプロジェクト
        // $nearly_deadline_projects = Project::getReleasedProject()->seeking()->orderByNearlyDeadline()
        //     ->inRandomOrder()->get();

        // もうすぐ公開のプロジェクト
        // $nearly_open_projects = Project::getReleasedProject()->orderByNearlyOpen()
        //     ->inRandomOrder()->get();

        return view('user.index', compact(
            // 'new_projects',
            // 'cheer_projects',
            // 'popularity_projects',
            // 'nearly_deadline_projects',
            // 'nearly_open_projects',
            'ranking_projects',
            'tags',
            'user_liked',
            'projects'
        ));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Request $request, Project $project)
    {
        if ($request->inviter) {
            try {
                $this->inviter_code = Crypt::decrypt($request->inviter);
            } catch (DecryptException $e) {
                Log::alert($e->getMessage(), $e->getTrace());
                return redirect()->route('user.index')->withErrors('読み込みに失敗しました。管理者にお問い合わせください。');
            }
        }

        $project = $project::where('projects.id',$project->id)->getWithPaymentsCountAndSumPrice()->first();

        return view('user.project.show', [
            'inviter_code' => $this->inviter_code,
            'project' => $project,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Select a plans
     *
     * @param Project
     * @return \Illuminate\Http\Response
     */
    public function selectPlans(Request $request, Project $project, Plan $plan)
    {
        return view('user.project.select_plan',
            [
                'project' => $project,
                'inviter_code' => $request->inviter_code,
                'user' => $this->user,
                'plans' => $plan->id !== null ? $plan : $project->plans
            ]);
    }

    /**
     * Confirm selected plans
     *
     * @param Project
     * @return \Illuminate\Http\Response
     */
    public function confirmPayment(Project $project, ConfirmPaymentRequest $request)
    {
        DB::beginTransaction();
        try {
            $plans = $this->plan->getPlansByIds(array_keys($request->plans))->get();
            $this->user->saveProfile($request->except(['inviter_code']));
            $this->user->saveAddress($request->all());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        Auth::user()->load(['profile', 'address']);
        return view('user.project.confirm_plan', ['project' => $project, 'plans' => $plans,'validated_request' => $request->all()]);
    }

    /**
     * prepare for Payment
     * @param App\Models\Project
     * @param Illuminate\Http\Request
     */
    public function prepareForPayment(Project $project, Request $request)
    {
        $validated_request = $request->validated_request;
        $unique_token = UniqueToken::getToken();
        $this->user->load(['profile', 'address']);
        $inviter = !empty($validated_request['inviter_code']) ? User::getInviterFromInviterCode($validated_request['inviter_code'])->first() : null;
        DB::beginTransaction();
        try {
            $plans = $this->plan->lockForUpdatePlansByIds(array_keys($validated_request['plans']))->get();
            $payment = $this->payment->fill(array_merge(
                [
                    'inviter_id' => !empty($validated_request['inviter_code']) ? $inviter->id : null,
                    'price' => $validated_request['total_amount'],
                    'message_status' => "ステータスなし",
                    'merchant_payment_id' => $unique_token,
                    'pay_jp_id' => !empty($validated_request['payjp_token']) ? $validated_request['payjp_token'] : null,
                    'payment_is_finished' => false
                ], $request->all()
            ));
            $this->user->payments()->save($payment)
                ->each(function($payment) use ($project, $validated_request){
                    $payment->includedPlansByArrayPlan($validated_request['plans']);
                    if (!empty($validated_request['comments'])){
                        $comment = $this->comment->fill(['project_id' =>  $project->id, 'content' => $validated_request['comments']]);
                        $payment->comment()->save($comment);
                    }
                });
            $this->plan->updatePlansByIds($plans, $validated_request['plans']);
            $qr_code = $this->pay_pay->createQrCode($unique_token, $validated_request['total_amount'], $project, $payment);
            DB::commit();
        } catch (\Exception $e){
            DB::rollback();
            throw $e;
        }

        if ($validated_request['payment_way'] === 'credit'){
            return redirect()->action([ProjectController::class, 'paymentForPayJp'], ['project' => $project, 'payment' => $payment]);
        } else if ($validated_request['payment_way'] === 'paypay'){
            return redirect()->away($qr_code['data']['url']);
        }
    }

    /**
     * do payment for Pay Jp
     *
     *@param App\Models\Project
     *@param App\Models\Payment
     *
     *@return \Illuminate\Http\Response
     */
    public function paymentForPayJp(Project $project, Payment $payment)
    {
        $response = $this->pay_jp->Payment($payment->price, $payment->pay_jp_id);
        DB::beginTransaction();
        try {
                $payment->payment_is_finished = true;
                $payment->save();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                $this->pay_jp->Refund($response->id);
                throw $e;
            }
            $this->user->notify(new PaymentNotification($project, $payment));
            
            $project = $project::where('projects.id',$project->id)->getWithPaymentsCountAndSumPrice()->first();
        return view('user.plan.supported', ['project' => $project, 'payment' => $payment]);
    }

    public function paymentForPayPay(Project $project, Payment $payment)
    {
        $response = $this->pay_pay->getPaymentDetail($payment->merchant_payment_id);

        if($response['data']['status'] === 'COMPLETED'){
            $payment_id = $response['data']['merchantPaymentId'];
        } else {
            return redirect()->action([ProjectController::class, 'selectPlans'], ['project' => $project])->withError('決済処理に失敗しました。管理会社に連絡をお願いします。');
        }

        DB::beginTransaction();
        try {
            $payment = Payment::where('merchant_payment_id', $payment_id)->first();
            $payment->payment_is_finished = true;
            $payment->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $this->pay_pay->cancelPayment($payment_id);
            throw $e;
        }
        $this->user->notify(new PaymentNotification($project, $payment));
        $supporter_count = User::getCountOfSupportersWithProject($project);
        $total_amount = Payment::getTotalAmountOfSupporterWithProject($project);
        return view('user.plan.supported', ['project' => $project, 'payment' => $payment, 'supporter_count' => $supporter_count, 'total_amount' => $total_amount]);
    }

    /**
     * Display a project list page searched from any parameter.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $projectsQuery = Project::query();
        if($request->tag_id){
            $tags = Tag::pluck("name", "id");
        } else {
            $tags = null;
        }

        //カテゴリ絞り込み
        if ($request->tag_id) {
            $projectsQuery->whereIn('id',
                ProjectTagTagging::query()->select('project_id')
                ->whereIn('tag_id',
                    Tag::query()->select('id')
                    ->find($request->tag_id)
                )
            );
        }
        // こちらはデザインにはなかったのでコメントアウト致しました。
        // //フリーワード絞り込み
        // if ($request->free_word) {
        //     // 全角スペースを半角スペースに変換
        //     $words = str_replace("　", " ", $request->free_word);
        //     // 半角スペースごとに区切って配列に代入
        //     $array_words = explode(" ", $words);
        //     //この部分今のところタイトルと説明文でしか検索できてないです...アイドル名がなぜかうまくいかなかったのでまたやります...
        //     foreach ($array_words as $array_word) {
        //         $projectsQuery->where(function ($projectsQuery) use ($array_word) {
        //             $projectsQuery->Where('projects.title', 'like', "%$array_word%")
        //                 ->orWhere('explanation', 'like', "%$array_word%")
        //                 ->orWhereIn('talent_id', Talent::select('id')
        //                 ->where('name', 'like', "%$array_word%"));
        //         });
        //     }
        // }
        // sort_typeによって順序変更
        // 0 => 人気順(募集中のお気に入り数順),   1 => 新着順,   2 => 終了日が近い順,   3 => 支援総額順,   4 => 支援者数順
        switch ($request->sort_type) {
            case '0':
                $projectsQuery->seeking()->ordeyByLikedUsers();
                break;

            case '1':
                $projectsQuery->seeking()->orderBy('created_at', 'DESC');
                break;

            case '2':
                if(strstr($request->fullUrl(), '/search?sort_type=2')){
                    // ヘッダーメニューの「募集終了が近いプロジェクトの場合」(現在掲載中且つ、残り1週間で終了)
                    $projectsQuery->daysLeftSeeking('end_date')->orderByNearlyDeadline();
                } else {
                    // 検索画面の「並び替え」にある「終了日が近い順」(現在掲載中のもの)
                    $projectsQuery->seeking()->orderByNearlyDeadline();
                }
                break;

            case '3':
                $projectsQuery->ordeyByFundingAmount();
                break;

            case '4':
                $projectsQuery->ordeyByNumberOfSupporters();
                break;
        }

        //募集中かどうか確認
        switch ($request->holding_check) {
            // 公開前
            case '0':
                if (strstr($request->fullUrl(), '/search?holding_check=0')) {
                    // ユーザーヘッダーメニューの「もうすぐ公開されます」(1週間以内に公開)
                    $projectsQuery->beforeSeeking()->daysLeftSeeking('start_date');
                } else {
                    // 検索画面の「募集状況」にある「公開日前」
                    $projectsQuery->beforeSeeking();
                }
                break;
            // 支援募集中
            case '1':
                $projectsQuery->seeking();
                break;
            // 募集終了
            case '2':
                $projectsQuery->afterSeeking();
                break;
        }

        // こちらもお気に入りプロジェクト検索はデザインにはないのでコメントアウト
        // // ユーザーのログイン機能追加必須？
        // if ($request->cheered_check) {
        //     $projectsQuery->OnlyCheeringDisplay();
        // }

        $projects = $projectsQuery->where('release_status', '掲載中')->with('tags')->paginate(9);

        return view('user.search', compact('projects', 'tags'));
    }

    public function consultProject()
    {
        return view('user.consult_project');
    }

    public function consultProjectSend(ConsultProjectSendRequest $request)
    {
        DB::beginTransaction();
        try {
            Auth::user()->saveProfile($request->all());
            Auth::user()->saveAddress($request->all());
            // NOTICE ここは通知用は送信専用のメールアドレスにして受信用と分けるかどうか要確認
            Mail::to(config('mail.customer_support.address'))->send(new ConsultProject($request->all()));
            DB::commit();
            return redirect()->route('user.profile')->with('flash_message', 'プロジェクトの掲載申請が完了いたしました。');
        } catch(Exception $e) {
            DB::rollBack();
            // NOTICE Slackにログを送信できるみたいなので今後時間があったら実装してみても良いかもしれないです。
            Log::error($e->getMessage(), $e->getTrace());
            return redirect()->route('user.consult_project')->withErrors("プロジェクト掲載申請に失敗しました。管理者にお問い合わせください。");
        }
    }

    public function ProjectLiked(Request $request)
    {
        $userLiked = UserProjectLiked::where('user_id', Auth::id())->where('project_id', $request->project_id)->first();

        if (Auth::id() === null) {
            return $result = "未ログイン";
        } elseif ($userLiked !== null) {
            $userLiked->delete();
            return $result = "削除";
        } else {
            $project_liked = new UserProjectLiked(['user_id' => Auth::id()]);
            $project_liked->project_id = $request->project_id;
            $project_liked->save();
            return $result = "登録";
        }
    }

    public function support(Project $project)
    {
        $this->authorize('checkIsFinishedPayment', $project);
        $encrypted_code = Crypt::encrypt(Auth::user()->profile->inviter_code);
        $invitation_url = route('user.project.show', ['project' => $project, 'inviter' => $encrypted_code]);
        Auth::user()->supportedProjects()->attach($project->id);

        return view('user.project.support', ['invitation_url' => $invitation_url]);
    }
}
