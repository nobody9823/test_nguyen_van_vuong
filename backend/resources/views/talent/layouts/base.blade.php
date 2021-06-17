@extends('components.manage.layouts.base')
@section('title_content')
<title>ガーディアン | 管理画面 | @yield('title') </title>
@endsection
@section('css')
@yield('css')
@endsection

@section('header_content')
<a class="navbar-brand" href="/talent/dashboard">ガーディアン</a>

{{--        left side menu--}}
<ul class="navbar mr-auto">
</ul>

{{--        right side menu--}}
<ul class="navbar-nav">
    <li class="nav-item ">
        <a class="nav-link" href="{{ url('/talent/dashboard') }}">Dashboard</a>
    </li>
    <li class="nav-item ">
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
            Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
        </form>
    </li>
</ul>
@endsection

@section('side_bar_content')
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link active" href="/talent/dashboard">
                管理画面トップ
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('talent.project.index') }}">
                プロジェクト管理
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('talent.plan.index') }}">
                プラン管理
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('talent.activity_report.index') }}">
                活動報告管理
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('talent.supporter_comment.index') }}">
                支援者コメント管理
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('talent.message.index') }}">
                メッセージ管理
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('talent.detail.show', ['detail' => Auth::user()]) }}">
                各種設定
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href={{ route('talent.work_attendance.edit') }}>
                実績管理
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href={{ route('talent.work_shift.edit') }}>
                シフト管理
            </a>
        </li>
</ul>
@endsection

@section('content')
@yield('content')
@endsection

@section('script')
@yield('script')
@endsection
