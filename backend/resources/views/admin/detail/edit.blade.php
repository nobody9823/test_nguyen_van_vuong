@extends('admin.layouts.base')

@section('title', '各種設定')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">詳細編集</div>
                <div class="card-body">
                    <form action="{{ route('admin.detail.update', compact('detail')) }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label>名前</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $detail->name) }}">
                        </div>

                        <div class="form-group">
                            <label>メールアドレス</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $detail->email) }}">
                        </div>

                        <div class="form-group">
                            <label>パスワード</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">パスワード(確認)</label>
                            <input type="password" name="password_confirmation" class="form-control" id="exampleFormControlInput1"
                                   value="{{ old('password_confirmation') }}">
                        </div>

                        <button type="submit" class="btn btn-primary">更新</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
