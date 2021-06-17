<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NameValidatorRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::getCategories();
        return view('components.admin.simple_index', [
            "title" => 'カテゴリ',
            "type" => 'category',
            "props" => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('components.admin.simple_create', [
            'title' => 'カテゴリ',
            'type' => 'category',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NameValidatorRequest $request, Category $category)
    {
        $category->name = $request->name;
        $category->save();
        return redirect()->action([CategoryController::class, 'index'])->with('flash_message', '新規カテゴリ作成が完了しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('components.admin.simple_edit', [
            'title' => 'カテゴリ',
            'type' => 'category',
            'prop' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(NameValidatorRequest $request, Category $category)
    {
        $category->name = $request->name;
        $category->save();
        return redirect()->action([CategoryController::class, 'index'])->with('flash_message', 'カテゴリ更新が完了しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->action([CategoryController::class, 'index'])->with('flash_message', '削除が成功しました。');
    }
}
