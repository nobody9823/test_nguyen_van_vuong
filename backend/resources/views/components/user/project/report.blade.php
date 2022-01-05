<div class="a_report">
    <div class="pds_sec02_box inner_item">
        <div class="pds_sec02_img">
            <img src="{{ asset(Storage::url($report->image_url)) }}">
        </div>

        <div class="disclaimer">
            {{ $report->created_at }}
        </div>
        <div>
            <strong>{{ $report->title }}</strong>
        </div>
        <div class="pds_sec02_txt">
            {{ Str::limit($report->content, 200) }}
        </div>
        <div class="ps_rank_more_btn">
          <a href="{{ route('user.report.show',['project' => $project, 'report' => $report]) }}">もっと見る <i class="fas fa-chevron-right"></i></a>
        </div>
    </div>
</div>
