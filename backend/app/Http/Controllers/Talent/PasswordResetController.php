<?php

namespace App\Http\Controllers\Talent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use App\Models\Talent;

class PasswordResetController extends Controller
{
    public function forgot()
    {
        return view('talent.forgot_password');
    }

    public function reset($token)
    {
        return view('talent.reset_password', ['token' => $token]);
    }

    public function update(PasswordRequest $request)
    {
        // Illuminate\Auth\Passwords\PasswordBrokerから継承している
        // resetメソッドが成功するとPassword::PASSWORD_RESETが返される

        $status = Password::broker('talent')
                            ->reset($request->only('email', 'password', 'password_confirmation', 'token'),

            // パスワードを更新して、
            function ($talent, $password) {
                $talent->forceFill([
                    'password' => $password,
                    ])->save();
                    // Illuminate\Auth\Authenticatableの処理
                    // ユーザーのrememberTokenにinsertする
                    $talent->setRememberToken(Str::random(60));
                    event(new PasswordReset($talent));
            }
            // コールバック関数が成功するとPasswordBrokerでトークンを削除しています
        );

        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('talent.login')->with('flash_message', __($status))
                    : back()->withErrors(['email' => __($status)]);
    }
}
