<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\SnsUser;
use App\Models\User;
use App\Models\Profile;
use App\Models\Address;
use App\Models\SnsLink;
use App\Models\Identification;
use App\Providers\RouteServiceProvider;
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
                DB::beginTransaction();
                try {
                    $user->name = $sns_name;
                    $user->email = $sns_email;
                    $user->password = Hash::make(Str::random());
                    $user->save();
                    $user->profile()->save(Profile::initialize());
                    $user->address()->save(Address::initialize());
                    $user->snsLink()->save(SnsLink::initialize());
                    $user->identification()->save(Identification::initialize());
                    $oauth_user = SnsUser::create([
                        'user_id' => $user->id,
                        'sns_user_id' => $sns_user_id,
                        'sns_service_name' => $request->provider,
                    ]);
                    DB::commit();
                } catch (\Throwable $th) {
                    DB::rollback();
                    Log::alert($th->getMessage());
                    return redirect()->action([ProjectController::class, 'index'])->withErrors('ログインに失敗しました。管理会社に確認をお願いします。');
                }

            } elseif (($oauth_user->user->email !== $sns_email) || ($oauth_user->user->name !== $sns_name)) {
                DB::beginTransaction();
                try {
                    $oauth_user->user->name = $sns_name;
                    $oauth_user->user->email = $sns_email?? Str::random(16).'@'.$request->provider;
                    $oauth_user->user->save();
                    $oauth_user->user->profile()->save(Profile::initialize());
                    $oauth_user->user->address()->save(Address::initialize());
                    $oauth_user->user->snsLink()->save(SnsLink::initialize());
                    $oauth_user->user->identification()->save(Identification::initialize());
                } catch (\Exception $e){
                    DB::rollback();
                    Log::alert($th->getMessage());
                    return redirect()->action([ProjectController::class, 'index'])->withErrors('ログインに失敗しました。管理会社に確認をお願いします。');
                }
            }
            Auth::login($oauth_user->user);
            return redirect()->intended(RouteServiceProvider::HOME)->with('flash_message', 'FanReturnへの登録が完了致しました。');
        }
        return '情報が取得できませんでした。';
    }
}
