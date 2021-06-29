@extends('user.layouts.base')

@section('title', 'マイページ | プロフィール')

@section('content')
    <div class="content">
        <div class="section">
            <x-user.mypage-navigation-bar/>
            <x-user.mypage.profile-form />
            <div class="Withdrawal">
                <a href="{{ route('user.withdraw') }}">
                    退会の方はこちら
                </a>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
