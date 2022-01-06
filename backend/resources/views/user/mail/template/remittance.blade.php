@extends('user.layouts.mail_template')

@section('content')
    <p>
        <div>FanReturnです。</div>
        <div>送金が完了しました。金融機関のシステムによっては実際にお振り込みされるまで２〜３営業日ほどかかる場合がございます。</div>
        <div>プロジェクト名 : {{ $project->title }}</div>
        <div>インフルエンサー名 : {{ $project->user->name }}</div>
        <div>目標金額: ¥{{ number_format($project->target_number) }}</div>
        <div>支援者数: {{ $project->payments_count }}人</div>
        <div>達成金額: ¥{{ number_format($project->payments_sum_price) }}</div>
        <div>FR(ファンリターン)手数料: ¥{{ number_format($project->application_fee) }}</div>
        <div>プロジェクト経費: ¥{{ number_format($project->option_fee) }}</div>
        <div>お振込金額: ¥{{ number_format($project->remittance_amount) }}</div>
        <br/>
        <div>
            この度は、FanReturnをご利用いただきまして誠にありがとうございます。
            <br/>
            FanReturnをご利用いただいた方に、感想やご意見を持っているかをお伺いするためにアンケートを実施しております。
            <br/>
            ご回答いただきました内容につきましては、サービスの品質向上に役立ててまいりますので、ぜひご理解とご協力をいただきますようお願い申し上げます。
            <br/>
            アンケートは下記URLからご回答いただけます。
            <br/>
            <a href="{{ route('user.index') }}">◯◯◯◯◯◯◯◯◯◯◯◯</a>
            <br/>
            ※所要時間は1〜2分程度です。
            <br/>
            今後ともFanReturnご活用のほどよろしくお願いいたします。
        </div>
    </p>
@endsection
