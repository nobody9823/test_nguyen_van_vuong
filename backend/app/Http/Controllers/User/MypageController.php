<?php

namespace App\Http\Controllers\User;

use App\Actions\CardPayment\CardPaymentInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\BankAccountRequest;
use App\Http\Requests\UserProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\Comment;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\PlanPaymentIncluded;
use App\Models\Project;
use App\Models\UserProjectLiked;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Storage;
use App\Traits\UniqueToken;
use Log;

class MypageController extends Controller
{
    public function __construct(CardPaymentInterface $card_payment_interface)
    {
        $this->card_payment = $card_payment_interface;
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // 購入履歴
    public function paymentHistory()
    {
        $payments = Auth::user()->payments->load(['includedPlans', 'includedPlans.project'])->paginate(1);

        $project = $payments->first() !== null ? $payments->first()->includedPlans()->first()->project->getLoadIncludedPaymentsCountAndSumPrice() : null;
        // FIXME 画面ができたら適用
        return view('user.mypage.payment', [
            'payments' => $payments,
            'project' => $project
        ]);
    }

    // 投稿コメント一覧
    public function contributionComments()
    {
        $comments = Comment::getOwnComments()->orderBy('created_at', 'DESC')->get();
        return view('user.mypage.comment', [
            'comments' => $comments,
        ]);
    }

    // 応援購入したプロジェクト一覧
    public function purchasedProjects()
    {
        $projects = Project::whereIn(
            'id',
            Payment::select('project_id')->where('user_id', Auth::id())
        )->with(['projectFiles' => function ($query) {
            $query->where('file_content_type', 'image_url');
        }, 'tags'])->getWithPaymentsCountAndSumPrice()->paginate(1);
        return view('user.mypage.project', [
            'projects' => $projects,
        ]);
    }

    // お気に入りプロジェクト一覧
    public function likedProjects()
    {
        $user_liked = UserProjectLiked::where('user_id', Auth::id())->get();
        return view('user.mypage.liked_project', [
            'projects' => Auth::user()->likedProjects()->with(['projectFiles', 'tags', 'likedUsers'])->getWithPaymentsCountAndSumPrice()->paginate(12),
            'user_liked' => $user_liked,
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
            $user->saveAddress($request->all());
            $user->saveSnsLink($request->all());
            DB::commit();
            return redirect()->route('user.profile')->with('flash_message', 'プロフィール更新が成功しました。');
        } catch (Exception $e) {
            DB::rollBack();
            Log::alert($e->getMessage(), $e->getTrace());
            return redirect()->back()->withErrors("プロフィールの更新に失敗しました。管理者にお問い合わせください。");
        }
    }

    // 退会画面
    public function withdraw()
    {
        return view('user.mypage.withdraw');
    }

    public function deleteUser(User $user)
    {
        $user = User::find($user->id);
        return $user->delete()
            ? redirect('/')->with('flash_message', '退会が完了しました。またのご利用をお待ちしております。')
            : redirect()->back()->with('flash_message', '退会手続きに失敗しました。');
    }

    public function updateExternalAccount(Request $request)
    {
        $account = $this->card_payment->updateExternalAccount(Auth::user()->identification->connected_account_id, $request['bankToken']);
        // $file = $this->card_payment->createIdentityDocument(Auth::id());
        // $account = $this->card_payment->attachIdentityDocument($file['id'], Auth::user()->identification->connected_account_id);

        return $account;
    }

    public function editBankAccount()
    {
        return Auth::user()->identification->bank_id
            ? view(
                'user.mypage.bank_account',
                [
                    'bank_account' => $this->card_payment->getBankAccount(Auth::user()->identification->bank_id)
                ]
            )
            : view('user.mypage.bank_account', ['bank_account' => null]);
    }

    public function updateBankAccount(BankAccountRequest $request)
    {
        $response = $this->card_payment->registerBankAccount(
            Auth::user()->identification->bank_id ? 2 : 1,
            Auth::user()->identification->bank_id ?: UniqueToken::getToken(),
            $request->bank_code,
            $request->branch_code,
            $request->account_type,
            $request->account_number,
            $request->account_name,
        );

        if (!\Illuminate\Support\Arr::has($response->json(), 'Bank_ID')) {
            Log::alert($response->body());
            return redirect()->route('user.bank_account.edit')->withErrors('銀行口座の登録に失敗しました。入力内容をご確認ください。');
        }

        Auth::user()->identification->bank_id = $response['Bank_ID'];
        Auth::user()->identification->save();
        return redirect()->route('user.bank_account.edit')->with('flash_message', '銀行口座の登録が完了しました。');
    }

    public function commission()
    {
        return view('user.commission');
    }

    public function psTermsOfService()
    {
        return view('user.footer.ps_terms_of_service');
    }
    public function termsOfService()
    {
        return view('user.footer.terms_of_service');
    }
    public function privacyPolicy()
    {
        return view('user.footer.privacy_policy');
    }
    public function tradeLaw()
    {
        return view('user.footer.trade_law');
    }

    public function question()
    {
        return view('user.footer.question');
    }
}
