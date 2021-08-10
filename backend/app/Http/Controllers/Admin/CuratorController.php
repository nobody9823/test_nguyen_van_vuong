<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CuratorRequest;
use App\Models\Curator;

class CuratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $curators = Curator::with('projects')->paginate(10);

        return view('admin.curator.index', ['curators' => $curators]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.curator.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CuratorRequest $request, Curator $curator)
    {
        return $curator->fill($request->all())->save()
            ? redirect()->action([CuratorController::class, 'index'])->with('flash_message', 'キュレーターの作成が成功しました。')
            : redirect()->action([CuratorController::class, 'index'])->withErrors('キュレーターの作成が失敗しました。管理会社にご連絡ください。');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Curator $curator)
    {
        return view('admin.curator.edit', compact('curator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CuratorRequest $request, Curator $curator)
    {
        return $curator->fill($request->all())->save()
            ? redirect()->action([CuratorController::class, 'index'])->with('flash_message', 'キュレーターの更新が成功しました。')
            : redirect()->action([CuratorController::class, 'index'])->withErrors('キュレーターの更新が失敗しました。管理会社にご連絡ください。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curator $curator)
    {
        return $curator->delete()
            ? redirect()->action([CuratorController::class, 'index'])->with('flash_message', 'キュレーターの削除が成功しました。')
            : redirect()->action([CuratorController::class, 'index'])->withErrors('キュレーターの削除が失敗しました。管理会社にご連絡ください。');
    }
}
