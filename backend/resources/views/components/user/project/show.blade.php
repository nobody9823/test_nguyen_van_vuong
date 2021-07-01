<style>
    .liked_project {
        cursor: pointer;
        opacity: 0.8;
        transition: 0.2s;
    }

    .liked_project:hover {
        opacity: 1.0;
    }

    .liked {
        cursor: pointer;
        opacity: 0.7;
        transition: 0.2s;
    }

    .liked:hover {
        opacity: 1.0;
    }
</style>
<div class="content sub_content detail_content">
    <div class="fixedcontainer">
        <div class="breadcrumb">
            <p>
                <a href="/">TOP</a>　＞　<a href="/search">応援プロジェクト</a>　＞　
                @if($project->category)
                <a href="{{ route('user.search', ['category_id' => $project->category_id]) }}">
                    {{ $project->category->name }}
                </a>
                @else
                no category
                @endif
                　＞　{{ $project->title }}
            </p>
        </div>
        <h2 class="sec-ttl">{{ $project->title }}</h2>
        <div class="project-user detail-user"><img
                src="{{ Storage::url($project->user->profile->image_url) }}">{{ $project->user->name }}</div>
        <div class="detail_info">
            <div class="detail_imgs">
                <div class="detail-slider-for">
                    @foreach($project->projectFiles as $project_file)
                    <div><img src="{{ Storage::url($project_file->file_url) }}"></div>
                    @endforeach
                    {{-- @if($project->projectVideo !== null)
                        <div>{{ DisplayVideoHelper::getThumbnail(optional(optional($project)->projectVideo)->video_url) }}
                </div>
                @endif --}}
            </div>
            <div class="detail-slider-nav">
                @foreach($project->projectFiles as $project_file)
                <div><img src="{{ Storage::url($project_file->file_url) }}"></div>
                @endforeach
                {{-- @if($project->projectVideo !== null)
                        <div>{{ DisplayVideoHelper::getThumbnail(optional(optional($project)->projectVideo)->video_url) }}
                @endif --}}
            </div>
        </div>
    </div>
    <div class="detail_info_content">
        <p><i class="far fa-lightbulb pri_color_f i_icon"></i>達成額</p>
        <div><span>{{ $project->getAchievementAmount() }}</span>円</div>
        <p>
            <i class="fas fa-yen-sign pri_color_f i_icon"></i>目標金額 {{ number_format($project->target_amount) }}
            円</p>
        @if($project->getAchievementRate() < 100) <div class="complete">
            <div class="bar" style="width: {{ $project->getAchievementRate() }}%;"></div>
            <div class="complete-text">{{ $project->getAchievementRate()}}%達成</div>
    </div>
    @else
    {{--ここ達成率によってHTML変えるので注意--}}
    <div class="complete_bar">
        <img src="/image/complete-icon.png">{{ $project->getAchievementRate() }}%達成
    </div>
    @endif
    <p><i class="fas fa-hands-helping pri_color_f i_icon"></i>現在の支援者数</p>
    <div><span>{{ $project->getBillingUsersCount() }}人</span></div>
    <p><i class="far fa-clock pri_color_f i_icon"></i>開催期間</p>
    <div>
        {{ $project->getStartDate() }}～<br>{{ $project->getEndDate() }}
    </div>
    <p><i class="fab fa-itunes-note pri_color_f i_icon"></i>アイドル</p>
    <div class="project-user detail-user">
        <img src="{{ Storage::url($project->user->profile->image_url) }}">
        {{ $project->user->name }}
    </div>
    <div class="liked_project" id="{{ $project->id }}">
        @if ($project->likedUsers()->find(Auth::id()) !== null)
        <img src="/image/liked-project-button.png">
        @else
        <img src="/image/like-project-button.png">
        @endif
    </div>
    <div class="plan-btn-wrap">
        <a href="{{ route('user.plan.selectPlans', ['project' => $project]) }}" class="plan-btn">支援する</a>
    </div>
    @if($project->isIncluded() === true)
        <div class="plan-btn-wrap">
            <a href="{{ route('user.project.support', ['project' => $project]) }}">プロジェクトサポーターになる</a>
        </div>
    @endif
</div>
</div>
<div class="detail_tabs">
    <!-- NOTE:今後SNSリンクを使用する場合コメントアウトを解除する -->
    <!-- <div class="detail-sns">
                <a href=""><img src="/image/facebook.png"></a>
                <a href=""><img src="/image/twitter.png"></a>
                <a href=""><img src="/image/line.png"></a>
                <a href=""><img src="/image/instagram.png"></a>
            </div> -->
    <input id="detail_item_01" type="radio" name="detail_tab_item" checked>
    <label class="detail_tab_item" for="detail_item_01">応援概要</label>
    <input id="detail_item_02" type="radio" name="detail_tab_item">
    <label class="detail_tab_item" for="detail_item_02">活動報告</label>
    <input id="detail_item_03" type="radio" name="detail_tab_item">
    <label class="detail_tab_item" for="detail_item_03">支援者ページ</label>

    <div id="detail_tab_line"></div>


    {{--プロジェクト内容--}}
    <div class="detail_tab_content" id="detail_item_01_content">
        <div class="detail_tab_content_description">
            <!--detail_item_01内容-->
            <div class="tabcontent">
                <div class="tab_type1">
                    <div class="about">
                        <h2>応援プロジェクト概要</h2>
                        <section class="project-explanation-detail">
                            <section class="detail-content-section">
                                {{ $project->content }}
                            </section>
                        </section>
                    </div>
                    <div class="plan-div">
                        <h2>応援プラン</h2>
                        @foreach($project->plans as $plan)
                        <x-user.plan-card :plan="$plan" :project="$project" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--活動報告--}}
    <div class="detail_tab_content" id="detail_item_02_content">
        <div class="detail_tab_content_description">
            <!--detail_item_02内容-->
            <div class="tabcontent">
                <div class="tab_type2">
                    <div class="news-list">
                        <h2>活動報告</h2>
                        @foreach($project->reports as $report)
                        <div class="news">
                            <p class="news-date">
                                {{ date_format($report->created_at, 'Y'.'年'.'m'.'月'.'d'.'日') }}</p>
                            <p class="news-ttl">{{ $report->title }}</p>
                            <div class="news-imgs">
                                <div class="news-imgs-for news-imgs-for1">
                                    <div><img src="{{ Storage::url($report->image_url) }}"></div>
                                </div>
                            </div>
                            <div class="news-txt" style="white-space: pre-line;">{{ $report->content }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--支援者ページ--}}
    <div class="detail_tab_content" id="detail_item_03_content">
        @if ($project->isIncluded() === true)
        <div class="detail_tab_content_description">
            @elseif($project->isIncluded() === false)
            <div class="text-center" style="color:#ff1493">
                <h2>※応援プランを支援された方のみ閲覧可能です。</h2>
            </div>
            <div class="detail_tab_content_description" style="-ms-filter: blur(16px); filter: blur(16px);">
                @endif
                <!--detail_item_03内容-->
                <div class="tabcontent">
                    <div class="tab_type3">
                        @if (Auth::guard('web')->user() && $project->comments()->whereIn('payment_id',
                        Auth::user()->payments()->pluck('id')->toArray())->first() === null)
                        <div class="post-form">
                            <div class="text-center" style="color:#ff1493">
                                <h2>※支援者ページへの投稿は一回までです。</h2>
                            </div>
                            <form action="{{ route('user.comment.post', ['project' => $project]) }}"
                                enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="form-group">
                                    <textarea class="form-control" name="content" cols="120"
                                        style="resize: none;"></textarea>
                                </div>
                                <div class="form-grpup">
                                    <input type="file" name="image" id="imageUploader">
                                </div>
                                @if ($project->isIncluded() === true)
                                <div class="plan-btn-wrap" name="image" style="margin-top: 8px;">
                                    <button type="submit" class="plan-btn">支援者ページに投稿する</button>
                                </div>
                                @endif
                            </form>
                        </div>
                        @endif
                        @if ($project->isIncluded() === true)
                        @foreach($project->comments as $comment)
                        <div class="post">
                            <div class="post_in">
                                <p class="post-user">
                                    @if(isset($comment->user->profile->image_url))
                                    <img src="{{ Storage::url($comment->user->profile->image_url) }}">
                                    @else
                                    <img src="/image/user-icon.png">
                                    @endif
                                </p>
                                <div class="post-content">
                                    <p class="post-txt" style="white-space: pre-line;">
                                        {{ $comment->content }}</p>
                                    @if ($comment->reply)
                                    <div class="comment">
                                        <p class="comment-user">
                                            @if(isset($comment->reply->user->profile->image_url))
                                            <img src="{{ Storage::url($comment->reply->user->profile->image_url) }}">
                                            @else
                                            <img src="/image/user-icon.png">
                                            @endif
                                        </p>
                                        <div class="comment-content">
                                            <p class="comment-txt">
                                                {{ $comment->reply->content }}</p>
                                            <p class="comment-date">
                                                {{ date_format($comment->reply->created_at, 'Y'.'年'.'m'.'月'.'d'.'日') }}
                                            </p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @elseif ($project->isIncluded() === false)
                        <div class="post">
                            <p class="post-name">これはサンプルです</p>
                            <div class="post_in">
                                <p class="post-user"><img src="/image/user-icon.png"></p>
                                <div class="post-content">
                                    <p class="post-name">支援者ネーム<span class="post-date">2021年4月1日</span></p>
                                    <p class="post-txt">応援しています!</p>
                                    <p class="post-img"><img src="/image/news-img1.png"></p>
                                    <div class="comment">
                                        <p class="comment-user"><img src="/image/img2.jpg"></p>
                                        <div class="comment-content">
                                            <p class="comment-txt">ありがとうございます!</p>
                                            <p class="comment-date">2021年4月5日</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
