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
    public function forgotPassword()
    {
        return view('user.auth.forgot_password');
    }

    public function sendResetPasswordMail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'confirmed', 'exists:users'],
            'email_confirmation' => ['required', 'string', 'email'],
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['flash_message' => 'パスワード再設定用リンクのメール送信が完了しました。'])
                    : back()->withErrors(['email' => __($status)]);
    }

    public function reset($token)
    {
        return view('user.auth.password_reset', ['token' => $token]);
    }

    public function update(PasswordRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('flash_message', 'パスワードの再設定が完了しました。ログインしてください。')
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
