<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SnsUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    // メディア側へのリダイレクト
    public function redirectToProvider(Request $request)
    {
        return Socialite::driver($request->provider)->redirect();
    }

    // メディア側から返されるユーザー情報
    public function handleProviderCallback(Request $request, User $user)
    {
        try {
            $sns_user = Socialite::driver($request->provider)->user();
        } catch (\Exception $e) {
            Log::alert($e->getMessage());
            return redirect('/'); //許可しなかった際のリダイレクト先を指定
        }
        $sns_user_id = $sns_user->getId();
        $sns_email = $sns_user->getEmail()?? Str::random(16).'@'.$request->provider;
        $sns_name = $sns_user->getName();
        // 登録済ならログイン。未登録ならアカウント登録してログイン
        if (!is_null($sns_user_id)) {
            $oauth_user = SnsUser::where('sns_user_id', $sns_user_id)->where('sns_service_name', $request->provider)->first();
            //空ならユーザーを新規作成してそのIDを含めたoauth_userも追加
            if (!$oauth_user) {
                try {
                    $user->name = $sns_name;
                    $user->email = $sns_email;
                    $user->password = Hash::make(Str::random());
                    $user->save();
                } catch (\Throwable $th) {
                    Log::alert($th->getMessage());
                    return redirect()->action([ProjectController::class, 'index'])->with('flash_message', 'ログインに失敗しました。メールアドレスがすでに登録されている可能性があります。');
                }

                $oauth_user = SnsUser::create([
                    'user_id' => $user->id,
                    'sns_user_id' => $sns_user_id,
                    'sns_service_name' => $request->provider,
                ]);
            } elseif (($oauth_user->user->email !== $sns_email) || ($oauth_user->user->name !== $sns_name)) {
                $oauth_user->user->name = $sns_name;
                $oauth_user->user->email = $sns_email?? Str::random(16).'@'.$request->provider;
                $oauth_user->user->save();
            }
            Auth::login($oauth_user->user);
            return redirect()->action([MypageController::class, 'profile']);
        }
        return '情報が取得できませんでした。';
    }
}
