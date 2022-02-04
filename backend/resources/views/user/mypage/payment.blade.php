@extends('user.layouts.base')

@section('title', 'マイページ | マイプロジェクト')

@section('content')
<section id="supported-projects" class="section_base">
    <div class="tit_L_01 E-font">
        <h2>PURCHASE HISTORY / PS</h2>
        <div class="sub_tit_L">購入履歴 / PSになる</div>
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
                                <span>オーダーID : </span>{{ $payment->paymentToken->order_id }}
                            </div>
                        </div>
                    </div>
                    @if($payment->payment_way === 'cvs')
                        <div class="su_pr_02">
                            @if($payment->gmo_job_cd === 'EXPIRED')
                            <div class="su_pr_02_04 payment_history_expired_label">
                                <div>
                                    <span>※支払い期限までに支払いが行われなかったため、こちらの決済はキャンセルとなりました。</span>
                                </div>
                            </div>
                            @endif
                            <div class="su_pr_02_04 {{ $payment->gmo_job_cd === 'EXPIRED' ? 'payment_history_expired_label' : '' }}">
                                <div>
                                    <span>支払い期限 : </span>{{ new Carbon\Carbon($payment->payment_term) }}
                                </div>
                                <div>
                                    <span>入金確定日 : </span>{{ $payment->finish_date ? new Carbon\Carbon($payment->finish_date) : '' }}
                                </div>
                            </div>
                            <div class="su_pr_02_04 m_b_1510 {{ $payment->gmo_job_cd === 'EXPIRED' ? 'payment_history_expired_label' : '' }}">
                                <div>
                                    <span>支払い先コンビニ : </span>{{ GMOCvsCode::fromValue($payment->convenience)->key }}
                                </div>
                                <div>
                                    <span>受付番号 : </span>{{ $payment->receipt_no }}
                                </div>
                                <div>
                                    <span>確認番号 : </span>{{ $payment->conf_no }}
                                </div>
                            </div>
                        </div>
                        @endif

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
                                <div>お届け：{{ $plan->formatted_delivery_date }}末までにお届け予定</div>
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
