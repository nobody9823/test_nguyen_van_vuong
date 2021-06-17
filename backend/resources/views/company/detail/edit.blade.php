@extends('company.layouts.base')

@section('title', '各種設定')

@section('content')

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">詳細編集</div>
                <div class="card-body">
                    <form action="{{ route('company.detail.update', compact('detail')) }}" method="POST" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label>プロフィール画像</label><br>
                            <input type="file" name="image_url" id="imageUploader" value="{{ old('image_url') }}"><br>
                            <img style="max-height:200px; max-width:300px;" src="{{ Storage::url($detail->image_url) }}">
                        </div>
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
@section('script')
<!-- 画像をアップロードした際、ブラウザにリアルタイムで画像を表示させる -->
<script src="{{ asset('/js/image-upload-browser.js') }}"></script>
@endsection