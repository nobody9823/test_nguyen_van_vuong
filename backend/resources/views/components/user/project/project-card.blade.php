@isset($project)
    <div class="{{ empty($cardSize) ? 'ib01R_01' : 'ib01L_01' }} {{$newProject()}}">
        <img src="{{ $projectImageUrl() }}">
        <a href="{{ route('user.project.show', ['project' => $project]) }}" class="cover_link"></a>
        <div class="{{ empty($cardSize) ? 'okini_link' : 'okini_link_L' }} liked_project" id="{{ $project->id }}">
        <i class="{{ $userLiked() ? 'far fa-heart' : 'fas fa-heart' }}"></i>
        </div>
    </div>

    @if(!empty($ranking))
    <div class="ib03L_rank">
        <div class="ib03L_rank_01"><x-user.crown :ranking="$ranking" size="large" /></div>
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
@endisset
