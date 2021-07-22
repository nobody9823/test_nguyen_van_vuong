@extends('user.layouts.base')

@section('title', 'マイページ | マイプロジェクト')

@section('content')
<section class="section_base">
    <div class="tit_L_01 E-font">
        <h2>PURCHASE HISTORY</h2>
        <div class="sub_tit_L">購入履歴</div>
    </div>
    <div class="prof_page_base inner_item">
        <x-user.mypage-navigation-bar/>
        @foreach($payments as $payment)
            <div class="prof_page_R">
                <div class="su_pr_base">
                    <div class="su_pr_img m_b_1510"><img class="" src="{{ Storage::url($project->projectFiles()->where('file_content_type', 'image_url')->first()->file_url) }}"></div>
                    <div class="su_pr_01 m_b_1510">
                        <div class="su_pr_01_01 m_b_1510">{{ $project->title }}</div>
                        <div class="su_pr_01_02 m_b_1510">現在の支援総額：{{ number_format($project->payments_sum_price) }}円</div>
                        <div class="pds_sec01_progress-bar m_b_1510">
                            <div class="progress-bar_par"><div>0%</div><div>100%</div></div>
                            <div class="progress-bar">
                                <span style="width: {{ $project->achievement_rate }}%; max-width:100%"></span>
                            </div>
                        </div>
                        <div class="su_pr_01_03 m_b_1510">
                            <div>目標金額は¥{{ number_format($project->target_amount) }}</div>
                            <div>支援者数：{{ $project->supportedUsers()->count() }}</div>
                            @if (DateFormat::getDiffCompareWithToday($project->end_date) > 0)
                                <div>募集終了まで残り：{{ DateFormat::getDiffCompareWithToday($project->end_date) }}日</div>
                            @else
                                <div>募集終了</div>
                            @endif
                        </div><!--/su_pr_01_03-->
                    </div><!--/su_pr_01-->

                    @foreach($payment->includedPlans as $plan)
                        <div class="su_pr_02">
                            <div class="su_pr_02_01 m_b_1510">リターン名</div>
                            <div class="su_pr_02_02 m_b_1510">{{ $plan->title }}</div>
                            <div class="su_pr_02_03 m_b_1510">
                                <div><span>支払い総額</span><br>{{ number_format( $plan->pivot->quantity * $plan->price ) }}円</div>
                                <div><span>商品単価</span><br>{{ number_format( $plan->price ) }}円</div>
                                <div><span>数量</span><br>{{ $plan->pivot->quantity }}個</div>
                            </div><!--/su_pr_02_03-->
                            <div class="su_pr_02_04 m_b_1510">
                                <div>支援日：{{ DateFormat::forJapanese($payment->created_at) }}</div>
                                <div>お届け予定日：{{ DateFormat::forJapanese($plan->delivery_date) }}</div>
                            </div><!--/su_pr_02_04-->
                            <div class="su_pr_02_05 m_b_1510">
                                商品の紹介文：{{ $plan->content }}
                            </div>
                        </div><!--/su_pr_02-->
                    @endforeach
                    <div class="su_pr_more_btn"><a href="">もっと見る　<i class="fas fa-chevron-down"></i></a></div>
                </div><!--/su_pr_base-->
            </div>
        @endforeach
    </div>
    <div class="pager E-font">
        <ul class="pagination">
            @if ($payments->previousPageUrl() !== null)
                <li class="pager_pre"><a href="{{ $payments->previousPageUrl() }}"><span>«</span></a></li>
            @endif
            @foreach ($payments->links()->elements[0] as $key => $link)
                <li><a href="{{ $link }}" class="{{ $payments->currentPage() == $key ? 'pager_active' : ''}}"><span>{{ $key }}</span></a></li>
            @endforeach
            @if ($payments->nextPageUrl() !== null)
                <li class="pager_next"><a href="{{ $payments->nextPageUrl() }}"><span>»</span></a></li>
            @endif
        </ul>
    </div>
</section>
@endsection