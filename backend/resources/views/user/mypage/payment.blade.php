@extends('user.layouts.base')

@section('title', 'マイページ | マイプロジェクト')

@section('content')
<section id="supported-projects" class="section_base">
    <div class="tit_L_01 E-font">
        <h2>PURCHASE HISTORY</h2>
        <div class="sub_tit_L">購入履歴</div>
    </div>
    <div class="prof_page_base inner_item">
        <div class="prof_page_L">
            <x-user.mypage-navigation-bar/>
        </div>
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
                            <div>支援者数：{{ $project->payments_count }}</div>
                            @if (DateFormat::checkDateIsPast($project->start_date) && DateFormat::checkDateIsFuture($project->end_date))
                                {{-- NOTICE: 追加開発が決まったらコメントアウトを外してください --}}
                                {{-- @if (DateFormat::checkDateIsWithInADay($project->end_date))
                                    <div style="color: #e65d65;">募集終了まで残り：{{ DateFormat::getDiffCompareWithToday($project->end_date) }}時間</div>
                                @else --}}
                                    <div>募集終了まで残り：{{ DateFormat::getDiffCompareWithToday($project->end_date) }}日</div>
                                {{-- @endif --}}
                            @elseif (DateFormat::checkDateIsPast($project->end_date))
                                <div>募集終了</div>
                            @endif
                        </div><!--/su_pr_01_03-->
                    </div><!--/su_pr_01-->
                    <div class="su_pr_02">
                        <div class="su_pr_02_04 m_b_1510">
                            <div>
                                <span>支援総額 : </span>{{ number_format($payment->price) }}円
                            </div>
                            <div>
                                <span>上乗せ金額 : </span>{{ number_format($payment->added_payment_amount) }}円
                            </div>
                            <div>
                                <span>支援ID : </span>{{ $payment->paymentToken->token }}
                            </div>
                        </div>
                    </div>
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
                                商品の紹介文：
                                <span class="more_looking_target">
                                    {{ $plan->content }}
                                </span>
                            </div>
                        </div><!--/su_pr_02-->
                    @endforeach
                </div><!--/su_pr_base-->
            </div>
        @endforeach
    </div>

    <x-common.pagination :props="$payments"/>

</section>
@endsection

<script src={{ asset('/js/blade-functions.js') }}></script>
<script>
    window.addEventListener('load', ()=>{
        omit('more_looking_target',150);
    });
</script>
