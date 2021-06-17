@extends('admin.layouts.base')

@section('title', "会社情報編集")

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">会社情報編集</div>
                <div class="card-body">
                    <form action="{{ route('admin.company.update',['company' => $company]) }}" enctype="multipart/form-data" method="POST">
                        @method('PATCH')
                        @csrf
                        <x-admin.company.form :company="$company" />
                        <a href="{{ route('admin.company.password_reset', ['company' => $company]) }}" id="reset">
                                パスワードリセットメールを送信する
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection