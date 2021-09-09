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
use App\Models\PaymentToken;
use App\Models\Comment;
use App\Models\Profile;
use App\Models\Address;
use Carbon\Carbon;
use App\Actions\CardPayment\CardPaymentInterface;
use App\Actions\PayPay\PayPayInterface;
use App\Http\Requests\ConfirmPaymentRequest;
use App\Http\Requests\ConsultProjectSendRequest;
use App\Mail\User\ConsultProject;
use App\Models\PlanPaymentIncluded;
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
    public function __construct(CardPaymentInterface $card_payment_interface, PayPayInterface $pay_pay_interface, Payment $payment, Comment $comment, Plan $plan)
    {
        $this->middleware(function ($request, $next) {
            $this->user = \Auth::user();
            return $next($request);
        });
        $this->card_payment = $card_payment_interface;

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
        // TOP画面の一番上(ランダム)
        $projects = Project::mainProjects()->inRandomOrder()->take(5)->get();

        // ランキング(支援総額順)
        $ranking_projects = Project::mainProjects()->orderBy('payments_sum_price', 'DESC')->take(5)->get();

        // 最新のプロジェクト
        $new_projects = Project::mainProjects()->orderBy('start_date', 'DESC')->take(6)->get();

        // 掲載終了プロジェクト
        $complete_projects = Project::CompletedProjects()->orderBy('end_date', 'ASC')->get();

        // 応援プロジェクト（目標金額の高い順）
        // $cheer_projects = Project::getReleasedProject()->seeking()->orderBy('target_amount', 'DESC')
        //     ->inRandomOrder()->get();

        // 応援プロジェクト（目標金額の高い順）
        // $cheer_projects = Project::getReleasedProject()->seeking()->orderBy('target_amount', 'DESC')
        //     ->inRandomOrder()->get();

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
            // 'cheer_projects',
            // 'popularity_projects',
            // 'nearly_deadline_projects',
            // 'nearly_open_projects',
            'tags',
            'user_liked',
            'projects',
            'ranking_projects',
            'new_projects',
            'complete_projects'
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

        return view('user.project.show', [
            'inviter_code' => $this->inviter_code,
            'project' => $project->getLoadIncludedPaymentsCountAndSumPrice()->loadOtherRelations(),
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
        return view(
            'user.project.select_plan',
            [
                'project' => $project,
                'inviter_code' => $request->inviter_code,
                'user' => $this->user,
                'plans' => $plan->id !== null ? $plan : $project->plans
            ]
        );
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
        return view('user.project.confirm_plan', ['project' => $project, 'plans' => $plans->loadCount('includedPayments'), 'validated_request' => $request->all()]);
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
                    'project_id' => $project->id,
                    'inviter_id' => !empty($validated_request['inviter_code']) && !empty($inviter) ? $inviter->id : null,
                    'price' => $validated_request['total_amount'],
                    'message_status' => "ステータスなし",
                    'payment_way' => !empty($validated_request['payment_method_id']) ? $this->card_payment->getPaymentApiName() : 'PayPay',
                    'payment_is_finished' => false
                ],
                $request->all()
            ));
            $this->user->payments()->save($payment);
            $payment->includedPlans()->attach($validated_request['plans']);
            if (!empty($validated_request['comments'])) {
                $comment = $this->comment->fill(['project_id' =>  $project->id, 'content' => $validated_request['comments']]);
                $this->user->comments()->save($comment);
            }
            $this->plan->updatePlansByIds($plans, $validated_request['plans']);
            $qr_code = $this->pay_pay->createQrCode($unique_token, $validated_request['total_amount'], $project, $payment);
            $payment->paymentToken()->save(PaymentToken::make([
                'token' => !empty($validated_request['payment_method_id']) ? $validated_request['payment_method_id'] : $unique_token,
            ]));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        if ($validated_request['payment_way'] === 'credit') {
            return redirect()->action([ProjectController::class, 'paymentForCredit'], ['project' => $project, 'payment' => $payment]);
        } elseif ($validated_request['payment_way'] === 'paypay') {
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
    public function paymentForCredit(Project $project, Payment $payment)
    {
        $response = $this->card_payment->charge($payment->price, $payment->paymentToken->token);
        DB::beginTransaction();
        try {
            $payment->payment_is_finished = true;
            $payment->paymentToken->token = $response->id;
            $payment->save();
            $payment->paymentToken->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $this->card_payment->refund($response->id);
            throw $e;
        }
        $this->user->notify(new PaymentNotification($project, $payment));

        return view('user.plan.supported', ['project' => $project->getLoadIncludedPaymentsCountAndSumPrice(), 'payment' => $payment]);
    }

    public function paymentForPayPay(Project $project, Payment $payment)
    {
        $response = $this->pay_pay->getPaymentDetail($payment->paymentToken->token);

        if ($response['data']['status'] !== 'COMPLETED') {
            return redirect()->action([ProjectController::class, 'selectPlans'], ['project' => $project])->withError('決済処理に失敗しました。管理会社に連絡をお願いします。');
        }

        DB::beginTransaction();
        try {
            $payment->payment_is_finished = true;
            $payment->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $this->pay_pay->cancelPayment($response['data']['merchantPaymentId']);
            throw $e;
        }
        $this->user->notify(new PaymentNotification($project, $payment));

        return view('user.plan.supported', ['project' => $project->getLoadIncludedPaymentsCountAndSumPrice(), 'payment' => $payment]);
    }

    /**
     * Display a project list page searched from any parameter.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $projectsQuery = Project::query();
        if ($request->tag_id) {
            $tags = Tag::pluck("name", "id");
        } else {
            $tags = null;
        }
        $user_liked = UserProjectLiked::where('user_id', Auth::id())->get();

        //カテゴリ絞り込み
        if ($request->tag_id && $request->tag_id !== 'undefined') {
            $projectsQuery->whereIn(
                'id',
                ProjectTagTagging::query()->select('project_id')
                    ->whereIn(
                        'tag_id',
                        Tag::query()->select('id')
                            ->find($request->tag_id)
                    )
            );
        }

        // ワード検索
        $projectsQuery->search($role = "user");
        // sort_typeによって順序変更
        // 0 => 人気順(募集中のお気に入り数順),   1 => 新着順,   2 => 終了日が近い順,   3 => 支援総額順,   4 => 支援者数順
        switch ($request->sort_type) {
            case '0':
                $projectsQuery->seeking()->ordeyByLikedUsers();
                break;

            case '1':
                $projectsQuery->seekingWithAfterSeeking()->orderBy('start_date', 'DESC');
                break;

            case '2':
                // if (strstr($request->fullUrl(), '/search?sort_type=2')) {
                //     // ヘッダーメニューの「募集終了が近いプロジェクトの場合」(現在掲載中且つ、残り1週間で終了)
                //     $projectsQuery->daysLeftSeeking('end_date')->orderByNearlyDeadline();
                // } else {
                // 検索画面の「並び替え」にある「終了日が近い順」(現在掲載中のもの)
                $projectsQuery->seeking()->orderByNearlyDeadline();
                // }
                break;

            case '3':
                $projectsQuery->seekingWithAfterSeeking()->orderBy('payments_sum_price', 'DESC');
                break;

            case '4':
                $projectsQuery->seekingWithAfterSeeking()->orderBy('payments_count', 'DESC');
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

        $projects = $projectsQuery->GetReleasedProject()->with('tags')->getWithPaymentsCountAndSumPrice()->paginate(12);

        return view('user.project.search', compact('projects', 'tags', 'user_liked'));
    }

    public function ProjectLiked(Request $request)
    {
        $project = Project::where('id', $request->project_id)->first();
        $exist_liked = UserProjectLiked::where('project_id', $request->project_id)->where('user_id', Auth::id())->exists();

        if (!Auth::id()) {
            return "未ログイン";
        } elseif ($exist_liked) {
            $project->likedUsers()->detach(Auth::id());
            return "削除";
        } else {
            $project->likedUsers()->attach(Auth::id());
            return "登録";
        }
    }

    public function support(Project $project)
    {
        $this->authorize('checkIsFinishedPayment', $project);
        Auth::user()->supportedProjects()->attach($project->id);

        return view('user.project.support', ['project' => $project->getLoadIncludedPaymentsCountAndSumPrice()]);
    }

    public function supporterRanking(Project $project)
    {
        $this->authorize('checkIsFinishedPayment', $project);
        $users_ranked_by_total_quantity = User::getInvitersRankedByInvitedUsers($project->id)->take(100)->get();
        $users_ranked_by_total_amount = User::getInvitersRankedByInvitedTotalAmount($project->id)->take(100)->get();
        return view(
            'user.project.supporter_ranking',
            [
                'users_ranked_by_total_quantity' => $users_ranked_by_total_quantity,
                'users_ranked_by_total_amount' => $users_ranked_by_total_amount,
                'project' => $project->getLoadIncludedPaymentsCountAndSumPrice(),
            ],
        );
    }
}
