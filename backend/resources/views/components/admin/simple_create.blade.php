{{-- simple_blade

    使用可能状況
    →カラムがid, name, created_at, updated_atのみの場合
    使用方法
    →controllerで以下のように引数を定義,bladeの書き込みは不要

    public function create()
    {
        return view('components.admin.simple_create', [
            'title' => 'カテゴリ',   //UI用日本語表記
            'type' => 'category',   //name属性用英語表記
        ]);
    }
--}}

@extends('admin.layouts.base')

@section('title', "{{$title}}新規作成")

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{$title}}新規作成</div>
                <div class="card-body">
                    <form action='{{ route("admin.$type.store") }}' method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlInput1">名前</label>
                            <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                                value="{{ old('name') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">作成</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
