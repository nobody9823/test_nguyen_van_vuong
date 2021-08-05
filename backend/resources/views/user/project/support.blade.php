@extends('user.layouts.base')

@section('content')
<section id="Project-supporter-description" class="section_base">
    <div class="def_inner inner_item">
        <div class="ps_desc_base">
            <div class="tit_L_01 E-font">
                <h2>PROJECT SUPPORTER</h2>
                <div class="sub_tit_L">プロジェクトサポーター(PS)とは</div>
            </div>
            <div class="ps_rank_img m_b_1510">
                <img class="" src="{{ Storage::url(optional($project->projectFiles()->where('file_content_type', 'image_url')->first())->file_url) }}">
            </div>
            <div class="ps_rank_01 m_b_3020">
                <div class="pds_sec01_progress-bar m_b_1510">
                    <div class="progress-bar_par">
                        <div>0%</div>
                        <div>100%</div>
                    </div>
                    <div class="progress-bar">
                        <span style="width: {{ $project->achievement_rate }}%; max-width:100%"></span>
                    </div>
                </div>
                <div class="ps_rank_01_01 m_b_1510">
                    <div>現在：{{ number_format($project->payments_sum_price) }}円</div>
                    <div>支援者数：{{ $project->payments_count }}人</div>
                    <div>募集終了まで残り：{{ $project->number_of_days_left }}日</div>
                </div>
                <!--/ps_rank_01_03-->
                <div class="ps_rank_01_02 m_b_1510">
                    {{ $project->title }}
                </div>
            </div>

            <x-user.invitation-url :project="$project" :rankingButton='true'/>

            <x-user.project.ps-description-left />            
            <!--/ps_desc_L-->
            
            <x-user.project.ps-description-right />            
            <!--/ps_desc_R-->
    
        </div>

        <!--/ps_desc_base-->
    
        {{-- <div class="other_kiji_box m_b_3020">
            <div class="other_kiji_tit_L">最近表示した記事</div>
            <div class="other_kiji_tit"><a href="">支援したプロジェクトが成立した後の流れ</a></div>
            <div class="other_kiji_tit"><a href="">領収書を発行してほしい</a></div>
            <div class="other_kiji_tit"><a href="">支援後に退会（アカウント削除）した場合どうなりますか？</a></div>
        </div><!--/other_kiji_box-->
    
        <div class="other_kiji_box m_b_3020">
            <div class="other_kiji_tit_L">関連記事</div>
            <div class="other_kiji_tit"><a href="">システム利用料について</a></div>
            <div class="other_kiji_tit"><a href="">対応している決済方法について</a></div>
            <div class="other_kiji_tit"><a href="">海外からの支援について</a></div>
            <div class="other_kiji_tit"><a href="">棋譜型クラウドファンディングについて</a></div>
        </div><!--/other_kiji_box--> --}}
    </div>
    <!--/.inner_item-->
    
    {{-- <x-user.invitation-url :project="$project" :rankingButton='true'/> --}}
</section><!--/.section_base-->
@endsection

@section('script')

@endsection
