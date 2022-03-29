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
use Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::search()->sortBySelected($request->sort_type)->paginate(10);
        return view('admin.user.index', ['users' => $users]);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(UserRequest $request, User $user)
    {
        $user->fill($request->all())->save();
        return redirect()->action([ProfileController::class, 'create'], ['user' => $user, 'from_user_store' => true])->with('flash_message', "ユーザーが作成されました。引き続きプロフィール情報を入力してください。");
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

    public function destroy(User $user, Request $request)
    {
        if (count($user->address) > 1) {
            $user->address->find($request->address_id)->delete();
        } else {
            $user->deleteImageIfSample();
            $user->delete();
        }
        return redirect()->action([UserController::class, 'index'])->with('flash_message', '削除が成功しました。');
    }

    public function passwordReset(User $user)
    {
        $token = Password::createToken($user);

        Mail::to($user)
            ->send(new MailForPasswordReset($token, $user));

        return redirect()->route('admin.user.index')->with('flash_message', 'メール送信が成功しました。');
    }

    public function downloadIdentifyImage(User $user, Request $request)
    {
        if ($request->column_name === 'identify_image_1') {
            return Storage::download($user->identification->identify_image_1, $user->profile->last_name . $user->profile->first_name . '様_本人確認書類１.' . pathinfo($user->identification->identify_image_1)['extension']);
        } else if ($request->column_name === 'identify_image_2') {
            return Storage::download($user->identification->identify_image_2, $user->profile->last_name . $user->profile->first_name . '様_本人確認書類２.' . pathinfo($user->identification->identify_image_2)['extension']);
        }
    }
}
