{{-- simple_blade

    使用可能状況
    →カラムがid, name, created_at, updated_atのみの場合
    使用方法
    →controllerで以下のように引数を定義,bladeの書き込みは不要

    public function edit(Category $category)
    {
        return view('components.admin.simple_edit', [
            'title' => 'カテゴリ',  //UI用日本語表記
            'type' => 'category',  //name属性用英語表記
            'prop' => $category,   //バインディングしたmodelインスタンスを返せばok
        ]);
    }
--}}

@extends('admin.layouts.base')

@section('title', isset($prop) ? "$title"."情報編集" : "$title"."新規作成")

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ $title }}{{ isset($prop) ? "情報編集" : "新規作成" }}</div>
                <div class="card-body">
                    @if(isset($prop))
                        <form action="{{route('admin.'.$type.'.update',[$type => $prop])}}" method="POST">
                        @method('PATCH')
                    @else
                        <form action='{{ route("admin.$type.store") }}' method="POST">
                    @endif
                        @csrf
                        <div class="form-group">
                            <label for="formControlInput1">名前</label>
                            <input type="text" name="name" class="form-control" id="formControlInput1"
                                value="{{ old('name', isset($prop->name) ? $prop->name : '') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ isset($prop) ? "更新" : "作成" }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
