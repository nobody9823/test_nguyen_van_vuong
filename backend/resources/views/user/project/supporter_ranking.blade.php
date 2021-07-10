@extends('user.layouts.base')

@section('content')
<section id="Project-supporter-ranking" class="section_base">
    <div class=" def_inner inner_item">

        <div class="prof_page_base">

            <div class="tit_L_01 E-font"><h2>RANKING</h2><div class="sub_tit_L">プロジェクトサーポーターランキング</div></div>
            <div class="ps_rank_base">

                <div class="ps_rank_img m_b_1510">
                    <img class="" src="{{ Storage::url($project->projectFiles()->where('file_content_type', 'image_url')->first()->file_url) }}">
                </div>
                <div class="ps_rank_01 m_b_3020">
                    <div class="pds_sec01_progress-bar m_b_1510">
                        <div class="progress-bar_par"><div>0%</div><div>100%</div></div>
                        <div class="progress-bar">
                            <span style="width: {{ $project->achievement_rate }}%; max-width:100%"></span>
                        </div>
                    </div>
                    <div class="ps_rank_01_01 m_b_1510">
                        <div>現在：{{ number_format($project->payments_sum_price) }}円</div>
                        <div>支援者数：{{ $project->payments_count }}人</div>
                        <div>募集終了まで残り：{{ $project->number_of_days_left }}日</div>
                    </div><!--/ps_rank_01_03-->
                    <div class="ps_rank_01_02 m_b_1510">
                        {{ $project->title }}
                    </div>
                    <div class="ps_rank_01_03 m_b_1510">
                        {{ $project->content }}
                    </div>
                </div><!--/ps_rank_01-->
                <div class="ps_rank_01 m_b_3020">
                    <div class="ps_rank_01_03 m_b_1510">
                        {{ $project->ps_plan_content }}
                    </div>
                </div>




                <div class="ps_rank_02 m_b_4030">
                    @php
                        $total_amount_rank = 1;
                        $before_total_amount = null;
                    @endphp
                    @foreach($users_ranked_by_total_amount as $project_supporter)
                            @php
                                if ($before_total_amount > $project_supporter->invited_payments_sum_price) {
                                    $total_amount_rank = $loop->iteration;
                                }
                            @endphp
                        @if($project_supporter->email === Auth::user()->email)
                        <div class="ps_rank_myrank_large_L m_b_4030">
                            <div class="ps_rank_myrank_large_01">{{ $total_amount_rank }}位</div>
                            <div class="ps_rank_myrank_large_02">{{ $project_supporter->name }}</div>
                            <div class="ps_rank_myrank_large_03">{{ number_format($project_supporter->invited_payments_sum_price) }}円</div>
                        </div>
                        @endif
                            @php
                                $before_total_amount = $project_supporter->invited_payments_sum_price;
                            @endphp
                    @endforeach

                    @php
                        $users_count_rank = 1;
                        $before_users_count = null;
                    @endphp
                    @foreach($users_ranked_by_users_count as $rank => $project_supporter)
                            @php
                                if ($before_users_count > $project_supporter->invited_payments_count) {
                                    $users_count_rank = $loop->iteration;
                                }
                            @endphp
                        @if($project_supporter->email === Auth::user()->email)
                        <div class="ps_rank_myrank_large_R m_b_4030">
                            <div class="ps_rank_myrank_large_01">{{ $users_count_rank }}位</div>
                            <div class="ps_rank_myrank_large_02">{{ $project_supporter->name }}</div>
                            <div class="ps_rank_myrank_large_03">{{ $project_supporter->invited_payments_count }}件</div>
                        </div>
                        @endif
                            @php
                                $before_users_count = $project_supporter->invited_payments_count;
                            @endphp
                    @endforeach


                    <div class="ps_rank_02_L">

                        <div class="ps_rank_02_tit">紹介支援総額</div>

                        @php
                            $total_amount_rank = 1;
                            $before_total_amount = null;
                        @endphp
                        @foreach($users_ranked_by_total_amount as $project_supporter)
                                @php
                                    if ($before_total_amount > $project_supporter->invited_payments_sum_price) {
                                        $total_amount_rank = $loop->iteration;
                                    }
                                @endphp
                            @if($loop->iteration === 1 || $loop->iteration === 2 || $loop->iteration === 3 || $loop->iteration === 4 || $project_supporter->email === Auth::user()->email || $loop->last)
                            <div class="ps_rank_02_rank_item_row {{ $project_supporter->email === Auth::user()->email ? 'ps_rank_item_myrank' : '' }}">
                                <div class="ps_rank_item_01">
                                    @if($total_amount_rank === 1)
                                        <svg version="1.1" id="" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 29.5 21" style="enable-background:new 0 0 29.5 21; " xml:space="preserve">
                                        <path id="" class="rank_color_01" d="M11.3,21H3.8c0,0-4.9-14.6-3.6-15.1c0.7-0.3,1.7,0.8,3,1.9c1.1,1.1,2.6,1.8,4.1,2h0.1
                                            c0.1,0,0.2,0,0.3,0C11.1,9.2,13,0,14.6,0c0.1,0,0.1,0,0.2,0c0.1,0,0.1,0,0.2,0c1.5,0,3.4,9.2,6.7,9.8c0.1,0,0.2,0,0.3,0H22
                                            c1.6-0.2,3-0.9,4.2-2c1.3-1.1,2.4-2.2,3-1.9C30.5,6.4,25.6,21,25.6,21H11.3z"></path>
                                        </svg>
                                    @elseif($total_amount_rank === 2)
                                        <svg version="1.1" id="" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 29.5 21" style="enable-background:new 0 0 29.5 21; " xml:space="preserve">
                                        <path id="" class="rank_color_02" d="M11.3,21H3.8c0,0-4.9-14.6-3.6-15.1c0.7-0.3,1.7,0.8,3,1.9c1.1,1.1,2.6,1.8,4.1,2h0.1
                                            c0.1,0,0.2,0,0.3,0C11.1,9.2,13,0,14.6,0c0.1,0,0.1,0,0.2,0c0.1,0,0.1,0,0.2,0c1.5,0,3.4,9.2,6.7,9.8c0.1,0,0.2,0,0.3,0H22
                                            c1.6-0.2,3-0.9,4.2-2c1.3-1.1,2.4-2.2,3-1.9C30.5,6.4,25.6,21,25.6,21H11.3z"></path>
                                        </svg>
                                    @elseif($total_amount_rank === 3)
                                        <svg version="1.1" id="" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 29.5 21" style="enable-background:new 0 0 29.5 21; " xml:space="preserve">
                                        <path id="" class="rank_color_03" d="M11.3,21H3.8c0,0-4.9-14.6-3.6-15.1c0.7-0.3,1.7,0.8,3,1.9c1.1,1.1,2.6,1.8,4.1,2h0.1
                                            c0.1,0,0.2,0,0.3,0C11.1,9.2,13,0,14.6,0c0.1,0,0.1,0,0.2,0c0.1,0,0.1,0,0.2,0c1.5,0,3.4,9.2,6.7,9.8c0.1,0,0.2,0,0.3,0H22
                                            c1.6-0.2,3-0.9,4.2-2c1.3-1.1,2.4-2.2,3-1.9C30.5,6.4,25.6,21,25.6,21H11.3z"></path>
                                        </svg>
                                    @endif
                                </div>
                                <div class="ps_rank_item_02">{{ $total_amount_rank }}位</div>
                                <div class="ps_rank_item_03">{{ $project_supporter->name }}</div>
                                <div class="ps_rank_item_04">{{ number_format($project_supporter->invited_payments_sum_price) }}円</div>
                            </div><!--/ps_rank_02_rank_item_row-->
                            @endif
                                @php
                                    $before_total_amount = $project_supporter->invited_payments_sum_price;
                                @endphp
                        @endforeach

                        {{-- <div class="ps_rank_02_rank_item_row">
                            <div class="ps_rank_item_01">
                                <svg version="1.1" id="" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 29.5 21" style="enable-background:new 0 0 29.5 21; " xml:space="preserve">
                                <path id="" class="rank_color_02" d="M11.3,21H3.8c0,0-4.9-14.6-3.6-15.1c0.7-0.3,1.7,0.8,3,1.9c1.1,1.1,2.6,1.8,4.1,2h0.1
                                    c0.1,0,0.2,0,0.3,0C11.1,9.2,13,0,14.6,0c0.1,0,0.1,0,0.2,0c0.1,0,0.1,0,0.2,0c1.5,0,3.4,9.2,6.7,9.8c0.1,0,0.2,0,0.3,0H22
                                    c1.6-0.2,3-0.9,4.2-2c1.3-1.1,2.4-2.2,3-1.9C30.5,6.4,25.6,21,25.6,21H11.3z"></path>
                                </svg>
                            </div>
                            <div class="ps_rank_item_02">2位</div>
                            <div class="ps_rank_item_03">********</div>
                            <div class="ps_rank_item_04">35,000円</div>
                        </div><!--/ps_rank_02_rank_item_row-->

                        <div class="ps_rank_02_rank_item_row">
                            <div class="ps_rank_item_01">
                                <svg version="1.1" id="" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 29.5 21" style="enable-background:new 0 0 29.5 21; " xml:space="preserve">
                                <path id="" class="rank_color_03" d="M11.3,21H3.8c0,0-4.9-14.6-3.6-15.1c0.7-0.3,1.7,0.8,3,1.9c1.1,1.1,2.6,1.8,4.1,2h0.1
                                    c0.1,0,0.2,0,0.3,0C11.1,9.2,13,0,14.6,0c0.1,0,0.1,0,0.2,0c0.1,0,0.1,0,0.2,0c1.5,0,3.4,9.2,6.7,9.8c0.1,0,0.2,0,0.3,0H22
                                    c1.6-0.2,3-0.9,4.2-2c1.3-1.1,2.4-2.2,3-1.9C30.5,6.4,25.6,21,25.6,21H11.3z"></path>
                                </svg>
                            </div>
                            <div class="ps_rank_item_02">3位</div>
                            <div class="ps_rank_item_03">********</div>
                            <div class="ps_rank_item_04">35,000円</div>
                        </div><!--/ps_rank_02_rank_item_row-->

                        <div class="ps_rank_02_rank_item_row">
                            <div class="ps_rank_item_01"></div>
                            <div class="ps_rank_item_02">4位</div>
                            <div class="ps_rank_item_03">********</div>
                            <div class="ps_rank_item_04">35,000円</div>
                        </div><!--/ps_rank_02_rank_item_row-->

                        <div class="ps_rank_02_rank_item_row ps_rank_item_myrank ">
                            <div class="ps_rank_item_01"></div>
                            <div class="ps_rank_item_02">18位</div>
                            <div class="ps_rank_item_03">ヤマダタロウ</div>
                            <div class="ps_rank_item_04">35,000円</div>
                        </div><!--/ps_rank_02_rank_item_row-->

                        <div class="ps_rank_02_rank_item_row">
                            <div class="ps_rank_item_01"></div>
                            <div class="ps_rank_item_02">100位</div>
                            <div class="ps_rank_item_03">********</div>
                            <div class="ps_rank_item_04">35,000円</div>
                        </div><!--/ps_rank_02_rank_item_row--> --}}

                        {{-- <div class="ps_rank_more_btn"><a class="toggle-hidden" style="cursor: pointer">続きの順位を表示　<i class="fas fa-chevron-down"></i></a></div> --}}

                    </div><!--/ps_rank_02_L-->

                    <div class="ps_rank_02_R">


                        <div class="ps_rank_02_tit">紹介件数</div>

                        @php
                            $users_count_rank = 1;
                            $before_users_count = null;
                        @endphp
                        @foreach($users_ranked_by_users_count as $rank => $project_supporter)
                                @php
                                    if ($before_users_count > $project_supporter->invited_payments_count) {
                                        $users_count_rank = $loop->iteration;
                                    }
                                @endphp
                            @if($loop->iteration === 1 || $loop->iteration === 2 || $loop->iteration === 3 || $loop->iteration === 4 || $project_supporter->email === Auth::user()->email || $loop->last)
                            <div class="ps_rank_02_rank_item_row {{ $project_supporter->email === Auth::user()->email ? 'ps_rank_item_myrank' : '' }}">
                                <div class="ps_rank_item_01">
                                    @if($users_count_rank === 1)
                                        <svg version="1.1" id="" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 29.5 21" style="enable-background:new 0 0 29.5 21; " xml:space="preserve">
                                        <path id="" class="rank_color_01" d="M11.3,21H3.8c0,0-4.9-14.6-3.6-15.1c0.7-0.3,1.7,0.8,3,1.9c1.1,1.1,2.6,1.8,4.1,2h0.1
                                            c0.1,0,0.2,0,0.3,0C11.1,9.2,13,0,14.6,0c0.1,0,0.1,0,0.2,0c0.1,0,0.1,0,0.2,0c1.5,0,3.4,9.2,6.7,9.8c0.1,0,0.2,0,0.3,0H22
                                            c1.6-0.2,3-0.9,4.2-2c1.3-1.1,2.4-2.2,3-1.9C30.5,6.4,25.6,21,25.6,21H11.3z"></path>
                                        </svg>
                                    @elseif($users_count_rank === 2)
                                        <svg version="1.1" id="" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 29.5 21" style="enable-background:new 0 0 29.5 21; " xml:space="preserve">
                                        <path id="" class="rank_color_02" d="M11.3,21H3.8c0,0-4.9-14.6-3.6-15.1c0.7-0.3,1.7,0.8,3,1.9c1.1,1.1,2.6,1.8,4.1,2h0.1
                                            c0.1,0,0.2,0,0.3,0C11.1,9.2,13,0,14.6,0c0.1,0,0.1,0,0.2,0c0.1,0,0.1,0,0.2,0c1.5,0,3.4,9.2,6.7,9.8c0.1,0,0.2,0,0.3,0H22
                                            c1.6-0.2,3-0.9,4.2-2c1.3-1.1,2.4-2.2,3-1.9C30.5,6.4,25.6,21,25.6,21H11.3z"></path>
                                        </svg>
                                    @elseif($users_count_rank === 3)
                                        <svg version="1.1" id="" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 29.5 21" style="enable-background:new 0 0 29.5 21; " xml:space="preserve">
                                        <path id="" class="rank_color_03" d="M11.3,21H3.8c0,0-4.9-14.6-3.6-15.1c0.7-0.3,1.7,0.8,3,1.9c1.1,1.1,2.6,1.8,4.1,2h0.1
                                            c0.1,0,0.2,0,0.3,0C11.1,9.2,13,0,14.6,0c0.1,0,0.1,0,0.2,0c0.1,0,0.1,0,0.2,0c1.5,0,3.4,9.2,6.7,9.8c0.1,0,0.2,0,0.3,0H22
                                            c1.6-0.2,3-0.9,4.2-2c1.3-1.1,2.4-2.2,3-1.9C30.5,6.4,25.6,21,25.6,21H11.3z"></path>
                                        </svg>
                                    @endif
                                </div>
                                <div class="ps_rank_item_02">{{ $users_count_rank }}位</div>
                                <div class="ps_rank_item_03">{{ $project_supporter->name }}</div>
                                <div class="ps_rank_item_04">{{ $project_supporter->invited_payments_count }}件</div>
                            </div><!--/ps_rank_02_rank_item_row-->
                            @endif
                                @php
                                    $before_users_count = $project_supporter->invited_payments_count;
                                @endphp
                        @endforeach

                        {{-- <div class="ps_rank_02_rank_item_row">
                            <div class="ps_rank_item_01">
                                <svg version="1.1" id="" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 29.5 21" style="enable-background:new 0 0 29.5 21; " xml:space="preserve">
                                <path id="" class="rank_color_02" d="M11.3,21H3.8c0,0-4.9-14.6-3.6-15.1c0.7-0.3,1.7,0.8,3,1.9c1.1,1.1,2.6,1.8,4.1,2h0.1
                                    c0.1,0,0.2,0,0.3,0C11.1,9.2,13,0,14.6,0c0.1,0,0.1,0,0.2,0c0.1,0,0.1,0,0.2,0c1.5,0,3.4,9.2,6.7,9.8c0.1,0,0.2,0,0.3,0H22
                                    c1.6-0.2,3-0.9,4.2-2c1.3-1.1,2.4-2.2,3-1.9C30.5,6.4,25.6,21,25.6,21H11.3z"></path>
                                </svg>
                            </div>
                            <div class="ps_rank_item_02">2位</div>
                            <div class="ps_rank_item_03">********</div>
                            <div class="ps_rank_item_04">540件</div>
                        </div><!--/ps_rank_02_rank_item_row-->

                        <div class="ps_rank_02_rank_item_row">
                            <div class="ps_rank_item_01">
                                <svg version="1.1" id="" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 29.5 21" style="enable-background:new 0 0 29.5 21; " xml:space="preserve">
                                <path id="" class="rank_color_03" d="M11.3,21H3.8c0,0-4.9-14.6-3.6-15.1c0.7-0.3,1.7,0.8,3,1.9c1.1,1.1,2.6,1.8,4.1,2h0.1
                                    c0.1,0,0.2,0,0.3,0C11.1,9.2,13,0,14.6,0c0.1,0,0.1,0,0.2,0c0.1,0,0.1,0,0.2,0c1.5,0,3.4,9.2,6.7,9.8c0.1,0,0.2,0,0.3,0H22
                                    c1.6-0.2,3-0.9,4.2-2c1.3-1.1,2.4-2.2,3-1.9C30.5,6.4,25.6,21,25.6,21H11.3z"></path>
                                </svg>
                            </div>
                            <div class="ps_rank_item_02">3位</div>
                            <div class="ps_rank_item_03">********</div>
                            <div class="ps_rank_item_04">540件</div>
                        </div><!--/ps_rank_02_rank_item_row-->

                        <div class="ps_rank_02_rank_item_row">
                            <div class="ps_rank_item_01"></div>
                            <div class="ps_rank_item_02">4位</div>
                            <div class="ps_rank_item_03">********</div>
                            <div class="ps_rank_item_04">540件</div>
                        </div><!--/ps_rank_02_rank_item_row-->

                        <div class="ps_rank_02_rank_item_row ps_rank_item_myrank ">
                            <div class="ps_rank_item_01"></div>
                            <div class="ps_rank_item_02">9位</div>
                            <div class="ps_rank_item_03">ヤマダタロウ</div>
                            <div class="ps_rank_item_04">540件</div>
                        </div><!--/ps_rank_02_rank_item_row-->

                        <div class="ps_rank_02_rank_item_row">
                            <div class="ps_rank_item_01"></div>
                            <div class="ps_rank_item_02">100位</div>
                            <div class="ps_rank_item_03">********</div>
                            <div class="ps_rank_item_04">540件</div>
                        </div><!--/ps_rank_02_rank_item_row--> --}}

                        {{-- <div class="ps_rank_more_btn"><a href="">続きの順位を表示　<i class="fas fa-chevron-down"></i></a></div> --}}

                    </div><!--/ps_rank_02_R-->
                </div><!--/ps_rank_02-->
            </div><!--/ps_rank_base-->

        </div><!--/.prof_page_base-->

    </div><!--/.inner_item-->
</section><!--/.section_base-->
@endsection
