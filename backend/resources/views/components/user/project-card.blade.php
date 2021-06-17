@if (!isset($mypage) & $projects->isEmpty())
<p>条件に一致するプロジェクトがありません。他の条件で検索してください。</p>
@elseif(isset($mypage) & $projects->isEmpty())
<p>お気に入りに登録しているプロジェクトはありません。</p>
@endif
@foreach($projects as $project)
<div class="project-one my-page_project-one project-card-rel">
    <div class="project-img">
        @if($project->category)
        <span class="project-cat">{{ $project->category->name }}</span>
        @else
        <span class="project-cat">no category</span>
        @endif
        <button class="project-like" id="{{ $project->id }}">
            @if ($project->users()->find(Auth::id()) !== null)
            <i class="fas fa-heart project-like-icon"></i>
            @else
            <i class="far fa-heart project-like-icon"></i>
            @endif
        </button>
        @if ($project->projectImages->isNotEmpty())
        <img src="{{ Storage::url($project->projectImages[0]->image_url) }}">
        @endif
    </div>
    <div class="project-content">
        <p class="project-content-ttl"><a href="{{ route('user.project.show', ['project' => $project]) }}">{{ $project->title }}</a></p>
        <div class="project-user">
            <img src="{{ Storage::url($project->talent->image_url) }}">{{ $project->talent->name }}
        </div>
        <ul>
            <li>開始：{{ date($project->start_date) }}</li>
            <li>終了：{{ date($project->end_date) }}</li>
        </ul>
        <div class="process">
            <div class="bar" style="width: {{ $project->getAchievementRate() }}%;">
                <span>{{ $project->getAchievementRate()}}%</span></div>
        </div>
    </div>
    <div class="project-footer">
        @if( date($project->start_date) > now() )
            <div class="project-result-04">公開前</div>
        @elseif(date($project->end_date->subMonth()) < now() && date($project->end_date) > now())
            <div class="project-result-01">締め切り間近</div>
        @elseif ((date($project->start_date) < now() && date($project->end_date) > now()))
            <div class="project-result-03">支援募集中</div>
        @elseif( date($project->end_date) < now() )
            <div class="project-result-02">募集終了</div>
        @endif

        <div class="project-num"><span>支援者数</span>{{ $project->getCheeringUsersCount() }}人</div>
        <div class="project-num"><span>達成額</span>{{ number_format($project->getAchievementAmount()) }}円</div>
        <div class="project-num"><span>目標金額</span>{{ number_format($project->target_amount) }}円</div>
    </div>
</div>
@endforeach
