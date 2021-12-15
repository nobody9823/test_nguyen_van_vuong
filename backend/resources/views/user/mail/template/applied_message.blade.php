@extends('user.layouts.mail_template')

@section('content')
    <p>
        <div>FanReturnです。</div>
        <div>新着メッセージをお知らせします。</div>
        <a href="{{ $url }}">新着メッセージの確認はこちら</a>
    </p>
@endsection
