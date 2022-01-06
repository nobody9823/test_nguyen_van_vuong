@extends('user.layouts.mail_template')

@section('content')
    <p>
        <div>FanReturnです。</div>
        <div>下記プロジェクトの審査が完了しました。</div>
        <div>設定された掲載開始日になりましたら実際に掲載が開始されます。</div>
        <div>ご質問やご不明点は担当者、または下記のカスタマーサポートへご連絡ください。</div>
        <a href="{{ route('user.my_project.project.show', ['project' => $project]) }}">プロジェクト詳細画面はこちら</a>
    </p>
@endsection
