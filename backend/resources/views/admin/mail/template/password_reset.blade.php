@extends('admin.layouts.mail_template')

@section('content')
<p>
    {{ $user->name }}様
</p>
<p>パスワードの変更をお願いいたします。</p>
<p>
    <a href="{{ $url }}">パスワード変更フォームはこちら</a>
</p>
@endsection
