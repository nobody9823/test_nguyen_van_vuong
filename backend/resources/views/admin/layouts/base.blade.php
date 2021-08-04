@extends('components.manage.layouts.base')

@section('title_content')
<title>Laravel Jarvis | 管理画面 | @yield('title') </title>
@endsection

@section('css')
@yield('css')
@endsection

@section('header_content')
<a class="navbar-brand h_logo_css_sp" title="FanReturn" rel="home" href="{{ route('admin.dashboard') }}">
    <img src="{{ asset('image/logo-color.svg') }}">
</a>

{{--        left side menu--}}
<ul class="navbar mr-auto">
</ul>

{{--        right side menu--}}
<ul class="navbar-nav">
    @if(Route::has('login'))
    @auth
    <li class="nav-item ">
        <a class="nav-link-child" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
            Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
        </form>
    </li>
    <li>
        <button type="button" class="btn btn-secondary hanburger-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
            </svg>
        </button>
    </li>
    @else
    <li class="nav-item ">
        <a class="nav-link" href="{{ route('login') }}">Login</a>
    </li>

    @if(Route::has('register'))
    <li class="nav-item ">
        <a class="nav-link" href="{{ route('register') }}">Register</a>
    </li>
    @endif
    @endauth
    @endif
</ul>
@endsection

@section('side_bar_content')
<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link active" href="/admin/dashboard">
            管理画面トップ
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.user.index')}}">
            ユーザ管理
        </a>
        {{-- <a role='button' class="dropdown-toggle" href="#collapse_user" data-toggle="collapse"
                aria-controls="collapse_user" aria-expanded="true">
            </a> --}}
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.curator.index')}}">
            キュレーター管理
        </a>
    </li>
    <li class="nav-item">
        <div class="nav-link">
            <a class="nav-link_2" href="{{ route('admin.project.index') }}">
                プロジェクト管理
            </a>
            <a role='button' class="dropdown-toggle" href="#collapse_project" data-toggle="collapse"
                aria-controls="collapse_project" aria-expanded="true">
            </a>
            <div class="collapse show" id="collapse_project">
                <a class='nav-link-child' href="{{ route('admin.plan.index') }}">
                    リターン管理
                </a>
                <a class='nav-link-child' href="{{ route('admin.payment.index') }}">
                    支援者(ファン)管理
                </a>
                <a class='nav-link-child' href="{{ route('admin.report.index') }}">
                    活動報告管理
                </a>
                <a class='nav-link-child' href="{{ route('admin.comment.index') }}">
                    コメント管理
                </a>
            </div>
        </div>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.message.index') }}">
    メッセージ管理
    </a>
    </li> --}}
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.tag.index') }}">
            タグ管理
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.detail.show', ['detail' => Auth::id()]) }}">
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
<script src="{{ asset('/js/hamburger-btn.js') }}"></script>
@endsection
