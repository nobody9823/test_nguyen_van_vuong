@extends('user.layouts.mail_template')

@section('content')
    <p>
        <div>FanReturnです。</div>
        <div>ご支援ありがとうございます。</div>
        <div>あなたは、{{ $project->payments_count }}人目の支援者です。</div>
        <br/>
        <div>
            ご支援いただいた方限定で、プロジェクトサポーター（PS）になることができます。
            <br/>
            PS限定リターンを取得できる可能性がございますので、ぜひご活用ください。
            <br/>
            PSの詳細は以下URLよりご確認ください。
            <br/>
            <a href="{{ route('user.project.support', ['project' => $project]) }}">プロジェクトサポーター(PS)とは</a>
        </div>
        <br/>
        <div>現在の支援総額は¥ {{ $project->payments_sum_price }}です。</div>
        <div>プロジェクト名 : {{ $project->title }}</div>
        <div>オーダーID : {{ $payment->paymentToken->order_id }}</div>
    </p>
@endsection
