<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\ProjectRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        return view('admin.profile.create', [
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request, User $user)
    {
        $profile = new Profile();
        $user->profile()->save($profile->fill($request->all()));
        // ユーザー作成から遷移してきた場合、住所入力画面へ
        if ($request->from_user_store) {
            return redirect()->action([AddressController::class,'create'], ['user' => $user])->with('flash_message', '住所の作成が完了しました。最後に住所の入力をしてください。');
        } else {
            return redirect()->action([UserController::class,'index'])->with('flash_message', '住所の作成が完了しました。');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Profile $profile)
    {
        if ($user->profile) {
            return view('admin.profile.edit', [
                'user' => $user
            ]);
        } else {
            return redirect()->action([ProfileController::class, 'create'], ['user'=>$user])->with('error', 'プロフィールが存在しないため、作成画面へ遷移しました。');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, User $user, Profile $profile)
    {
        // dd($request->all());
        $profile->fill($request->all())->save();
        return redirect()->action([UserController::class,'index'])->with('flash_message', 'プロフィールの更新が完了しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Profile $profile)
    {
        //
    }
}
