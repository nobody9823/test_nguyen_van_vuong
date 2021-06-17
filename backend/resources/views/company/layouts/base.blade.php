@extends('components.manage.layouts.base')

@section('title_content')
<title>ガーディアン | 管理画面 | @yield('title') </title>
@endsection

@section('css')
@yield('css')
@endsection

@section('header_content')
<a class="navbar-brand" href="/company/dashboard">ガーディアン</a>

{{--        left side menu--}}
<ul class="navbar mr-auto">
</ul>

{{--        right side menu--}}
<ul class="navbar-nav">
    <li class="nav-item ">
        <a class="nav-link" href="{{ url('/company/dashboard') }}">Dashboard</a>
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
        <a class="nav-link active" href="/company/dashboard">
            管理画面トップ
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('company.project.index') }}">
            プロジェクト管理
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('company.plan.index') }}">
            プラン管理
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('company.activity_report.index') }}">
            活動報告管理
        </a>
    </li>
    <li class="nav-item">
        <div class="btn-group">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                style="cursor: pointer;">
                <i class="fas fa-caret-down"></i> タレント管理
            </a>

            <div class="dropdown-menu">
                <a class="dropdown-item text-success" href="{{ route('company.talent.index') }}">承認済みタレント</a>
                <a class="dropdown-item text-danger" href="{{ route('company.temporary_talent.index') }}">承認待ちタレント</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href={{ route('company.supporter_comment.index') }}>
            支援者コメント管理
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href={{ route('company.message.index') }}>
            メッセージ管理
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('company.detail.show', ['detail' => Auth::user()]) }}">
            各種設定
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
