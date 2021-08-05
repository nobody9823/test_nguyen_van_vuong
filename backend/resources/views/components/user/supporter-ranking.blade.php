<section id="Project-supporter-ranking" class="section_base">
    <div class=" def_inner inner_item">

        <div class="prof_page_base_not_flex">

            <div class="tit_L_01 E-font">
                <h2>RANKING</h2>
                <div class="sub_tit_L">プロジェクトサーポーターランキング</div>
            </div>
            <div class="ps_rank_base">

                <div class="ps_rank_img m_b_1510">
                    <img src="{{ Storage::url(optional($project->projectFiles()->where('file_content_type', 'image_url')->first())->file_url) }}">
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
                    @if ($project_supporter->email === Auth::user()->email)
                        <div class="ps_rank_myrank_large_L m_b_4030">
                            <div class="ps_rank_myrank_large_01">{{ $total_amount_rank }}位</div>
                            <div class="ps_rank_myrank_large_02">{{ $project_supporter->name }}</div>
                            <div class="ps_rank_myrank_large_03">
                                {{ number_format($project_supporter->invited_payments_sum_price) }}円</div>
                        </div>
                    @endif
                    @php
                        $before_total_amount = $project_supporter->invited_payments_sum_price;
                    @endphp
                @endforeach

                @php
                    $total_quantity_rank = 1;
                    $before_total_quantity = null;
                @endphp
                @foreach ($usersRankedByTotalQuantity as $rank => $project_supporter)
                    @php
                        if ($before_total_quantity > $project_supporter->invited_plan_payment_included_sum_quantity) {
                            $total_quantity_rank = $loop->iteration;
                        }
                    @endphp
                    @if ($project_supporter->email === Auth::user()->email)
                        <div class="ps_rank_myrank_large_R m_b_4030">
                            <div class="ps_rank_myrank_large_01">{{ $total_quantity_rank }}位</div>
                            <div class="ps_rank_myrank_large_02">{{ $project_supporter->name }}</div>
                            <div class="ps_rank_myrank_large_03">
                                {{ $project_supporter->invited_plan_payment_included_sum_quantity }}件</div>
                        </div>
                    @endif
                    @php
                        $before_total_quantity = $project_supporter->invited_plan_payment_included_sum_quantity;
                    @endphp
                @endforeach


                <div class="ps_rank_02_L ranked_inviter_by_amount_list">

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

                </div>

                <!--/ps_rank_02_L-->

                <div class="ps_rank_02_R ranked_inviter_of_count_list">

                    <div class="ps_rank_02_tit">紹介件数</div>

                    @php
                        $total_quantity_rank = 1;
                        $before_total_quantity = null;
                    @endphp
                    @foreach ($usersRankedByTotalQuantity as $rank => $project_supporter)
                        @php
                            if ($before_total_quantity > $project_supporter->invited_plan_payment_included_sum_quantity) {
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
                                    {{ $project_supporter->invited_plan_payment_included_sum_quantity }}件</div>
                            </div>
                            <!--/ps_rank_02_rank_item_row-->
                        @php
                            $before_total_quantity = $project_supporter->invited_plan_payment_included_sum_quantity;
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

                <x-user.project.ps-return-toggle :project="$project" />
                <!--/ps_rank_02_R-->
            </div>
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
