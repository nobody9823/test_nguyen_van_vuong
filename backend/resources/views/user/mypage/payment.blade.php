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
        <div class="prof_page_R">
            @foreach($payments as $payment)
                <div class="su_pr_base">
                    <x-common.mypage.project-information :project="$project" />
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
                                <div><span>支払い総額</span><br>{{ number_format( $plan->pivot->quantity * $plan->price ) }}円(税込)</div>
                                <div><span>商品単価</span><br>{{ number_format( $plan->price ) }}円(税込)</div>
                                <div><span>数量</span><br>{{ $plan->pivot->quantity }}個</div>
                            </div><!--/su_pr_02_03-->
                            <div class="su_pr_02_04 m_b_1510">
                                <div>支援日：{{ DateFormat::forJapanese($payment->created_at) }}</div>
                                <div>お届け予定日：{{ $plan->formatted_delivery_date }}</div>
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
            @endforeach
            {{ $payments->appends(request()->input())->onEachSide(1)->links() }}
        </div>
    </div>


</section>
@endsection

<script src={{ asset('/js/blade-functions.js') }}></script>
<script>
    window.addEventListener('load', ()=>{
        omit('more_looking_target',150);
    });
</script>
