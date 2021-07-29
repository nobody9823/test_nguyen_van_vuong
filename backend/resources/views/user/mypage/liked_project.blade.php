@extends('user.layouts.base')

@section('title', 'Dashboard')

@section('content')

    <section id="pc-top_04" class="section_base">
        <div class="prof_page_base inner_item">
            
            <div class="tit_L_01 E-font"><h2>LIKE PROJECT</h2><div class="sub_tit_L">お気に入りプロジェクト</div></div>
    
            <div class="prof_page_L">
                <x-user.mypage-navigation-bar/>
            </div><!--/prof_page_L-->

            <div class="prof_page_R">
                <div class="img_box_02">
                    @foreach($projects as $project)
                    <div class="img_box_02_item">
                        <x-user.project.project-card :project="$project" :userLiked="$user_liked" cardSize="" ranking="" />
                    </div>
                    @endforeach
                </div>
            </div><!-- /.prof_page_R -->
    
        {{-- <div class="more_btn_01">
            <div class="more_btn_01_01">もっと見る</div>
            <div class="more_btn_01_02"><i class="fas fa-arrow-right"></i></div>
            <a href="★" class="cover_link"></a>
        </div> --}}
        
        </div><!-- /.prof_page_base -->

    </section>
@endsection
