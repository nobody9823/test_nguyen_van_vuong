@extends('user.layouts.mail_template')

@section('content')
    <p>
        <div>Fan Returnです。</div>
        <div>ご支援ありがとうございます。</div>
        <div>あなたは、{{ $billing_users_count }}人目の支援者です。</div>
        <div>プロジェクト名 : {{ $project_title }}</div>
        <div>支援ID : {{ $payment_id }}</div>
    </p>
@endsection