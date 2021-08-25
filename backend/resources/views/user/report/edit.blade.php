@extends('user.layouts.base')

@section('title', '活動報告編集')

@section('content')
<section id="supported-projects" class="section_base report_form">
    <div class="tit_L_01 E-font">
        <h2>EDIT REPORT</h2>
        <div class="sub_tit_L">活動報告編集</div>

    </div>
    <form action="{{ route('user.report.update', ['project' => $project, 'report' => $report]) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <x-user.report.form :report="$report" />
    </form>
</section>
@endsection