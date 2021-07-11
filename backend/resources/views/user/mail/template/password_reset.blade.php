@extends('user.layouts.mail_template')

@section('content')
    <p>
        <p>こちらからパスワードの再設定をお願いいたします。</p>
        <p>
            <a href="{{ $url }}">パスワード再設定フォームはこちら</a>
        </p>
    </p>
@endsection
