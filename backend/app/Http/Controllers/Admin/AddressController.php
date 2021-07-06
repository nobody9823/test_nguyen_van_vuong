<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;

class AddressController extends Controller
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
        return view('admin.address.create', [
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressRequest $request, User $user)
    {
        $user->address()->save(new Address([
            'postal_code' => $request->postal_code,
            'prefecture' => $request->prefecture,
            'city' => $request->city,
            'block' => $request->block,
            'building' => $request->building,
        ]));
        return redirect()->action([UserController::class,'index'])->with('flash_message', '住所の作成が完了しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if ($user->address) {
            return view('admin.address.edit', [
                'user' => $user
            ]);
        } else {
            return redirect()->action([AddressController::class, 'create'], ['user'=>$user])->with('error', '住所が存在しないため、作成画面へ遷移しました。');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(AddressRequest $request, User $user, Address $address)
    {
        $address->fill($request->all())->save();
        return redirect()->action([UserController::class,'index'])->with('flash_message', '住所の更新が完了しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Address $address)
    {
        //
    }
}
