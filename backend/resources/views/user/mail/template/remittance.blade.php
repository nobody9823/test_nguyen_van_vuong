@extends('user.layouts.mail_template')

@section('content')
    <p>
        <div>Fan Returnです。</div>
        <div>送金が完了しました。金融機関のシステムによっては実際にお振り込みされるまで２〜３営業日ほどかかる場合がございます。</div>
        <div>プロジェクト名 : {{ $project->title }}</div>
        <div>インフルエンサー名 : {{ $project->user->name }}</div>
        <div>目標金額: ¥{{ number_format($project->target_number) }}</div>
        <div>支援者数: {{ $project->payments_count }}人</div>
        <div>達成金額: ¥{{ number_format($project->payments_sum_price) }}</div>
        <div>FR(ファンリターン)手数料: ¥{{ number_format($project->application_fee) }}</div>
        <div>プロジェクト経費: ¥{{ number_format($project->option_fee) }}</div>
        <div>お振込金額: ¥{{ number_format($project->remittance_amount) }}</div>
    </p>
@endsection
