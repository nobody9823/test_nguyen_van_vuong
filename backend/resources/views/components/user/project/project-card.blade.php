<div class="{{ empty($cardSize) ? 'ib01R_01' : 'ib01L_01' }} {{$newProject()}}">
    <img src="{{ $projectImageUrl() }}">
    <a href="{{ route('user.project.show', ['project' => $project]) }}" class="cover_link"></a>
    <div class="{{ empty($cardSize) ? 'okini_link' : 'okini_link_L' }} liked_project" id="{{ $project->id }}">
    <i class="{{ $userLiked() ? 'far fa-heart' : 'fas fa-heart' }}"></i>
    </div>
</div>

@if(!empty($ranking))
<div class="ib03L_rank">
    <div class="ib03L_rank_01">
    <svg version="1.1" id="レイヤー_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 29.5 21" style="enable-background:new 0 0 29.5 21; width: 28px;" xml:space="preserve">
    <path id="" class="{{ 'rank_color_0'.$ranking }}" d="M11.3,21H3.8c0,0-4.9-14.6-3.6-15.1c0.7-0.3,1.7,0.8,3,1.9c1.1,1.1,2.6,1.8,4.1,2h0.1
        c0.1,0,0.2,0,0.3,0C11.1,9.2,13,0,14.6,0c0.1,0,0.1,0,0.2,0c0.1,0,0.1,0,0.2,0c1.5,0,3.4,9.2,6.7,9.8c0.1,0,0.2,0,0.3,0H22
        c1.6-0.2,3-0.9,4.2-2c1.3-1.1,2.4-2.2,3-1.9C30.5,6.4,25.6,21,25.6,21H11.3z"/>
    </svg></div>
    <div class="ib03L_rank_02 E-font">{{ $ranking }}</div>
    <div class="ib03L_rank_03 E-font"></div>
</div>
@endif

@if(!empty($cardSize) && empty($ranking))
<div class="ib01L_cate_tag">
    @foreach($project->tags as $tag)
        <a href="#" class="cate_tag_link">{{ $tag->name }}</a>
    @endforeach
</div>
@endif

<div class="{{ empty($cardSize) ? 'ib01R_02' : 'ib01L_02' }}">
<div class="progress-bar_par"><div>0%</div><div>100%</div></div>
    <div class="progress-bar">
        <span style="width: {{ $project->achievement_rate }}%; max-width:100%"></span>
    </div>
</div>

<div class="{{ empty($cardSize) ? 'ib01R_03' : 'ib01L_03' }}">
    <h2>{{ Str::limit($project->title, 46) }}</h2>
    <a href="{{ route('user.project.show', ['project' => $project]) }}" class="cover_link"></a>
</div>

<div class="{{ empty($cardSize) ? 'ib01R_04' : 'ib01L_04' }}">
    <div>現在 <span>{{ number_format($project->payments_sum_price) }}円</span></div>
    <div>支援者 <span>{{ $project->payments_count }}人</span></div>
    <div>残り <span>{{ $daysLeft() }}日</span></div>
</div>
