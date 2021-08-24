@extends('user.layouts.base')

@section('content')
<div class="a_report_detail">
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
        <div style="white-space: pre-line;">{{ Str::limit($report->content, 200) }}</div>
        <div>
           <a href="javascript: history.back()"><i class="fas fa-chevron-left"></i> 活動報告一覧へ戻る</a>
        </div>
    </div>
</div>
@endsection

<style>
  .a_report_detail {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    width: 100%;
  }

  .a_report_detail .content {
    display: flex;
    flex-direction: column;
    width: 60%;
  }

  .a_report_detail .content strong {
    font-size: 125%;
  }

  .a_report_detail .content div {
    margin: 15px 0;
  }
  
  .a_report_detail .content div:nth-child(5) {
    margin: 60px 0;
  }

  .a_report_detail .pds_sec02_img img {
    max-width: 100%;
    max-height: none;
    width: 100%;
    height: auto;
  }

  @media (max-width: 767px) {
    .a_report_detail .content { width: 90%; font-size: 85%; }
  }
</style>