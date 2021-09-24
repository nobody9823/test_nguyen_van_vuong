@php
use Carbon\Carbon;
@endphp

@extends('user.layouts.base')

@section('content')

<main>

    <div class="main_inner main_inner-pt">
    <section id="pc-top_01" class="section_base">

    <div class="img_box_01">
        <div class="img_box_01_L">
            <div class="img_box_01_L_item">
                <x-user.project.project-card :project="$projects->first()" :userLiked="$user_liked" cardSize="large" ranking="" />
            </div>
        </div>

        <div class="img_box_01_R">
            @foreach($projects as $project)
                @if(!$loop->first)
                <div class="img_box_01_R_item">
                    <x-user.project.project-card :project="$project" :userLiked="$user_liked" cardSize="" ranking="" />
                </div>
                @endif
            @endforeach
        </div>
    </div>

    </section>


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
                <a href="{{ route('user.search', ['tag_id' => $tag->id]) }}" class="cate_tag_link">{{$tag->name}}</a>
            @endforeach
        </div>
    </section>



    {{--
    <section id="pc-top_03" class="section_base">
        <div class="tit_L_01 E-font"><h2>PICK UP</h2><div class="sub_tit_L">ピックアップ</div></div>

        <div class="img_box_02">
            @foreach($projects as $project)
            <div class="img_box_02_item">
                <x-user.project.project-card :project="$project" :userLiked="$user_liked" cardSize="" ranking="" />
            </div>
            @endforeach
        </div>

    </section> --}}



    <section id="pc-top_04" class="section_base">
        <div class="tit_L_01 E-font"><h2>RANKING</h2><div class="sub_tit_L">ランキング</div></div>

    <div class="img_box_01">
        <div class="img_box_01_L">
            <div class="img_box_01_L_item">
                <x-user.project.project-card :project="$ranking_projects->first()" :userLiked="$user_liked" cardSize="large" ranking="1" />
            </div>
        </div>

        <div class="img_box_01_R">
            @foreach($ranking_projects as $key => $project)
                @if(!$loop->first)
                <div class="img_box_01_R_item">
                    <x-user.project.project-card :project="$project" :userLiked="$user_liked" cardSize="" :ranking="$key + 1" />
                </div>
                @endif
            @endforeach
        </div>
    </div>

    <div class="more_btn_01">
        <div class="more_btn_01_01">もっと見る</div>
        <div class="more_btn_01_02"><i class="fas fa-arrow-right"></i></div>
        <a href="{{ route('user.search', ['sort_type' => '4']) }}" class="cover_link"></a>
    </div>

    </section>



    <section id="pc-top_04" class="section_base">
        <div class="tit_L_01 E-font"><h2>NEW PROJECT</h2><div class="sub_tit_L">新規プロジェクト</div></div>

        <div class="img_box_02">
            @foreach($new_projects as $project)
            <div class="img_box_02_item">
                <x-user.project.project-card :project="$project" :userLiked="$user_liked" cardSize="" ranking="" />
            </div>
            @endforeach
        </div>

    <div class="more_btn_01">
        <div class="more_btn_01_01">もっと見る</div>
        <div class="more_btn_01_02"><i class="fas fa-arrow-right"></i></div>
        <a href="{{ route('user.search', ['sort_type' => '1']) }}" class="cover_link"></a>
    </div>

    </section>

    <section id="pc-top_04" class="section_base">
        <div class="tit_L_01 E-font"><h2>COMPLETD PROJECT</h2><div class="sub_tit_L">掲載終了プロジェクト</div></div>

        <div class="img_box_02">
            @foreach($complete_projects as $project)
            <div class="img_box_02_item">
                <x-user.project.project-card :project="$project" :userLiked="$user_liked" cardSize="" ranking="" />
            </div>
            @endforeach
        </div>

    {{-- <div class="more_btn_01">
        <div class="more_btn_01_01">もっと見る</div>
        <div class="more_btn_01_02"><i class="fas fa-arrow-right"></i></div>
        <a href="★" class="cover_link"></a>
    </div> --}}

    </section>

    </div><!--/main_inner-->
    </main>

    <x-user.footer-over-base />
@endsection

@section('script')
<script>
// csrfトークンを下記のproject-liked.jsファイルに送信
window.Laravel = {};
window.Laravel.csrfToken = @json( csrf_token() );
</script>
<script src="{{ asset('/js/project-liked.js') }}"></script>
@endsection
