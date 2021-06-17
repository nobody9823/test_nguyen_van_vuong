@extends('admin.layouts.mail_template')

@section('content')
<p>
  {{ $recipient }}様
</p>
<p>
    {{ $sender }}様より、メッセージが届きました。下記のリンクよりご確認ください。
</p>
<p>
    <a href="{{ $url }}">メッセージ画面に遷移する</a>
</p>
@endsection
