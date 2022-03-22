@extends('admin.layouts.base')

@section('title', "ユーザー住所編集")

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ $user->name }}さんの住所編集</div>
                <div class="card-body">
                    <form action="{{ route('admin.address.update', ['user' => $user, 'address' => $address->id]) }}"
                        method="POST">
                        @method('PATCH')
                        @csrf
                        <x-admin.address.form :user="$user" :address="$address" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
