@extends('admin.layouts.base')

@section('title', '会社新規作成')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">会社新規作成</div>
                <div class="card-body">
                    <form action="{{ route('admin.company.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <x-admin.company.form :company="null" />

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
