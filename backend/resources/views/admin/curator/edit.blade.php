@extends('admin.layouts.base')

@section('title', 'キュレーター編集')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">キュレーター編集</div>
                <div class="card-body">
                    <form action="{{ route('admin.curator.update', ['curator' => $curator]) }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <x-admin.curator.form :curator="$curator" />
                        {{-- 未実装 --}}
                        {{-- <a href="{{ route('admin.curator.password_reset', ['curator' => $curator]) }}" id="reset">
                                パスワードリセットメールを送信する
                        </a> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
