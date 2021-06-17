<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\Password;
use App\Mail\Admin\MailForPasswordReset;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        $users = User::getUsers();
        return view('admin.user.index', ['users' => $users]);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(UserRequest $request, User $user)
    {
        $user->fill($request->all())->save();
        return redirect()->action([UserController::class, 'store'])->with('flash_message', "ユーザーが作成されました。");
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', ['user' => $user]);
    }

    public function update(UserRequest $request, User $user)
    {
        $user->fill($request->all())->save();
        return redirect('/admin/user')->with('flash_message', '編集が成功しました。');
    }

    public function destroy(User $user)
    {
        $user->deleteImageIfSample();
        $user->delete();
        return redirect()->action([UserController::class, 'index'])->with('flash_message', '削除が成功しました。');
    }

    public function search(SearchRequest $request)
    {
        $users = User::searchWord($request->getArrayWords());

        return view('admin.user.index', [
            'users' => $users,
            'word' => $request->getWords(),
        ]);
    }

    public function passwordReset(User $user)
    {
        $token = Password::createToken($user);

        Mail::to($user)
        ->send(new MailForPasswordReset($token, $user));

        return redirect()->route('admin.user.index')->with('flash_message', 'メール送信が成功しました。');
    }
}
