@extends('user.layouts.mail_template')

@section('content')
    <p>
        <div>Fan Returnです。</div>
        <div>プロジェクトを申請いただきありがとうございます。</div>
        <div>審査には１週間から２週間ほどお時間をいただいております。</div>
        <div>担当者よりご連絡いたしますのでお待ちください。</div>
        <a href="{{ route('user.my_project.project.show', ['project' => $project]) }}">プロジェクト詳細画面はこちら</a>
    </p>
@endsection