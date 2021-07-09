@php
use Carbon\Carbon;
@endphp

@extends('user.layouts.base')

@section('content')

<main>

    <div class="main_inner">
    <section id="pc-top_01" class="section_base">

    <div class="img_box_01">

        <div class="img_box_01_L">
            <div class="img_box_01_L_item">
                <div class="ib01L_01">
                    <img src="{{ Storage::url($projects->first()->projectFiles()->where('file_content_type', 'image_url')->first()->file_url) }}">
                    <a href="{{ route('user.project.show', ['project' => $projects->first()]) }}" class="cover_link"></a>
                    <div class="okini_link_L liked_project" id="{{ $projects->first()->id }}">
                    @if ($user_liked->where('project_id',$projects->first()->id)->isEmpty())
                    <i class="far fa-heart"></i>
                    @else
                    <i class="fas fa-heart"></i>
                    @endif
                    </div>
                </div>

                <div class="ib01L_cate_tag">
                    @foreach($projects->first()->tags as $tag)
                        <a href="#" class="cate_tag_link">{{ $tag->name }}</a>
                    @endforeach
                </div>

                <div class="ib01L_02">
                <div class="progress-bar_par"><div>0%</div><div>100%</div></div>
                    <div class="progress-bar">
                        <span style="width: {{ $projects->first()->getAchievementRate() }}%; max-width:100%"></span>
                    </div>
                </div>

                <div class="ib01L_03">
                    <h2>{{ Str::limit($projects->first()->title, 46) }}</h2>
                    <a href="{{ route('user.project.show', ['project' => $projects->first()]) }}" class="cover_link"></a>
                </div>

                <div class="ib01L_04">
                    <div>現在 <span>{{ number_format($projects->first()->getAchievementAmount()) }}円</span></div>
                    <div>支援者 <span>{{ $projects->first()->getBillingUsersCount() }}人</span></div>
                    <div>残り <span>{{ Carbon::now()->diffInDays(new Carbon($projects->first()->end_date)) }}日</span></div>
                </div>
            </div><!--/.img_box_01_L_item-->
        </div>

        <div class="img_box_01_R">
            @foreach($projects as $project)
                @if(!$loop->first)
                <div class="img_box_01_R_item">
                    <div class="ib01R_01">
                        <img src="{{ Storage::url($project->projectFiles()->where('file_content_type', 'image_url')->first()->file_url) }}">
                        <a href="{{ route('user.project.show', ['project' => $project]) }}" class="cover_link"></a>
                        <div class="okini_link liked_project" id="{{ $project->id }}">
                        @if ($user_liked->where('project_id',$project->id)->isEmpty())
                        <i class="far fa-heart"></i>
                        @else
                        <i class="fas fa-heart"></i>
                        @endif
                        </div>
                    </div>

                    <div class="ib01R_02">
                    <div class="progress-bar_par"><div>0%</div><div>100%</div></div>
                        <div class="progress-bar">
                            <span style="width: {{ $project->getAchievementRate() }}%; max-width:100%"></span>
                        </div>
                    </div>

                    {{-- <div class="process">
                        <div class="bar" style="width: {{ $project->getAchievementRate() }}%;">
                            <span>{{ $project->getAchievementRate()}}%</span></div>
                    </div> --}}

                    <div class="ib01R_03">
                        <h3>{{ Str::limit($project->title, 46) }}</h3>
                        <a href="{{ route('user.project.show', ['project' => $project]) }}" class="cover_link"></a>
                    </div>

                    <div class="ib01R_04">
                        <div>現在 <span>{{ number_format($project->getAchievementAmount()) }}円</span></div>
                        <div>残り <span>{{ Carbon::now()->diffInDays(new Carbon($project->end_date)) }}</span></div>
                    </div>
                </div><!--/.img_box_01_L_item-->
                @endif
            @endforeach
        </div>
    </div><!--/.img_box_01-->

    </section><!--/#pc-top_01-->


    <style>
    .catch_copy_base{ margin: 80px auto 80px auto; position: relative; color:#00aebd; text-align: center; padding: 35px 20px 50px 20px; }
    .ccb_line_01{ position: absolute; background:#00aebd; width: 30%; height: 2px; max-width: 170px; top: 0; right: 0; }
    .ccb_line_02{ position: absolute; background:#00aebd; width: 30%; height: 2px; max-width: 170px; bottom: 15px; left: 0;}
    .ccb_line_03{ position: absolute; background:#00aebd; height: 50%; width: 2px; max-height: 90px; bottom: 0; left: 15px;}
    .catch_copy_01{ padding: 40px ;}
    .catch_copy_txt01{ width: 100%; font-size: 1.4rem;}
    .catch_copy_txt02{ width: 100%; font-size: 2.4rem; font-weight: bold;}
    </style>

    <div class="catch_copy_base">
    <div class="ccb_line_01"></div>
        <div class="ccb_line_02"></div>
        <div class="ccb_line_03"></div>
        <div class="catch_copy_01">
            <div class="catch_copy_txt01">“The influencer’s” want to do “will come true” That is the fan return</div>
            <div class="catch_copy_txt02">”インフルエンサーの「やりたい」が叶う”それがファンリターン</div>
        </div>
    </div>



    <section id="pc-top_02" class="section_base">
        <div class="tit_L_01 E-font"><h2>CATEGORY</h2><div class="sub_tit_L">カテゴリー</div></div>
        <div class="cate_tag_01">
            @foreach($tags as $tag)
            <a href="★" class="cate_tag_link">{{$tag->name}}</a>
            @endforeach
        </div>
    </section><!--/#pc-top_02-->




    {{-- <section id="pc-top_03" class="section_base">
        <div class="tit_L_01 E-font"><h2>PICK UP</h2><div class="sub_tit_L">ピックアップ</div></div>

        <div class="img_box_02">

            <div class="img_box_02_item">
                <div class="ib02_01">
                    <img src="image/test_img.svg">
                    <a href="★" class="cover_link"></a>
                    <a href="★" class="okini_link"><i class="far fa-heart"></i></a>
                </div>

                <div class="ib02_02">
                <div class="progress-bar_par"><div>0%</div><div>100%</div></div>
                    <div class="progress-bar">
                         <span style="width:60%;"></span>
                    </div>
                </div>

                <div class="ib02_03">
                    <h3>タイトルテキストタイトルテキストタイトルテキスト…</h3>
                    <a href="★" class="cover_link"></a>
                </div>

                <div class="ib02_04">
                    <div>現在 <span>600,457円</span></div>
                    <div>残り <span>21日</span></div>
                </div>
            </div><!--/.img_box_01_L_item-->

            <div class="img_box_02_item">
                <div class="ib02_01">
                    <img src="image/test_img.svg">
                    <a href="★" class="cover_link"></a>
                    <a href="★" class="okini_link"><i class="far fa-heart"></i></a>
                </div>

                <div class="ib02_02">
                <div class="progress-bar_par"><div>0%</div><div>100%</div></div>
                    <div class="progress-bar">
                         <span style="width:60%;"></span>
                    </div>
                </div>

                <div class="ib02_03">
                    <h3>タイトルテキストタイトルテキストタイトルテキスト…</h3>
                    <a href="★" class="cover_link"></a>
                </div>

                <div class="ib02_04">
                    <div>現在 <span>600,457円</span></div>
                    <div>残り <span>21日</span></div>
                </div>
            </div><!--/.img_box_01_L_item-->

            <div class="img_box_02_item">
                <div class="ib02_01">
                    <img src="image/test_img.svg">
                    <a href="★" class="cover_link"></a>
                    <a href="★" class="okini_link"><i class="far fa-heart"></i></a>
                </div>

                <div class="ib02_02">
                <div class="progress-bar_par"><div>0%</div><div>100%</div></div>
                    <div class="progress-bar">
                         <span style="width:60%;"></span>
                    </div>
                </div>

                <div class="ib02_03">
                    <h3>タイトルテキストタイトルテキストタイトルテキスト…</h3>
                    <a href="★" class="cover_link"></a>
                </div>

                <div class="ib02_04">
                    <div>現在 <span>600,457円</span></div>
                    <div>残り <span>21日</span></div>
                </div>
            </div><!--/.img_box_01_L_item-->

            <div class="img_box_02_item">
                <div class="ib02_01">
                    <img src="image/test_img.svg">
                    <a href="★" class="cover_link"></a>
                    <a href="★" class="okini_link"><i class="far fa-heart"></i></a>
                </div>

                <div class="ib02_02">
                <div class="progress-bar_par"><div>0%</div><div>100%</div></div>
                    <div class="progress-bar">
                         <span style="width:60%;"></span>
                    </div>
                </div>

                <div class="ib02_03">
                    <h3>タイトルテキストタイトルテキストタイトルテキスト…</h3>
                    <a href="★" class="cover_link"></a>
                </div>

                <div class="ib02_04">
                    <div>現在 <span>600,457円</span></div>
                    <div>残り <span>21日</span></div>
                </div>
            </div><!--/.img_box_01_L_item-->

            <div class="img_box_02_item">
                <div class="ib02_01">
                    <img src="image/test_img.svg">
                    <a href="★" class="cover_link"></a>
                    <a href="★" class="okini_link"><i class="far fa-heart"></i></a>
                </div>

                <div class="ib02_02">
                <div class="progress-bar_par"><div>0%</div><div>100%</div></div>
                    <div class="progress-bar">
                         <span style="width:60%;"></span>
                    </div>
                </div>

                <div class="ib02_03">
                    <h3>タイトルテキストタイトルテキストタイトルテキスト…</h3>
                    <a href="★" class="cover_link"></a>
                </div>

                <div class="ib02_04">
                    <div>現在 <span>600,457円</span></div>
                    <div>残り <span>21日</span></div>
                </div>
            </div><!--/.img_box_01_L_item-->

            <div class="img_box_02_item">
                <div class="ib02_01">
                    <img src="image/test_img.svg">
                    <a href="★" class="cover_link"></a>
                    <a href="★" class="okini_link"><i class="far fa-heart"></i></a>
                </div>

                <div class="ib02_02">
                <div class="progress-bar_par"><div>0%</div><div>100%</div></div>
                    <div class="progress-bar">
                         <span style="width:60%;"></span>
                    </div>
                </div>

                <div class="ib02_03">
                    <h3>タイトルテキストタイトルテキストタイトルテキスト…</h3>
                    <a href="★" class="cover_link"></a>
                </div>

                <div class="ib02_04">
                    <div>現在 <span>600,457円</span></div>
                    <div>残り <span>21日</span></div>
                </div>
            </div><!--/.img_box_01_L_item-->

            <div class="img_box_02_item">
                <div class="ib02_01">
                    <img src="image/test_img.svg">
                    <a href="★" class="cover_link"></a>
                    <a href="★" class="okini_link"><i class="far fa-heart"></i></a>
                </div>

                <div class="ib02_02">
                <div class="progress-bar_par"><div>0%</div><div>100%</div></div>
                    <div class="progress-bar">
                         <span style="width:60%;"></span>
                    </div>
                </div>

                <div class="ib02_03">
                    <h3>タイトルテキストタイトルテキストタイトルテキスト…</h3>
                    <a href="★" class="cover_link"></a>
                </div>

                <div class="ib02_04">
                    <div>現在 <span>600,457円</span></div>
                    <div>残り <span>21日</span></div>
                </div>
            </div><!--/.img_box_01_L_item-->

            <div class="img_box_02_item">
                <div class="ib02_01">
                    <img src="image/test_img.svg">
                    <a href="★" class="cover_link"></a>
                    <a href="★" class="okini_link"><i class="far fa-heart"></i></a>
                </div>

                <div class="ib02_02">
                <div class="progress-bar_par"><div>0%</div><div>100%</div></div>
                    <div class="progress-bar">
                         <span style="width:60%;"></span>
                    </div>
                </div>

                <div class="ib02_03">
                    <h3>タイトルテキストタイトルテキストタイトルテキスト…</h3>
                    <a href="★" class="cover_link"></a>
                </div>

                <div class="ib02_04">
                    <div>現在 <span>600,457円</span></div>
                    <div>残り <span>21日</span></div>
                </div>
            </div><!--/.img_box_01_L_item-->


        </div>

    </section><!--/#pc-top_03--> --}}


    <section id="pc-top_04" class="section_base">
        <div class="tit_L_01 E-font"><h2>RANKING</h2><div class="sub_tit_L">ランキング</div></div>

    <div class="img_box_03">
        <div class="img_box_03_L">
            <div class="img_box_03_L_item">
                <div class="ib03L_01">
                    <img src="{{ Storage::url($projects->first()->projectFiles()->where('file_content_type', 'image_url')->first()->file_url) }}">
                    <a href="{{ route('user.project.show', ['project' => $projects->first()]) }}" class="cover_link"></a>
                    <div class="okini_link_L liked_project" id="{{ $projects->first()->id }}">
                        @if ($user_liked->where('project_id',$projects->first()->id)->isEmpty())
                        <i class="far fa-heart"></i>
                        @else
                        <i class="fas fa-heart"></i>
                        @endif
                    </div>
                </div>

                <div class="ib03L_rank">
                    <div class="ib03L_rank_01">
                    <svg version="1.1" id="レイヤー_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 29.5 21" style="enable-background:new 0 0 29.5 21; width: 30px;" xml:space="preserve">
                    <path id="" class="rank_color_01" d="M11.3,21H3.8c0,0-4.9-14.6-3.6-15.1c0.7-0.3,1.7,0.8,3,1.9c1.1,1.1,2.6,1.8,4.1,2h0.1
                        c0.1,0,0.2,0,0.3,0C11.1,9.2,13,0,14.6,0c0.1,0,0.1,0,0.2,0c0.1,0,0.1,0,0.2,0c1.5,0,3.4,9.2,6.7,9.8c0.1,0,0.2,0,0.3,0H22
                        c1.6-0.2,3-0.9,4.2-2c1.3-1.1,2.4-2.2,3-1.9C30.5,6.4,25.6,21,25.6,21H11.3z"/>
                    </svg></div>
                    <div class="ib03L_rank_02 E-font">1</div>
                    <div class="ib03L_rank_03 E-font"></div>
                </div>

                <div class="ib01L_02">
                <div class="progress-bar_par"><div>0%</div><div>100%</div></div>
                    <div class="progress-bar">
                        <span style="width: {{ $projects->first()->getAchievementRate() }}%; max-width:100%"></span>
                    </div>
                </div>

                <div class="ib03L_03">
                    <h2>{{ Str::limit($projects->first()->title, 46) }}</h2>
                    <a href="{{ route('user.project.show', ['project' => $projects->first()]) }}" class="cover_link"></a>
                </div>

                <div class="ib03L_04">
                    <div>現在 <span>{{ number_format($projects->first()->getAchievementAmount()) }}円</span></div>
                    <div>支援者 <span>{{ $projects->first()->getBillingUsersCount() }}人</span></div>
                    <div>残り <span>{{ Carbon::now()->diffInDays(new Carbon($projects->first()->end_date)) }}日</span></div>
                </div>
            </div><!--/.img_box_03_L_item-->
        </div>

        <div class="img_box_03_R">
            @foreach($ranking_projects as $key => $project)
                @if(!$loop->first)
                <div class="img_box_03_R_item">
                    <div class="ib03R_01">
                        <img src="{{ Storage::url($project->projectFiles->where('file_content_type', 'image_url')->first()->file_url) }}">
                        <a href="{{ route('user.project.show', ['project' => $project]) }}" class="cover_link"></a>
                        <div class="okini_link liked_project" id="{{ $project->id }}">
                        @if ($user_liked->where('project_id',$project->id)->isEmpty())
                        <i class="far fa-heart"></i>
                        @else
                        <i class="fas fa-heart"></i>
                        @endif
                        </div>
                    </div>

                    <div class="ib03R_rank">
                        <div class="ib03R_rank_01">
                        <svg version="1.1" id="レイヤー_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 29.5 21" style="enable-background:new 0 0 29.5 21; width: 23px;" xml:space="preserve">
                        <path id="" class="rank_color_02" d="M11.3,21H3.8c0,0-4.9-14.6-3.6-15.1c0.7-0.3,1.7,0.8,3,1.9c1.1,1.1,2.6,1.8,4.1,2h0.1
                            c0.1,0,0.2,0,0.3,0C11.1,9.2,13,0,14.6,0c0.1,0,0.1,0,0.2,0c0.1,0,0.1,0,0.2,0c1.5,0,3.4,9.2,6.7,9.8c0.1,0,0.2,0,0.3,0H22
                            c1.6-0.2,3-0.9,4.2-2c1.3-1.1,2.4-2.2,3-1.9C30.5,6.4,25.6,21,25.6,21H11.3z"/>
                        </svg></div>
                        <div class="ib03R_rank_02 E-font">{{ $key + 1 }}</div>
                        <div class="ib03R_rank_03 E-font"></div>
                    </div>

                    <div class="ib03R_02">
                    <div class="progress-bar_par"><div>0%</div><div>100%</div></div>
                        <div class="progress-bar">
                            <span style="width: {{ $project->getAchievementRate() }}%; max-width:100%"></span>
                        </div>
                    </div>

                    {{-- <div class="process">
                        <div class="bar" style="width: {{ $project->getAchievementRate() }}%;">
                            <span>{{ $project->getAchievementRate()}}%</span></div>
                    </div> --}}

                    <div class="ib03R_03">
                        <h3>{{ Str::limit($project->title, 46) }}</h3>
                        <a href="{{ route('user.project.show', ['project' => $project]) }}" class="cover_link"></a>
                    </div>

                    <div class="ib03R_04">
                        <div>現在 <span>{{ number_format($project->getAchievementAmount()) }}円</span></div>
                        <div>残り <span>{{ Carbon::now()->diffInDays(new Carbon($project->end_date)) }}</span></div>
                    </div>
                </div><!--/.img_box_01_L_item-->
                @endif
            @endforeach
        </div>
    </div><!--/.img_box_03-->

    <div class="more_btn_01">
        <div class="more_btn_01_01">もっと見る</div>
        <div class="more_btn_01_02"><i class="fas fa-arrow-right"></i></div>
        <a href="#" class="cover_link"></a>
    </div>

    </section><!--/#pc-top_04-->



    <section id="pc-top_04" class="section_base">
        <div class="tit_L_01 E-font"><h2>NEW PROJECT</h2><div class="sub_tit_L">新規プロジェクト</div></div>

        <div class="img_box_02">

                @foreach($projects as $project)
                <div class="img_box_02_item">
                    <div class="ib02_01 new_project_obi E-font">
                        <img src="{{ Storage::url($project->projectFiles()->where('file_content_type', 'image_url')->first()->file_url) }}">
                        <a href="{{ route('user.project.show', ['project' => $project]) }}" class="cover_link"></a>
                        <div class="okini_link liked_project" id="{{ $project->id }}">
                        @if ($user_liked->where('project_id',$project->id)->isEmpty())
                        <i class="far fa-heart"></i>
                        @else
                        <i class="fas fa-heart"></i>
                        @endif
                        </div>
                    </div>

                    <div class="ib02_02">
                    <div class="progress-bar_par"><div>0%</div><div>100%</div></div>
                        <div class="progress-bar">
                             <span style="width: {{ $project->getAchievementRate() }}%; max-width:100%"></span>
                        </div>
                    </div>

                    <div class="ib02_03">
                        <h3>{{ Str::limit($project->title, 46) }}</h3>
                        <a href="{{ route('user.project.show', ['project' => $project]) }}" class="cover_link"></a>
                    </div>

                    <div class="ib02_04">
                        <div>現在 <span>{{ number_format($project->getAchievementAmount()) }}円</span></div>
                        <div>残り <span>{{ Carbon::now()->diffInDays(new Carbon($project->end_date)) }}日</span></div>
                    </div>
                </div><!--/.img_box_01_L_item-->
                @endforeach

            </div>

    <div class="more_btn_01">
        <div class="more_btn_01_01">もっと見る</div>
        <div class="more_btn_01_02"><i class="fas fa-arrow-right"></i></div>
        <a href="★" class="cover_link"></a>
    </div>

    </section><!--/#pc-top_04-->

    </div><!--/main_inner-->
    </main>

    <div class="footer-over_base">
        <a href="{{ route('user.pre_create') }}" class="footer-over_L">
            <div class="footer-over_L_01"><img class="" src="image/new-member-icon.svg"></div>
            <div class="footer-over_L_02">
            <div class="footer-over_L_02_01">New Member Registration</div>
            <div class="footer-over_L_02_02">新規会員登録はこちら</div>
            </div>
            <div class="footer-over_L_03"><i class="fas fa-chevron-right"></i></div>
        </a>

        <a href="#" class="footer-over_R">
            <div class="footer-over_R_01"><img class="" src="image/help-icon.svg"></div>
            <div class="footer-over_R_02">
            <div class="footer-over_R_02_01">Questions / Help</div>
            <div class="footer-over_R_02_02">よくあるご質問・ヘルプ</div>
            </div>
            <div class="footer-over_R_03"><i class="fas fa-chevron-right"></i></div>
        </a>
    </div>
@endsection

@section('script')
<script>
// csrfトークンを下記のproject-liked.jsファイルに送信
window.Laravel = {};
window.Laravel.csrfToken = @json( csrf_token() );
</script>
<script src="{{ asset('/js/project-liked.js') }}"></script>
@endsection