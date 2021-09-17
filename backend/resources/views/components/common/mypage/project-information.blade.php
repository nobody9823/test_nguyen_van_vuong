<div class="su_pr_img m_b_1510">
    @if ($project->projectFiles()->where('file_content_type', 'image_url')->exists())
        <img src="{{ Storage::url($project->projectFiles()->where('file_content_type', 'image_url')->first()->file_url) }}">
    @elseif($project->projectFiles()->where('file_content_type', 'video_url')->exists())
        <img src="{{ DisplayVideoHelper::getThumbnail($project->projectFiles()->where('file_content_type', 'video_url')->first()->file_url) }}">
    @else
        <img src="{{ Storage::url('public/sampleImage/now_printing.png') }}">
    @endif
</div>
<div class="su_pr_01 m_b_1510">
    <div class="su_pr_01_01 m_b_1510">{{ Str::limit($project->title, 46) }}</div>
    @if($project->user->id === Auth::user()->id)
    <div class="su_pr_01_02 m_b_1510">現在の支援総額：{{ number_format($project->payments_sum_price) }}円</div>
    @endif
    <div class="pds_sec01_progress-bar m_b_1510">
        <div class="progress-bar_par" style="width: {{ $project->achievement_rate }}%; max-width:100%">
            <div class="{{ ProgressBarState::getNumberClassName($project) }}">
                {{ $project->achievement_rate }}%
            </div>
        </div>
        <div class="progress-bar">
            <span
                style="width: {{ $project->achievement_rate }}%; max-width:100%"
                class="{{ ProgressBarState::getBarClassName($project) }}"
            ></span>
        </div>
    </div>
    <div class="su_pr_01_03 m_b_1510">
        <div>目標人数は{{ number_format($project->target_number) }}人</div>
        <div>支援者数：{{ $project->payments_count }}人</div>
        @if (DateFormat::checkDateIsFuture($project->start_date))
            {{-- NOTICE: 追加開発が決まったら以下2箇所とpaymentブレード内のところとDateFormatファサード内のコメントアウトを外してください --}}
            {{-- @if (DateFormat::checkDateIsWithInADay($project->start_date))
                <div style="color: #e65d65;">募集開始まで残り: {{ DateFormat::getDiffCompareWithToday($project->start_date) }}時間</div>
            @else --}}
                <div>募集開始まで残り: {{ DateFormat::getDiffCompareWithToday($project->start_date) }}日</div>
            {{-- @endif --}}
        @elseif (DateFormat::checkDateIsPast($project->start_date) && DateFormat::checkDateIsFuture($project->end_date))
            {{-- @if (DateFormat::checkDateIsWithInADay($project->end_date))
                <div style="color: #e65d65;">募集終了まで残り：{{ DateFormat::getDiffCompareWithToday($project->end_date) }}時間</div>
            @else --}}
                <div>募集終了まで残り：{{ DateFormat::getDiffCompareWithToday($project->end_date) }}日</div>
            {{-- @endif --}}
        @elseif (DateFormat::checkDateIsPast($project->end_date))
            <div>募集終了</div>
        @endif
    </div><!--/su_pr_01_03-->
</div>
