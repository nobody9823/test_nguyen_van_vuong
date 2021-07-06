@extends('admin.layouts.base')

@section('title', "ユーザー住所作成")

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ $user->name }}さんの住所作成</div>
                <div class="card-body">
                    <form action="{{ route('admin.address.store', ['user' => $user]) }}" method="POST">
                        @csrf
                        <x-admin.address.form :user="$user" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
