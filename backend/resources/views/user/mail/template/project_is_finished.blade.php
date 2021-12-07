@extends('user.layouts.mail_template')

@section('content')
    <p>
        <div>Fan Returnです。</div>
        <div>下記プロジェクトの掲載が終了しました。</div>
        <div>プロジェクト名: {{ $project->title }}</div>
        <div>目標金額: ¥{{ number_format($project->target_number) }}</div>
        <div>達成金額: ¥{{ number_format($project->payments_sum_price) }}</div>
        <div>支援者数: {{ $project->payments_count }}人</div>
        <div>
            <a href="{{ $url }}">プロジェクトの詳細ページはこちら</a>
        </div>
        <div>※システムの状況によっては通知が２回送られることがございますので、ご了承ください。</div>
        <div>ご質問やご不明点は担当者、または下記のカスタマーサポートへご連絡ください。</div>
    </p>
@endsection
