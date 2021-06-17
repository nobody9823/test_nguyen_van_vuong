<?php

namespace App\Http\Controllers\Talent;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Mail\Talent\EmailVerification as TalentEmailVerification;
use App\Mail\Talent\RegisterFinished;
use App\Models\EmailVerification;
use App\Models\TemporaryTalent;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard
     * @return void
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * Show the registration view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\RegisterViewResponse
     */
    protected function email_validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|unique:talents,email',
        ]);
    }

    public function preCreate()
    {
        return view('talent.pre_register');
    }

    public function preRegister(Request $request)
    {
        $validator = $this->email_validator($request->all());
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $emailVerification = EmailVerification::build($request->email);
            DB::beginTransaction();
            try {
                $emailVerification->saveOrFail();
                DB::commit();
            } catch (\Throwable $e) {
                DB::rollBack();
                Log::warning("メールアドレス変更処理に失敗しました。 {$e->getMessage()}", $e->getTrace());
                return redirect()
                    ->route('talent.pre_create')
                    ->withErrors([
                        'error' => 'メールアドレスの登録に失敗しました。管理者にお問い合わせください。',
                    ]);
            }
            Mail::to($request->email)->send(new TalentEmailVerification($emailVerification));

            return view('talent.pre_registered');
        }
    }

    public function create($token)
    {
        // 有効なtokenか確認する
        $emailVerification = EmailVerification::findByToken($token)
                                ->tokenIsVerified()->first();
        if (empty($emailVerification) || $emailVerification->isRegister()) {
            return redirect()
                ->route('talent.pre_create')->withErrors('有効期限が切れているか、無効なアクセスです。もう一度お試しください。');
        }

        // ステータスをメール認証済みに変更する
        $emailVerification->mailVerify();

        DB::beginTransaction();
        try {
            // DB更新
            $emailVerification->update();
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::warning("メールアドレスの認証に失敗しました: email: {$emailVerification->email}", $e->getTrace());
            return redirect()
                ->route('talent.pre_create')->withErrors('メールアドレスの認証に失敗しました。管理者にお問い合わせください。');
        }
        return view('talent.register')
            ->with(['token' => $emailVerification->token]);
    }

    protected function store(RegisterRequest $request, $token)
    {
        DB::beginTransaction();
        try {
            $emailVerification = EmailVerification::findByToken($token)
                                    ->tokenIsVerified()->first();

            $temporary_talent = new TemporaryTalent();
            $temporary_talent->storeAction($request, $emailVerification);
            $emailVerification->register();
            $emailVerification->update();
            Mail::to($emailVerification->email)->send(new RegisterFinished);
            DB::commit();
            return redirect()->route('talent.register_finished');
        } catch (\Throwable $e) {
            DB::rollback();
            Log::warning("本登録申請に失敗しました: token: {$token}", $e->getTrace());
            return redirect()
                ->route('talent.pre_create')->withErrors('本登録申請に失敗しました。管理者にお問い合わせください。');
        }
    }

    public function registerFinished()
    {
        return view('talent.register_finished');
    }
}
