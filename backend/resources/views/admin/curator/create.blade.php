@extends('admin.layouts.base')

@section('title', 'キュレーター新規作成')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">キュレーター新規作成</div>
                <div class="card-body">
                    <form action="{{ route('admin.curator.store') }}" method="POST">
                        @csrf
                        <x-admin.curator.form :curator="null" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
