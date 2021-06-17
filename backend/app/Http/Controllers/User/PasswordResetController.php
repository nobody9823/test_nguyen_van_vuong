<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function forgot()
    {
        return view('user.forgot_password');
    }

    public function reset($token)
    {
        return view('user.password_reset', ['token' => $token]);
    }

    public function update(PasswordRequest $request)
    {
        // Illuminate\Auth\Passwords\PasswordBrokerから継承している
        // resetメソッドが成功するとPassword::PASSWORD_RESETが返される

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),

            // パスワードを更新して、
            function ($user, $password) {
                    $user->forceFill([
                        'password' => $password,
                    ])->save();

                    // Illuminate\Auth\Authenticatableの処理
                    // ユーザーのrememberTokenにinsertする
                    $user->setRememberToken(Str::random(60));

                    event(new PasswordReset($user));
            }
            // コールバック関数が成功するとPasswordBrokerでトークンを削除しています
        );

        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('flash_message', __($status))
                    : back()->withErrors(['email' => __($status)]);
    }
}