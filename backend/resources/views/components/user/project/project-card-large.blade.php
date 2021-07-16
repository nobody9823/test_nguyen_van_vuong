@php
use Carbon\Carbon;
@endphp

<div class="img_box_01_L_item">
    <div class="ib01L_01">
        <img src="{{ Storage::url($projects->first()->projectFiles()->where('file_content_type', 'image_url')->first()->file_url) }}">
        <a href="{{ route('user.project.show', ['project' => $projects->first()]) }}" class="cover_link"></a>
        <div class="okini_link_L liked_project" id="{{ $projects->first()->id }}">
        @if ($userLiked->where('project_id',$projects->first()->id)->isEmpty())
        <i class="far fa-heart"></i>
        @else
        <i class="fas fa-heart"></i>
        @endif
        </div>
    </div>

    {{-- <div class="ib01L_cate_tag">
        @foreach($projects->first()->tags as $tag)
            <a href="#" class="cate_tag_link">{{ $tag->name }}</a>
        @endforeach
    </div> --}}

    <div class="ib01L_02">
    <div class="progress-bar_par"><div>0%</div><div>100%</div></div>
        <div class="progress-bar">
            <span style="width: {{ $projects->first()->achievement_rate }}%; max-width:100%"></span>
        </div>
    </div>

    <div class="ib01L_03">
        <h2>{{ Str::limit($projects->first()->title, 46) }}</h2>
        <a href="{{ route('user.project.show', ['project' => $projects->first()]) }}" class="cover_link"></a>
    </div>

    <div class="ib01L_04">
        <div>現在 <span>{{ number_format($projects->first()->payments_sum_price) }}円</span></div>
        <div>支援者 <span>{{ $projects->first()->payments_count }}人</span></div>
        <div>残り <span>{{ Carbon::now()->diffInDays(new Carbon($projects->first()->end_date)) }}日</span></div>
    </div>
</div><!--/.img_box_01_L_item-->