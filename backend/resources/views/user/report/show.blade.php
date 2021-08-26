@extends('user.layouts.base')

@section('content')
<section class="section_base report_detail">
    <div class="tit_L_01 E-font">
        <h2>DETAIL REPORTS</h2>
        <div class="sub_tit_L">活動報告詳細</div>
    </div>

    <div class="content">
        <div class="pds_sec02_img">
            <img src="{{ Storage::url($report->image_url) }}">
        </div>
        <div class="disclaimer">
            {{ $report->created_at }}
        </div>
        <div>
            <strong>{{ $report->title }}</strong>
        </div>
        <div style="white-space: pre-line;">{{ $report->content }}</div>
        <div>
           <a href="javascript: history.back()"><i class="fas fa-chevron-left"></i> 活動報告一覧へ戻る</a>
        </div>
    </div>
</section>
@endsection