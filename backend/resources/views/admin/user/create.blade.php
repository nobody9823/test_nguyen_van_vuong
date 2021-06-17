@extends('admin.layouts.base')

@section('title', 'ユーザー新規作成')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">ユーザー新規作成</div>
                <div class="card-body">
                    <form action="{{ route('admin.user.store') }}" method="POST">
                        @csrf
                        <x-admin.user.form :user="null" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
