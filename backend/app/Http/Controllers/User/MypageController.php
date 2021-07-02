<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPasswordRequest;
use App\Http\Requests\UserProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\PlanPaymentIncluded;
use App\Models\Project;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Log;

class MypageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // 購入履歴
    public function paymentHistory()
    {
        $payments = Auth::user()->payments->load(['includedPlans', 'includedPlans.project']);

        dd($payments);
        // FIXME 画面ができたら適用
        // return view('user.mypage.payment', [
        //     'payments' => $payments,
        // ]);
    }

    // 投稿コメント一覧
    public function contributionComments()
    {
        $comments = Auth::user()->comments->load(['project.plans', 'reply.user']);
        return view('user.mypage.comment', [
            'comments' => $comments,
        ]);
    }

    // 応援購入したプロジェクト一覧
    public function purchasedProjects()
    {
        $projects = Project::whereIn(
            'id',
            Plan::query()->select('project_id')->whereIn(
                'id',
                PlanPaymentIncluded::query()->select('plan_id')->whereIn(
                    'payment_id',
                    Payment::query()->select('id')->where('user_id', Auth::id())
                )
            )
        )->with(['projectFiles', 'tags', 'likedUsers'])->get();
        return view('user.mypage.project', [
            'projects' => $projects,
        ]);
    }

    // お気に入りプロジェクト一覧
    public function likedProjects()
    {
        return view('user.mypage.project', [
            'projects' => Auth::user()->likedProjects->load(['projectFiles', 'tags', 'likedUsers'])
        ]);
    }

    // プロフィール一覧,編集画面
    public function profile()
    {
        return view('user.mypage.profile', ['user' => Auth::user()->load('profile')]);
    }

    // プロフィール更新処理
    public function updateProfile(UserProfileRequest $request, User $user)
    {
        DB::beginTransaction();
        try {
            $user->fill($request->all())->save();
            $user->saveProfile($request->all());
            DB::commit();
            return redirect()->route('user.profile')->with('flash_message', 'プロフィール更新が成功しました。');
        } catch(Exception $e) {
            DB::rollBack();
            Log::alert($e->getMessage(), $e->getTrace());
            return redirect()->back()->withErrors("プロフィールの更新に失敗しました。管理者にお問い合わせください。");
        }
    }

    public function forgotPassword()
    {
        return view('user.forgot_password');
    }

    // FIXME パスワードを忘れた方はこちらからの処理未実装
    public function sendResetPasswordMail()
    {
    }

    // 退会画面
    public function withdraw()
    {
        return view('user.mypage.withdraw');
    }

    public function delete_user(User $user)
    {
        $user = User::find($user->id);
        return $user->delete()
            ? redirect('/')->with('flash_message', '退会が完了しました。またのご利用をお待ちしております。')
            : redirect()->back()->with('flash_message', '退会手続きに失敗しました。');
    }

    public function commission()
    {
        return view('user.commission');
    }
}
