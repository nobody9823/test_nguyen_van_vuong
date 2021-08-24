<div class="a_report">
  <!-- <div class="pds_sec02_box_base"> -->
    <div class="pds_sec02_box inner_item">
        <div class="pds_sec02_img">
            <img class="" src="{{ Storage::url($report->image_url) }}">
        </div>

        <span class="disclaimer">
            {{ $report->created_at }}
        </span>
        <div>
            <strong>{{ $report->title }}</strong>
        </div>
        <div class="pds_sec02_txt">
            {{ Str::limit($report->content, 200) }}
        </div>
        <div class="ps_rank_more_btn">
            もっと見る <i class="fas fa-chevron-down"></i>
        </div>
    </div>
  <!-- </div> -->
</div>

<style>
  .a_report {
    border-bottom: solid 1px #00AEBD;
    margin-bottom: 70px;
  }

  .a_report .disclaimer {
    opacity: 0.7; 
  }
</style>