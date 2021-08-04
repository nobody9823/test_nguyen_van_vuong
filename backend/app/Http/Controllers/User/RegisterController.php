<?php

namespace App\Http\Controllers\User;

use App\Mail\User\EmailVerification as UserEmailVerification;
use App\Models\EmailVerification;
use App\Models\User;
use App\Models\Profile;
use App\Models\Address;
use App\Models\SnsLink;
use App\Models\Identification;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Contracts\RegisterResponse;
use Laravel\Fortify\Contracts\RegisterViewResponse;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

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
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
     * @return void
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    protected function email_validator(array $data)
    {
        return Validator::make($data, [
            // 'email' => 'required|string|email||unique:users,email',
            'email' => ['required', 'string', 'email', 'confirmed', 'max:255', Rule::unique('users')->whereNull('deleted_at')],
            'email_confirmation' => ['required', 'string']
        ]);
    }

    protected function create_validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string',
        ]);
    }

    public function preCreate()
    {
        return view('user.auth.pre_register');
    }

    public function preRegister(Request $request)
    {
        $validator = $this->email_validator($request->all());
        if ($validator->fails()) {
            return redirect('pre_create')
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
                return view('user.auth.pre_register')
                    ->with([
                        'email' => $request->email,
                        'error' => 'メールアドレスの登録に失敗しました。',
                    ]);
            }
            Mail::to($request->email)->send(new UserEmailVerification($emailVerification));

            return view('user.auth.pre_registered');
        }
    }

    public function create($token)
    {
        // 有効なtokenか確認する
        $emailVerification = EmailVerification::findByToken($token)
                                ->tokenIsVerified()->first();
        if (empty($emailVerification) || $emailVerification->isRegister()) {
            return view('user.auth.pre_register')->with('error', '有効期限が切れているか、無効なアクセスです。もう一度お試しください。');
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
            return view('user.auth.pre_register')
                ->with(['message' => 'メールアドレスの認証に失敗しました。管理者にお問い合わせください。']);
        }
        return view('user.auth.register')
            ->with(['token' => $emailVerification->token]);
    }

    protected function store(Request $request, $token)
    {
        $validator = $this->create_validator($request->all());

        if ($validator->fails()) {
            return redirect()
                ->route('user.create', ['token' => $token])
                ->withErrors($validator)
                ->withInput();
        } else {
            DB::beginTransaction();
            try {
                $emailVerification = EmailVerification::findByToken($token)
                                        ->tokenIsVerified()->first();
                $user = User::create([
                    'name' => $request->name,
                    'email' => $emailVerification->email,
                    'password' => $request->password,
                    'email_verified_at' => Carbon::now(),
                ]);
                $user->profile()->save(Profile::initialize());
                $user->address()->save(Address::initialize());
                $user->snsLink()->save(SnsLink::initialize());
                $user->identification()->save(Identification::initialize());
                $emailVerification->register();
                $emailVerification->update();
                DB::commit();
            } catch(\Throwable $e){
                DB::rollback();
                return redirect()->action([RegisterController::class, 'create'], ['token' => $token])->withErrors("登録に失敗しました。もう一度入力してください。");
            }
                Auth::login($user);
                return redirect()->intended(RouteServiceProvider::HOME)->with('flash_message', 'FanReturnへの登録が完了致しました。');
        }
    }
}
