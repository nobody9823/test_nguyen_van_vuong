<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Validation\Rule;

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
    public function edit(User $user, Request $request)
    {
        $address = $user->address->where('id', $request->address_id)->first();
        if ($user && $address) {
            return view('admin.address.edit', [
                'user' => $user,
                'address' => $address
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
    public function update(Request $request, User $user, Address $address)
    {
        $req = $request->all();
        if (!empty($req['postal_code'])) {
            $targetRegexs  = '/[\x{207B}\x{208B}\x{2010}\x{2012}\x{2013}\x{2014}\x{2015}\x{2212}\x{2500}\x{2501}\x{2796}\x{30FC}\x{3161}\x{FF0D}\x{FF70}]/u';
            $resultRegex = '-';
            $tmpPostalCode = $req['postal_code'];
            $tmpPostalCode  = mb_convert_encoding($tmpPostalCode, 'UTF-8', 'auto');
            // ハイフンを変換
            $tmpPostalCode = preg_replace($targetRegexs, $resultRegex, $tmpPostalCode);
            // 半角に変換
            $tmpPostalCode = mb_convert_kana($tmpPostalCode, "a");
            if (preg_match("/\A\d{3}-?\d{4}\z/", $tmpPostalCode)) {
                // ハイフンを削除
                $req['postal_code'] = str_replace('-', '', $tmpPostalCode);
            }
        }

        $messages = [
            'postal_code.size' => '正しい郵便番号を入力してください。',
            'postal_code.regex' => '正しい郵便番号を入力してください。',
        ];

        $validator = Validator::make($req, [
            'postal_code' => ['required', 'string', 'size:7', 'regex:/^[0-9]{3}-?[0-9]{4}+$/u'],
            'city' => ['required', 'string'],
            'block' => ['required', 'string'],
            'building' => ['nullable', 'string'],
        ], $messages);

        $validator->validate();
        $address->fill($req)->save();
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
