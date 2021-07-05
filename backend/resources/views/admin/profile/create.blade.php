@extends('admin.layouts.base')

@section('title', "ユーザープロフィール作成")

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ $user->name }}さんのプロフィール作成</div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.store', ['user' => $user]) }}" method="POST">
                        @csrf
                        <x-admin.profile.form :user="$user" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
