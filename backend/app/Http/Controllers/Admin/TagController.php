<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NameValidatorRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tag = Tag::orderBy('created_at','DESC')->paginate(10);        
        return view('components.admin.simple_index', [
            "title" => 'タグ',
            "type" => 'tag',
            "props" => $tag,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('components.admin.simple_form', [
            'title' => 'タグ',
            'type' => 'tag',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NameValidatorRequest $request, Tag $tag)
    {
        $tag->name = $request->name;
        $tag->save();
        return redirect()->action([TagController::class, 'index'])->with('flash_message', '新規タグ作成が完了しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $Tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('components.admin.simple_form', [
            'title' => 'カテゴリ',
            'type' => 'tag',
            'prop' => $tag,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $Tag
     * @return \Illuminate\Http\Response
     */
    public function update(NameValidatorRequest $request, Tag $tag)
    {
        $tag->name = $request->name;
        $tag->save();
        return redirect()->action([TagController::class, 'index'])->with('flash_message', 'カテゴリ更新が完了しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $Tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->action([TagController::class, 'index'])->with('flash_message', '削除が成功しました。');
    }
}
