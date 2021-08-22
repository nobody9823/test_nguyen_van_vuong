@extends('user.layouts.base')

@section('title', '活動報告作成')

@section('content')
<section id="supported-projects" class="section_base report_form">
    <div class="tit_L_01 E-font">
        <h2>CREATE REPORT</h2>
        <div class="sub_tit_L">活動報告作成</div>
    </div>

    <form action="{{ route('user.report.store', ['project' => $project]) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <x-user.report.form :report="null" />
    </form>
</section>
@endsection