@extends('user.layouts.mail_template')

@section('content')
    <p>
        <div>Fan Returnです。</div>
        <div><strong>{{ $alter_type }}</strong>が実行されました。</div>
        <div>プロジェクト名 : {{ $project->title }}</div>
        <div>インフルエンサー名 : {{ $project->user->name }}</div>
        <div>目標金額: ¥{{ number_format($project->target_number) }}</div>
        <div>達成金額: ¥{{ number_format($project->payments_sum_price) }}</div>
        <div>支援者数: {{ $project->payments_count }}人</div>
        @if($alter_type === '実売上計上')
            <div>実売上計上が全て完了されましたら以下のプロジェクト管理画面から引き続き送金作業を行ってください。</div>
        @endif
        <a href="{{ route('admin.project.index', ['project' => $project]) }}">プロジェクト管理画面</a>
    </p>
@endsection
