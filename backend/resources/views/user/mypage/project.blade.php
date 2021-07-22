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
                <div class="su_pr_img m_b_1510">
                    <img class="" src="{{ Storage::url($project->projectFiles->first()->file_url) }}">
                </div>
                <div class="su_pr_01 m_b_1510">
                    <div class="su_pr_01_01 m_b_1510">{{ $project->title }}</div>
                    <div class="su_pr_01_02 m_b_1510">現在の支援総額：{{ number_format($project->payments_sum_price) }}円</div>
                    <div class="pds_sec01_progress-bar m_b_1510">
                        <div class="progress-bar_par"><div>0%</div><div>100%</div></div>
                        <div class="progress-bar">
                             <span style="width: {{ $project->achievement_rate }}%; max-width: 100%"></span>
                        </div>
                    </div>
                    <div class="su_pr_01_03 m_b_1510">
                        <div>目標金額は¥{{ number_format($project->target_amount) }}</div>
                        <div>支援者数：{{ $project->payments_count }}人</div>
                        @if($project->number_of_days_left > 0)
                            <div>募集終了まで残り：{{ $project->number_of_days_left }}日</div>
                        @else
                            <div>募集終了</div>
                        @endif
                    </div><!--/su_pr_01_03-->
                </div><!--/su_pr_01-->

                <div class="su_pr_02">
                    <div class="m_b_1510">
                        <div class="def_btn">
                            <a href="{{ route('user.project.support', ['project' => $project]) }}" style="color: white">
                                プロジェクトサポーター(PS)とは
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

            <div class="pager E-font">
                <ul class="pagination">
                    @if ($projects->previousPageUrl() !== null)
                        <li class="pager_pre"><a href="{{ $projects->previousPageUrl() }}"><span>«</span></a></li>
                    @endif
                    @foreach ($projects->links()->elements[0] as $key => $link)
                        <li><a href="{{ $link }}" class="{{ $projects->currentPage() == $key ? 'pager_active' : ''}}"><span>{{ $key }}</span></a></li>
                    @endforeach
                    @if ($projects->nextPageUrl() !== null)
                        <li class="pager_next"><a href="{{ $projects->nextPageUrl() }}"><span>»</span></a></li>
                    @endif
                </ul>
            </div>

        </div><!--/prof_page_R-->
    </div><!--/.prof_page_base-->

    </section><!--/.section_base-->
@endsection
