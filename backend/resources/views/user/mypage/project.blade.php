@extends('user.layouts.base')

@section('title', 'Dashboard')

@section('content')
<section id="supported-projects" class="section_base">
    <div class="tit_L_01 E-font">
        <h2>PURCHASE PROJECTS</h2>
        <div class="sub_tit_L">応援購入したプロジェクト</div>
    </div>
    <div class="prof_page_base inner_item">
        <div class="prof_page_L">
            <x-user.mypage-navigation-bar/>
        </div><!--/prof_page_L-->


        <div class="prof_page_R">
            <div class="su_pr_tit_L">
                {{-- <select required>
                    <option value="過去3ヶ月">過去3ヶ月</option>
                    <option value="過去3ヶ月">過去3ヶ月</option>
                </select> --}}
            </div><!--/su_pr_tit_L-->

            @foreach($projects as $project)
            <div class="su_pr_base">
                <x-common.mypage.project-information :project="$project" />
                <div class="su_pr_02">
                    <div class="m_b_1510">
                        <div class="def_btn">
                            <a href="{{ route('user.project.support', ['project' => $project]) }}" style="color: white">
                                プロジェクトサポーター(PS)になる
                            </a>
                        </div>
                    </div>
                    <div class="m_b_4030">
                        <div class="def_btn">ランキングを見る
                            <a href="{{ route('user.project.supporter_ranking', ['project' => $project]) }}" class="cover_link"></a>
                        </div>
                    </div>
                </div><!--/su_pr_02-->
            </div><!--/su_pr_base-->
            @endforeach

            <x-common.pagination :props="$projects"/>

        </div><!--/prof_page_R-->
    </div><!--/.prof_page_base-->

    </section><!--/.section_base-->
@endsection
