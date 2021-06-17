@extends('user.layouts.base')

@section('title', '企業アカウント/本登録申請画面')

@section('content')
<div class="content" style=" background: #f5f5f5; padding: 80px 0;">
    <div class="section">
        <div class="fixedcontainer mypage_contents sign-in_box">
            <h2><i class="fas fa-sign-in-alt"></i>企業アカウント/本登録申請</h2>
            <form action={{route('company.register',['token' => $token])}} method='post' enctype="multipart/form-data">
                @csrf
                <x-manage.register-form />
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{ asset('js/uploaded-images-preview.js') }}"></script>
@endsection
