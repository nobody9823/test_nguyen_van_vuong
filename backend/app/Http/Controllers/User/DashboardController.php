<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPasswordRequest;
use App\Http\Requests\UserProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function plan(Request $request)
    {
        $plans = User::find(Auth::id())->plans->load(['project', 'project.talent']);
        return view('user.mypage.plan', [
            'plans' => $plans,
        ]);
    }

    public function comment()
    {
        $comments = User::find(Auth::id())->supportComments->load(['project.plans', 'likedUsers', 'repliesToSupporterComment.talent']);
        return view('user.mypage.comment', [
            'comments' => $comments,
        ]);
    }

    public function project()
    {
        $projects = User::find(Auth::id())->projects->load(['projectImages','category','talent']);
        return view('user.mypage.project', [
            'projects' => $projects,
        ]);
    }

    public function editProfile()
    {
        $user = Auth::user();

        return view('user.mypage.profile', ['user' => $user]);
    }

    public function updateProfile(UserProfileRequest $request, User $user)
    {
        $user->fill($request->all())->save();
        return redirect()->route('user.edit_profile')->with('flash_message', 'プロフィール更新が成功しました。');
    }

    public function get_change_password()
    {
        return view('user.mypage.change_password');
    }

    public function post_change_password(UserPasswordRequest $request, User $user)
    {
        $user->password = $request->new_password;
        $user->save();
        return redirect()->back()->with('flash_message', "パスワード変更が成功しました。");
    }

    public function get_reset_password()
    {
        return view('user.reset_password');
    }

    public function post_reset_password()
    {
    }

    public function withdraw()
    {
        return view('user.mypage.withdraw');
    }

    public function delete_user(User $user)
    {
        if ($user->id === Auth::id()) {
            $user->delete();
            return redirect('/')->with('flash_message', '退会が完了しました。またのご利用をお待ちしております。');
        } else {
            return redirect()->back()->with('flash_message', '退会手続きに失敗しました。');
        }
    }
}
