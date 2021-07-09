@extends('user.layouts.mail_template')

@section('content')
    <p>
        <h3>Fan Returnです。</h3>
        <p>こちらからパスワードの再設定をお願いいたします。</p>
        <p>
            <a href="{{ $url }}">パスワード再設定フォームはこちら</a>
        </p>
    </p>
@endsection
