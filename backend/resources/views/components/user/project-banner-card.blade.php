<div class="section">
    <div class="fixedcontainer">
        <h2 class="sec-ttl">{{ $sectionTitle }}</h2>
        <div class="project-banner-slider">
            @foreach($props as $prop)
            <div>
                <a class="project-banner" href="{{ route('user.project.show', ['project' => $prop]) }}">
                    <div class="project-banner-img">
                        @foreach($prop->tags as $tag)
                        <span class="project-banner-cat">{{ $tag->name }}</span>
                        @endforeach
                        @if ($prop->projectFiles->isNotEmpty())
                        <img src="{{ Storage::url($prop->projectFiles[0]->image_url) }}">
                        @endif
                    </div>
                    <div class="roject-banner-content">
                        <p class="project-banner-ttl">{{ $prop->title }}</p>
                        <div class="project-user">
                            <img src="{{ Storage::url($prop->user->image_url) }}">{{ $prop->user->name }}
                        </div>
                        <ul>
                            <li>開始：{{ date($prop->start_date) }}</li>
                            <li>終了：{{ date($prop->end_date) }}</li>
                        </ul>
                        <div class="process">
                            <div class="bar" style="width: {{ $prop->getAchievementRate() }}%;">
                                <span>{{ $prop->getAchievementRate()}}%</span></div>
                        </div>
                    </div>
                    <div class="project-footer">
                        @if( date($prop->start_date) > now() )
                            <div class="project-result-04">公開前</div>
                        @elseif(date($prop->end_date->subWeek(1)) < now() && date($prop->end_date) > now())
                            <div class="project-result-01">締め切り間近</div>
                        @elseif ((date($prop->start_date) < now() && date($prop->end_date) > now()))
                            <div class="project-result-03">支援募集中</div>
                        @elseif( date($prop->end_date) < now() )
                            <div class="project-result-02">募集終了</div>
                        @endif

                        <div class="project-num"><span>支援者数</span>{{ $prop->getBillingUsersCount() }}人</div>
                        <div class="project-num"><span>達成額</span>{{ number_format($prop->getAchievementAmount()) }}円</div>
                        <div class="project-num"><span>目標金額</span>{{ number_format($prop->target_amount) }}円</div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
