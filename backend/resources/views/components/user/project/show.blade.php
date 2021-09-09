{{-- <style>
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
</style> --}}
<section class="section_base">

    <div class="pc-Details-screen_base_top inner_item">

        <div class="pds_inner">
            <div class="pds_sec01">

                <div class="pds_sec01_tit">{{ $project->title }}</div><!--/pds_sec01_tit-->
                <div class="pds_sec01_tag">
                    @foreach($project->tags as $tag)
                    <span><a href="{{ route('user.search', ['tag_id' => $tag->id]) }}">#{{ $tag->name }}</a></span>
                    @endforeach
                </div><!--/pds_sec01_tag-->

                <div class="pds_sec01_L">
                    <div class="pds_sec01_slider {{ $project->projectFiles->count() === 1 ? 'slider-img-wrapper' : '' }}">
                        <ul id="slider">
                            @foreach($project->projectFiles as $project_file)
                                @if($project_file->file_content_type === 'image_url')
                                <li class="slide-item">
                                    <img src="{{ Storage::url($project_file->file_url) }}" alt="画像">
                                </li>
                                @elseif($project_file->file_content_type === 'video_url')
                                <li class="slide-item">
                                    {{ DisplayVideoHelper::getVideoAtManage($project_file->file_url) }}
                                </li>
                                @endif
                            @endforeach
                        </ul>
                        @if($project->projectFiles->count() > 1)
                            <ul id="thumbnail_slider">
                                @foreach($project->projectFiles as $project_file)
                                    @if($project_file->file_content_type === 'image_url')
                                    <li class="thumbnail-item">
                                        <img src="{{ Storage::url($project_file->file_url) }}" alt="画像">
                                    </li>
                                    @elseif($project_file->file_content_type === 'video_url')
                                    <li class="thumbnail-item">
                                        {{ DisplayVideoHelper::getVideoAtManage($project_file->file_url) }}
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div><!--/pds_sec01_L-->



                <div class="pds_sec01_R">

                <div class="pds_sec01_R_en01">現在の支援総額</div>
                <div class="pds_sec01_R_en02 E-font">¥ {{ $project->payments_sum_price }}</div>


                <div class="pds_sec01_progress-bar">
                    <div class="progress-bar_par"><div>0%</div><div>100%</div></div>
                    <div class="progress-bar">
                        <span style="width: {{ $project->achievement_rate }}%; max-width:100%"></span>
                    </div>
                </div>

                <div class="pds_sec01_R_en03">目標金額は¥{{ $project->target_amount }}</div>

                <div class="pds_sec01_R_nin_base">
                    <div class="pds_sec01_R_nin01">支援者数</div>
                    <div class="pds_sec01_R_nin02 E-font">{{ $project->payments_count }}<span>人</span></div>
                     <div class="pds_sec01_R_nin03">24時間以内に{{ $project->payments_count_within_a_day }}人からの支援がありました</div>
                </div><!--/pds_sec01_R_nin01-->

                <div class="pds_sec01_R_nokori_base">
                    @if (DateFormat::checkDateIsFuture($project->start_date))
                        <div class="pds_sec01_R_nokori01">募集開始まで残り</div>
                        <div class="pds_sec01_R_nokori02 E-font">
                            {{-- NOTICE: 追加開発が決まったらコメントアウトを外してください --}}
                            {{-- @if (DateFormat::checkDateIsWithInADay($project->start_date))
                                {{ DateFormat::getDiffCompareWithToday($project->start_date) }}<span>時間</span>
                            @else --}}
                                {{ DateFormat::getDiffCompareWithToday($project->start_date) }}<span>日</span>
                            {{-- @endif --}}
                        </div>
                    @elseif (DateFormat::checkDateIsPast($project->start_date) && DateFormat::checkDateIsFuture($project->end_date))
                        <div class="pds_sec01_R_nokori01">募集終了まで残り</div>
                        <div class="pds_sec01_R_nokori02 E-font">
                            {{-- @if (DateFormat::checkDateIsWithInADay($project->end_date))
                                {{ DateFormat::getDiffCompareWithToday($project->end_date) }}<span>時間</span>
                            @else --}}
                                {{ DateFormat::getDiffCompareWithToday($project->end_date) }}<span>日</span>
                            {{-- @endif --}}
                        </div>
                    @elseif (DateFormat::checkDateIsPast($project->end_date))
                        <div class="pds_sec01_R_nokori02"><span>FINISHED</span></div>
                    @endif
                </div><!--/pds_sec01_R_nin01-->

                <div class="pds_sec01_R_btn_base">
                    <div class="pds_sec01_R_btn01_wrapper">
                        @if ($project->end_date > now())
                            <div class="pds_sec01_R_btn01">
                                <div class="more_btn_01_01">支援する</div>
                                <div class="more_btn_01_02"><i class="fas fa-arrow-right"></i></div>
                                <a href="{{ route('user.plan.selectPlans', ['project' => $project, 'inviter_code' => $inviterCode ?? '' ]) }}" class="cover_link"></a>
                            </div>
                        @else
                            <div class="pds_sec01_R_btn01">
                                <div class="more_btn_01_01">FINISHED</div>
                                <div class="more_btn_01_02"><i class="fas fa-arrow-right"></i></div>
                            </div>
                        @endif
                        @isset($project->user->snsLink)
                            @if ($project->user->snsLink->twitter_url)
                            <div class="project_sns_icon">
                                <a href="{{ $project->user->snsLink->twitter_url }}"><img src="{{ asset('image/twitter.png') }}" alt=""></a>
                            </div>
                            @endif
                            @if ($project->user->snsLink->instagram_url)
                            <div class="project_sns_icon">
                                <a href="{{ $project->user->snsLink->instagram_url }}"><img src="{{ asset('image/instagram.png') }}" alt=""></a>
                            </div>
                            @endif
                            @if ($project->user->snsLink->youtube_url)
                            <div class="project_sns_icon">
                                <a href="{{ $project->user->snsLink->youtube_url }}"><img src="{{ asset('image/youtube.png') }}" alt=""></a>
                            </div>
                            @endif
                            @if ($project->user->snsLink->tiktok_url)
                            <div class="project_sns_icon">
                                <a href="{{ $project->user->snsLink->tiktok_url }}"><img src="{{ asset('image/tiktok.png') }}" alt=""></a>
                            </div>
                            @endif
                            @if ($project->user->snsLink->other_url)
                            <div class="project_sns_icon">
                                <a href="{{ $project->user->snsLink->other_url }}"><img src="{{ asset('image/other_sns.png') }}" alt=""></a>
                            </div>
                            @endif
                        @endisset
                    </div>
                    @if($project->isIncluded() === true)
                    <div class="pds_sec01_R_btn01">
                        <div class="more_btn_01_01">プロジェクトサポーターになる</div>
                        <div class="more_btn_01_02"><i class="fas fa-arrow-right"></i></div>
                        <a href="{{ route('user.project.support', ['project' => $project]) }}" class="cover_link"></a>
                    </div>
                    <div class="pds_sec01_R_btn01">
                        <div class="more_btn_01_01">PSランキングを見る</div>
                        <div class="more_btn_01_02"><i class="fas fa-arrow-right"></i></div>
                        <a href="{{ route('user.project.supporter_ranking', ['project' => $project]) }}" class="cover_link"></a>
                    </div>
                    @endif
                </div><!--/pds_sec01_R_nin01-->

                </div><!--/pds_sec01_R-->


            </div><!--/pds_sec01-->
        </div><!--/pds_inner-->
        <div class="project_switch_tabs">
            <div class="project_show_select_tab selected_tab" onClick="switchTabs(this,'#project_content_section')">プロジェクト</div>
            <div class="project_show_select_tab" onClick="switchTabs(this,'#report_section')">活動レポート</div>
            <div class="project_show_select_tab" onClick="switchTabs(this,'#comment_section')">応援コメント</div>
        </div>

    </div><!--/pc-Details-screen_base_top-->

    <div class="pc-Details-screen_base">
        <div class="def_inner">
            <div class="wlr_64">


                <div class="wlr_64_L inner_item tab_contents" id='project_content_section'>
                    <div class="pds_sec02_tit">{{ $project->title }}</div>
                    <div class="pds_sec02_txt">{!! $project->content !!}</div>
                    {{-- <div class="pds_sec02_img"><img class="" src="{{ asset('image/test_img.svg') }}"></div> --}}
                </div><!--/wlr_64_L-->

                <div class="wlr_64_L inner_item tab_contents" id='report_section' style="display:none">
                    <div class="tit_L_01 E-font">
                        <div class="sub_tit_L">活動レポート</div>
                    </div>

                    @if($project->payments->contains('user_id', optional(Auth::user())->id)) 
                    <div>
                        @foreach($project->reports as $report)
                        <x-user.project.report :project="$project" :report="$report" />
                        @endforeach
                    </div>
                    @else
                    <p>プロジェクトを支援した方のみ閲覧可能です。</p>
                    @endif
                </div>

                <div class="wlr_64_L inner_item tab_contents a_comment_list " id='comment_section' style="display:none">
                    <div class="tit_L_01 E-font">
                        {{-- <h2>COMMENTS</h2> --}}
                        <div class="sub_tit_L">コメント一覧</div>
                    </div>
                    <form action="{{ route('user.comment.store',['project' => $project]) }}" method="POST">
                        @csrf
                        <label for="comment_content" id="l_comment_content"></label>
                        <input id="comment_content" name="content" type="text" placeholder="コメントを入力">
                        <div class="text_underline"></div>
                        <div style="text-align: center">
                            <input class="comment_submit_button" type="submit" value="コメントを送信">
                        </div>
                    </form>

                    <div>
                        @foreach($project->comments as $comment)
                        <x-user.project.comment :comment="$comment" />
                        @endforeach
                    </div>
                    <div class="row justify-content-center mb-5" style="margin-top: 5px;">
                        <div class="ps_rank_more_btn" id="comments_more_looking_button">
                            続きを表示 <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="ps_rank_more_btn" id="comments_close_button">
                            表示を少なくする <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>

                </div><!--/wlr_64_L-->


                <div class="wlr_64_R">
                    <div class="pds_sec02_tit inner_item">
                        リターンを選ぶ
                    </div>
                    @foreach($project->plans as $plan)
                    <div class="pds_sec02_box_base">
                        <x-user.plan-card :plan="$plan" :project="$project" :inviterCode="$inviterCode" />
                    </div><!--/pds_sec02_box_base-->
                    @endforeach
                </div><!--/wlr_64_R-->

            </div><!--/wlr_64-->
        </div><!--/def_inner-->


    </div><!--/pc-Details-screen_base-->

</section>

<script src="{{ asset('js/switch-display-style.js') }}"></script>
<script src="{{ asset('js/toggle-class-name.js') }}"></script>
<script src="{{ asset('js/more-looking.js') }}"></script>
<script type="text/javascript">
//タブを押した際にスイッチする用のJS
    window.addEventListener('DOMContentLoaded', () => {
        moreLooking('a_comment', 3, 30, 'comments_more_looking_button','comments_close_button');
    });
    const switchTabs = (el,displaySectionSelector) => {
        switchDisplayStyle('.tab_contents',displaySectionSelector);
        toggleClassName('selected_tab','.project_show_select_tab',el);
    };
</script>
{{-- <div class="content sub_content detail_content">
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
            {{-- </div>
            <div class="detail-slider-nav">
                @foreach($project->projectFiles as $project_file)
                <div><img src="{{ Storage::url($project_file->file_url) }}"></div>
                @endforeach --}}
                {{-- @if($project->projectVideo !== null)
                        <div>{{ DisplayVideoHelper::getThumbnail(optional(optional($project)->projectVideo)->video_url) }}
                @endif --}}
            {{-- </div>
        </div>
    </div>
    <div class="detail_info_content">
        <p><i class="far fa-lightbulb pri_color_f i_icon"></i>達成額</p>
        <div><span>{{ $project->payments_sum_price }}</span>円</div>
        <p>
            <i class="fas fa-yen-sign pri_color_f i_icon"></i>目標金額 {{ number_format($project->target_amount) }}
            円</p>
        @if($project->achievement_rate < 100) <div class="complete">
            <div class="bar" style="width: {{ $project->achievement_rate }}%;"></div>
            <div class="complete-text">{{ $project->achievement_rate}}%達成</div>
    </div>
    @else
    {{--ここ達成率によってHTML変えるので注意--}}
    {{--<div class="complete_bar">
        <img src="/image/complete-icon.png">{{ $project->achievement_rate }}%達成
    </div>
    @endif
    <p><i class="fas fa-hands-helping pri_color_f i_icon"></i>現在の支援者数</p>
    <div><span>{{ $project->payments_count }}人</span></div>
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
        <a href="{{ route('user.plan.selectPlans', ['project' => $project, 'inviter_code' => $inviterCode ?? '' ]) }}" class="plan-btn">支援する</a>
    </div>
    @if($project->isIncluded() === true)
        <div class="plan-btn-wrap">
            <a href="{{ route('user.project.support', ['project' => $project]) }}">プロジェクトサポーターになる</a>
        </div>
    @endif
</div>
</div>
<div class="detail_tabs"> --}}
    <!-- NOTE:今後SNSリンクを使用する場合コメントアウトを解除する -->
    <!-- <div class="detail-sns">
                <a href=""><img src="/image/facebook.png"></a>
                <a href=""><img src="/image/twitter.png"></a>
                <a href=""><img src="/image/line.png"></a>
                <a href=""><img src="/image/instagram.png"></a>
            </div> -->
    {{--<input id="detail_item_01" type="radio" name="detail_tab_item" checked>
    <label class="detail_tab_item" for="detail_item_01">応援概要</label>
    <input id="detail_item_02" type="radio" name="detail_tab_item">
    <label class="detail_tab_item" for="detail_item_02">活動報告</label>
    <input id="detail_item_03" type="radio" name="detail_tab_item">
    <label class="detail_tab_item" for="detail_item_03">支援者ページ</label>

    <div id="detail_tab_line"></div>--}}


    {{--プロジェクト内容--}}
    {{--<div class="detail_tab_content" id="detail_item_01_content">
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
                        <h2>応援リターン</h2>
                        @foreach($project->plans as $plan)
                        <x-user.plan-card :plan="$plan" :project="$project" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- 活動報告
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
    {{--<div class="detail_tab_content" id="detail_item_03_content">
        @if ($project->isIncluded() === true)
        <div class="detail_tab_content_description">
            @elseif($project->isIncluded() === false)
            <div class="text-center" style="color:#ff1493">
                <h2>※応援リターンを支援された方のみ閲覧可能です。</h2>
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
</div>--}}
