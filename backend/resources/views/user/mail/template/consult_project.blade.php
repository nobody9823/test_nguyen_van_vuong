@extends('user.layouts.mail_template')

@section('content')
    <p>お名前 : {{ $input['name'] }}</p>
    <p>メールアドレス : {{ $input['email'] }}</p>
    <p>電話番号 : {{ $input['phone_number'] }}</p>
    <p>郵便番号 : {{ $input['postal_code'] }}</p>
    <p>都道府県 : {{ $input['prefecture'] }}</p>
    <p>市区町村 : {{ $input['city'] }}</p>
    <p>番地 : {{ $input['block'] }}</p>
    <p>建物名 : {{ $input['building'] }}</p>
    <p>企業ホームページ : {{ $input['site_url'] }}</p>
    <p>カテゴリ : {{ $input['tag'] }}</p>
    <p>プラン : {{ $input['commission'] }}</p>
    <p>FanReturnを知ったきっかけ : {{ $input['motive'] }}</p>
    <p>このサービスの紹介者 : {{ $input['introducer'] }}</p>
    <p>相談内容 : </p>
    <p style="white-space: pre-line;">{{ $input['consultation_content'] }}</p>
@endsection
