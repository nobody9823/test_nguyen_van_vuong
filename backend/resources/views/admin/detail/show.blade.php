@extends('admin.layouts.base')

@section('title', '各種設定')

@section('content')

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">設定詳細</div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li><h5>名前</h5></li>
                        <li><h5>{{ $detail->name }}</h5></li>
                        <li><h5>メールアドレス</h5></li>
                        <li><h5>{{ $detail->email }}</h5></li>
                    </ul>
                    <a class="btn btn-primary btn-sm" href="{{ route('admin.detail.edit', ['detail' => $detail]) }}">編集</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
