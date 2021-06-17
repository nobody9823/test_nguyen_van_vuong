@extends('admin.layouts.base')

@section('title', "ユーザー編集")

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">ユーザー編集</div>
                <div class="card-body">
                    <form action="{{ route('admin.user.update', ['user' => $user]) }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <x-admin.user.form :user="$user" />
                        <a href="{{ route('admin.user.password_reset', ['user' => $user]) }}" id="reset">
                                パスワードリセットメールを送信する
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
