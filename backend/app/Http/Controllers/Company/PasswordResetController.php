<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Models\Company;

class PasswordResetController extends Controller
{
    public function forgot()
    {
        return view('company.forgot_password');
    }

    public function reset($token)
    {
        return view('company.reset_password', ['token' => $token]);
    }

    public function update(PasswordRequest $request)
    {
        // Illuminate\Auth\Passwords\PasswordBrokerから継承している
        // resetメソッドが成功するとPassword::PASSWORD_RESETが返される

        $status = Password::broker('company')
                            ->reset($request->only('email', 'password', 'password_confirmation', 'token'),

            // パスワードを更新して、
            function ($company, $password) {
                // $company = Company::where('email', $company->email)->first();
                    $company->forceFill([
                        'password' => $password,
                    ])->save();

                    // Illuminate\Auth\Authenticatableの処理
                    // ユーザーのrememberTokenにinsertする
                    $company->setRememberToken(Str::random(60));

                    event(new PasswordReset($company));
            }
            // コールバック関数が成功するとPasswordBrokerでトークンを削除しています
        );

        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('company.login')->with('flash_message', __($status))
                    : back()->withErrors(['email' => __($status)]);
    }
}