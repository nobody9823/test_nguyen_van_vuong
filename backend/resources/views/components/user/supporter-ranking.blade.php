@isset($project)
    <section id="Project-supporter-ranking" class="section_base">
        <div class=" def_inner inner_item">

            <div class="prof_page_base_not_flex">

                @isset($usersRankedByTotalQuantity, $usersRankedByTotalQuantity)
                <div class="tit_L_01 E-font">
                    <h2>RANKING</h2>
                    <div class="sub_tit_L">プロジェクトサポーター(PS)ランキング</div>
                </div>
                <div class="ps_rank_base">
                    
                    <div class="ps_rank_img m_b_1510">
                        <img src="{{ Storage::url(optional($project->projectFiles()->where('file_content_type', 'image_url')->first())->file_url) }}">
                    </div>
                    <div class="ps_rank_01 m_b_3020">
                        <div class="pds_sec01_progress-bar m_b_1510">
                            <div class="progress_arrow_box_wrapper">
                                <div class="{{ ProgressBarState::getArrowBoxClassName($project) }}">{{ ProgressBarState::getArrowBoxText($project) }}</div>
                            </div>
                            <div class="progress-bar_par" style="width: {{ $project->achievement_rate }}%; max-width:100%">
                                <div class="{{ ProgressBarState::getNumberClassName($project) }}">
                                    {{ $project->achievement_rate }}%
                                </div>
                            </div>
                            <div class="progress-bar">
                                <span
                                    style="width: {{ $project->achievement_rate }}%; max-width:100%"
                                    class="{{ ProgressBarState::getBarClassName($project) }}"
                                ></span>
                            </div>
                        </div>
                        <div class="ps_rank_01_01 m_b_1510">
                            <!-- <div>現在：{{ number_format($project->payments_sum_price) }}円</div> -->
                            <div>支援者数：{{ $project->payments_count }}人</div>
                            @if (DateFormat::checkDateIsFuture($project->start_date))
                                {{-- NOTICE: 追加開発が決まったらコメントアウトを外してください --}}
                                {{-- @if (DateFormat::checkDateIsWithInADay($project->start_date))
                                    <div style="color: #e65d65;">募集開始まで残り：{{ DateFormat::getDiffCompareWithToday($project->start_date) }}時間</div>
                                @else --}}
                                    <div>募集開始まで残り：{{ DateFormat::getDiffCompareWithToday($project->start_date) }}日</div>
                                {{-- @endif --}}
                            @elseif (DateFormat::checkDateIsPast($project->start_date) && DateFormat::checkDateIsFuture($project->end_date))
                                {{-- @if (DateFormat::checkDateIsWithInADay($project->end_date))
                                    <div style="color: #e65d65;">募集終了まで残り：{{ DateFormat::getDiffCompareWithToday($project->end_date) }}時間</div>
                                @else --}}
                                    <div>募集終了まで残り：{{ DateFormat::getDiffCompareWithToday($project->end_date) }}日</div>
                                {{-- @endif --}}
                            @elseif (DateFormat::checkDateIsPast($project->end_date))
                                <div>募集終了</div>
                            @endif
                        </div>
                        <!--/ps_rank_01_03-->
                        <div class="ps_rank_01_02 m_b_1510">
                            {{ Str::limit($project->title, 46) }}
                        </div>
                    </div>
                </div>
                <!--/ps_rank_base-->

                <div class="m_b_1510">
                    <div class="def_btn">
                        <a href="{{ route('user.project.support', ['project' => $project]) }}" style="color: white">
                            プロジェクトサポーター(PS)になる
                        </a>
                    </div>
                </div>
                <div class="ps_rank_02 m_b_4030">
                    {{-- @php
                        $total_amount_rank = 1;
                        $before_total_amount = null;
                    @endphp
                    @foreach ($usersRankedByTotalAmount as $project_supporter)
                        @php
                            if ($before_total_amount > $project_supporter->invited_payments_sum_price) {
                                $total_amount_rank = $loop->iteration;
                            }
                        @endphp
                        @if ($project_supporter->email === Auth::user()->email)
                            <div class="ps_rank_myrank_large_L m_b_4030">
                                <div class="ps_rank_02_tit">あなたの支援総額ランキング</div>
                                <div class="ps_rank_myrank_large_L_items">
                                    <div class="ps_rank_myrank_large_01">{{ $total_amount_rank }}位</div>
                                    <div class="ps_rank_myrank_large_02">{{ $project_supporter->name }}</div>
                                    <div class="ps_rank_myrank_large_03">
                                        {{ number_format($project_supporter->invited_payments_sum_price) }}円
                                    </div>
                                </div>
                            </div>
                        @endif
                        @php
                            $before_total_amount = $project_supporter->invited_payments_sum_price;
                        @endphp
                    @endforeach --}}

                    @php
                        $total_quantity_rank = 1;
                        $before_total_quantity = null;
                    @endphp
                    @foreach ($usersRankedByTotalQuantity as $rank => $project_supporter)
                        @php
                            if ($before_total_quantity > $project_supporter->invited_payments_count) {
                                $total_quantity_rank = $loop->iteration;
                            }
                        @endphp
                        @if ($project_supporter->email === Auth::user()->email)
                        <div class="ps_rank_myrank_large_R m_b_4030">
                            <div class="ps_rank_02_tit">あなたの紹介人数ランキング</div>
                            <div class="ps_rank_myrank_large_L_items">
                                <div class="ps_rank_myrank_large_01">{{ $total_quantity_rank }}位</div>
                                <div class="ps_rank_myrank_large_02">{{ $project_supporter->name }}</div>
                                <div class="ps_rank_myrank_large_03">
                                    {{ $project_supporter->invited_payments_count }}件
                                </div>
                            </div>
                        </div>
                        @endif
                        @php
                            $before_total_quantity = $project_supporter->invited_payments_count;
                        @endphp
                    @endforeach


                    {{-- <div class="ps_rank_02_L ranked_inviter_by_amount_list">

                        <div class="ps_rank_02_tit">紹介支援総額</div>

                        @php
                            $total_amount_rank = 1;
                            $before_total_amount = null;
                        @endphp
                        @foreach ($usersRankedByTotalAmount as $project_supporter)
                            @php
                                if ($before_total_amount > $project_supporter->invited_payments_sum_price) {
                                    $total_amount_rank = $loop->iteration;
                                }
                            @endphp
                                <div
                                    class="ps_rank_02_rank_item_row ranked_inviter_by_amount {{ $project_supporter->email === Auth::user()->email ? 'ps_rank_item_myrank' : '' }}">
                                    <div class="ps_rank_item_01">
                                        @if ($total_amount_rank === 1)
                                            <x-user.crown ranking="1" size="" />
                                        @elseif($total_amount_rank === 2)
                                            <x-user.crown ranking="2" size="" />
                                        @elseif($total_amount_rank === 3)
                                            <x-user.crown ranking="3" size="" />
                                        @endif
                                    </div>
                                    <div class="ps_rank_item_02">{{ $total_amount_rank }}位</div>
                                    <div class="ps_rank_item_03">{{ $project_supporter->name }}</div>
                                    <div class="ps_rank_item_04">
                                        {{ number_format($project_supporter->invited_payments_sum_price) }}円</div>
                                </div>
                                <!--/ps_rank_02_rank_item_row-->
                            @php
                                $before_total_amount = $project_supporter->invited_payments_sum_price;
                            @endphp
                        @endforeach

                        <div class="row justify-content-center mb-5" style="margin-top: 5px;">
                            <div class="ps_rank_more_btn" id="ranked_inviter_by_amount_more_looking_button">
                                続きの順位を表示 <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="ps_rank_more_btn" id="ranked_inviter_by_amount_closed_button">
                                表示を少なくする <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>

                    </div> --}}

                    <!--/ps_rank_02_L-->

                    <div class="ps_rank_02_R ranked_inviter_of_count_list">

                        <div class="ps_rank_02_tit">紹介人数</div>

                        @php
                            $total_quantity_rank = 1;
                            $before_total_quantity = null;
                        @endphp
                        @foreach ($usersRankedByTotalQuantity as $rank => $project_supporter)
                            @php
                                if ($before_total_quantity > $project_supporter->invited_payments_count) {
                                    $total_quantity_rank = $loop->iteration;
                                }
                            @endphp
                                <div
                                    class="ps_rank_02_rank_item_row ranked_inviter_of_count {{ $project_supporter->email === Auth::user()->email ? 'ps_rank_item_myrank' : '' }}">
                                    <div class="ps_rank_item_01">
                                        @if ($total_quantity_rank === 1)
                                            <x-user.crown ranking="1" size="" />
                                        @elseif($total_quantity_rank === 2)
                                            <x-user.crown ranking="2" size="" />
                                        @elseif($total_quantity_rank === 3)
                                            <x-user.crown ranking="3" size="" />
                                        @endif
                                    </div>
                                    <div class="ps_rank_item_02">{{ $total_quantity_rank }}位</div>
                                    <div class="ps_rank_item_03">{{ $project_supporter->name }}</div>
                                    <div class="ps_rank_item_04">
                                        {{ $project_supporter->invited_payments_count }}人</div>
                                </div>
                                <!--/ps_rank_02_rank_item_row-->
                            @php
                                $before_total_quantity = $project_supporter->invited_payments_count;
                            @endphp
                        @endforeach

                        <div class="row justify-content-center mb-5" style="margin-top: 5px;">
                            <div class="ps_rank_more_btn" id="ranked_inviter_of_count_more_looking_button">
                                続きの順位を表示 <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="ps_rank_more_btn" id="ranked_inviter_of_count_closed_button">
                                表示を少なくする <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                    <!--/ps_rank_02_R-->
                </div>
                @endisset
                <x-user.project.ps-return-toggle :project="$project" />
                <!--/ps_rank_02-->

            </div>
            <!--/.prof_page_base-->

        </div>
        <!--/.inner_item-->
    </section>
    <!--/.section_base-->

    <script src="{{ asset('/js/blade-functions.js') }}"></script>
    <script type="text/javascript">
        window.addEventListener('DOMContentLoaded', () => {
            moreLooking('ranked_inviter_by_amount', 5, 30, 'ranked_inviter_by_amount_more_looking_button',
                'ranked_inviter_by_amount_closed_button');
            moreLooking('ranked_inviter_of_count', 5, 30, 'ranked_inviter_of_count_more_looking_button',
                'ranked_inviter_of_count_closed_button');
        });
    </script>
@else
    <section id="Project-supporter-ranking" class="section_base">
        <div class=" def_inner inner_item">

            <div class="prof_page_base_not_flex">

                <div class="tit_L_01 E-font">
                    <h2>RANKING</h2>
                    <div class="sub_tit_L">プロジェクトサポーター(PS)ランキング</div>
                </div>
                <div class="ps_rank_base">

                    <div class="ps_rank_img m_b_1510">
                        <img class="" src="{{Storage::url('public/sampleImage/now_printing.png')}}">
                    </div>
                    <div class="ps_rank_01 m_b_3020">
                        <div class="pds_sec01_progress-bar m_b_1510">
                            <div class="progress_arrow_box_wrapper">
                                <div class="progress_arrow_box_case_of_achieve_50">第2段階達成！</div>
                            </div>
                            <div class="progress-bar_par" style="width: 60%; max-width:100%">
                                <div class="progress_number_color_case_of_less_than_90">60%</div>
                            </div>
                            <div class="progress-bar">
                                <span
                                    style="width: 60%; max-width:100%"
                                    class="progress_bar_color_case_of_less_than_90"
                                ></span>
                            </div>
                        </div>
                        <div class="ps_rank_01_01 m_b_1510">
                            <div>現在：600,457円</div>
                            <div>支援者数：32人</div>
                            <div>募集終了まで残り：21日</div>
                        </div><!--/ps_rank_01_03-->
                        <div class="ps_rank_01_02 m_b_1510">
                            タイトルテキストタイトルテキストタイトルテキストタイトル
                        </div>
                        <div class="ps_rank_01_03 m_b_1510">
                            テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキ。
                        </div>
                    </div><!--/ps_rank_01-->

                    <div class="m_b_1510" style="margin: 0 auto;">
                        <div class="def_btn">
                            <a style="color: white">
                                プロジェクトサポーター(PS)になる
                            </a>
                        </div>
                    </div>

                    <div class="ps_rank_02 m_b_4030">
                        <div class="ps_rank_myrank_large_R m_b_4030">
                            <div class="ps_rank_02_tit">あなたの紹介人数ランキング</div>
                            <div class="ps_rank_myrank_large_L_items">
                                <div class="ps_rank_myrank_large_01">9位</div>
                                <div class="ps_rank_myrank_large_02">ヤマダタロウ</div>
                                <div class="ps_rank_myrank_large_03">540件</div>
                            </div>
                        </div>

                        <div class="ps_rank_02_R">

                            <div class="ps_rank_02_tit">紹介人数</div>

                            <div class="ps_rank_02_rank_item_row">
                                <div class="ps_rank_item_01">
                                    <x-user.crown ranking="1" size="" />
                                </div>
                                <div class="ps_rank_item_02">1位</div>
                                <div class="ps_rank_item_03">********</div>
                                <div class="ps_rank_item_04">3240件</div>
                            </div><!--/ps_rank_02_rank_item_row-->

                            <div class="ps_rank_02_rank_item_row">
                                <div class="ps_rank_item_01">
                                    <x-user.crown ranking="2" size="" />
                                </div>
                                <div class="ps_rank_item_02">2位</div>
                                <div class="ps_rank_item_03">********</div>
                                <div class="ps_rank_item_04">540件</div>
                            </div><!--/ps_rank_02_rank_item_row-->

                            <div class="ps_rank_02_rank_item_row">
                                <div class="ps_rank_item_01">
                                    <x-user.crown ranking="3" size="" />
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
                            </div><!--/ps_rank_02_rank_item_row-->

                            <div class="ps_rank_more_btn"><a>続きの順位を表示　<i class="fas fa-chevron-down"></i></a></div>

                        </div><!--/ps_rank_02_R-->
                        <x-user.project.ps-return-toggle :project="null" />
                    </div><!--/ps_rank_02-->
                </div><!--/ps_rank_base-->
            </div>
        </div><!--/.inner_item-->
    </section><!--/.section_base-->
@endisset
