@extends('user.layouts.base')

@section('content')

<div class="Assist-input_base">

    <div class="as_header_01">
        <div class="as_header_inner">
            <div class="as_h_01">
                <div class="as_h_01_01"><div class="as_h_01_dotted as_h_01_current"><div></div></div><div class="as_h_01_txt">入力</div></div>
                <div class="as_h_01_02"><div class="as_h_01_dotted"><div></div></div><div class="as_h_01_txt">確認</div></div>
                <div class="as_h_01_03"><div class="as_h_01_dotted"><div></div></div><div class="as_h_01_txt">完了</div></div>
            </div><!--/-->

            <div class="as_h_line"></div><!--/-->
        </div><!--/as_header_inner-->
    </div><!--/as_header-->

    <div class="as_header_02 inner_item">リターンを選択し、必要情報を入力してください</div>
    <form action="{{ route('user.plan.confirmPayment', ['project' => $project, 'inviter_code' => $inviter_code ?? '']) }}" class="h-adr" method="post">
        @csrf
        <input type="hidden" class="p-country-name" value="Japan">
        <!--★選択時 ↓as_select_return　に　asr_currentを追加-->
        @if ($plans instanceof \App\Models\Plan)
            <x-user.plan.plan-payment-card :plan="$plans" />
        @else
            @foreach($project->plans as $plan)
                <x-user.plan.plan-payment-card :plan="$plan" />
            @endforeach
        @endif
        {{-- <!--★通常時-->
        <div class="as_select_return">
            <div class="def_inner inner_item">
                <div class="wlr_64">
                    <div class="wlr_64_L">
                        <div class="as_img"><img class="" src="img/test_img.svg"></div>
                    </div><!--/wlr_64_L-->
                    <div class="wlr_64_R">
                        <div class="as_01">
                            <div class="as_check"><input type="checkbox" id="fcb2_02" class="ac_list_checks"><label for="fcb2_02" class="checkbox-fan_02">2,500円<span>以上</span></label></div>
                        </div>
                        <div class="as_02">
                            <div class="cp_ipselect_02 cp_chb ">
                                <select required>
                                    <option value="" hidden>数量 1</option>
                                    <option value="1">数量 2</option>
                                    <option value="2">数量 3</option>
                                    <option value="3">数量 4</option>
                                    <option value="4">数量 5</option>
                                </select>
                            </div>
                        </div><!--/-->
                        <div class="as_tit">タイトルタイトルタイトルタイトルタイトル</div><!--/-->
                        <div class="as_txt">テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</div>

                        <div class="as_03">
                            <div class="as_shien_nin">支援者 <span>500人</span></div>
                            <div class="as_day">お届け予定 <span>2021年6月下旬</span></div>
                        </div>
                    </div><!--/wlr_64_R-->
                </div><!--/wlr_64-->
            </div><!--/def_inner-->
        </div><!--/as_select_return--> --}}

        <div class=" def_inner" style="padding-bottom: 10px;">
            <div class="as_i_tit inner_item">支援金額</div>
        </div>


            <div class="def_outer_blue">
            <div class=" def_inner inner_item">
                <div class="as_i_01">
                    <div class="as_i_01_L">
                        <div>
                            <div class="as_i_01_L_01">リターン合計金額</div>
                            <div class="as_i_01_L_02 E-font">
                                <input type="number" name="total_amount" id="total_amount" class="pay_input_count" readonly>
                                <span>円</span>
                            </div>
                        </div>
                    </div><!--/.as_i_01_L-->

                    <div class="as_i_01_R">
                        <div>
                            <div class="as_i_01_R_01">上乗せ支援で応援しよう！</div>
                            <div class="as_i_01_R_02 ">
                                    <input type="button" onClick="Plans.subTotalAmount()" class="pay_minus_btn" value="-">
                                    <input type="number" name="display_added_price" id="display_added_price" readonly class="pay_input_count"><span class="pay_input_count_en">円</span>
                                    <input type="button" onClick="Plans.addTotalAmount()" class="pay_plus_btn" value="+">
                                        {{-- <select name="pay_select_count" class=" pay_select_count" style="display: none;">
                                            <option value="100" selected>+100</option>
                                            <option value="1000">+1000</option>
                                            <option value="10000">+10000</option>
                                        </select> --}}
                            </div>
                        </div>
                    </div><!--/.as_i_01_R-->
                </div><!--/.as_i_01-->

            </div><!--/.inner_item-->
            </div><!--/def_outer_blue-->


            <div class=" def_inner inner_item">

                {{-- <div class="as_i_02">
                    <div class="as_i_tit">紹介者コード</div>
                    <div class="as_i_txt">プロジェクトサポーターのから発行されたコードをご入力ください。</div>
                    <input type="text" value="" class="def_input_50p" placeholder="クーポンをお持ちの方はご入力ください">
                </div><!--/.as_i_02--> --}}

                <div class="as_i_03">
                    <div class="as_i_tit">お支払い方法をお選びください <span class="hissu_txt">必須</span></div>

                    <div class="as_i_03_01">

                        <div class="tab_container">
                            <input class="radio-fan" type="radio" id="tab1" name="payment_way" value="credit" onChange="Plans.checkPaymentWay(this)">
                            {{-- <input id="tab1" type="radio" name="tab_item" checked> --}}
                            <label class="tab_item" for="tab1">クレジットカード</label>
                            {{-- <input id="tab2" type="radio" name="tab_item">
                            <label class="tab_item" for="tab2">コンビニ</label>
                            <input id="tab3" type="radio" name="tab_item">
                            <label class="tab_item" for="tab3">銀行振込</label>
                            <input id="tab4" type="radio" name="tab_item">
                            <label class="tab_item" for="tab4">キャリア決済</label> --}}
                            <input class="radio-fan" type="radio" id="tab5" name="payment_way" value="paypay" onChange="Plans.checkPaymentWay(this)">
                            {{-- <input id="tab5" type="radio" name="tab_item"> --}}
                            <label class="tab_item" for="tab5">PayPay</label>
                            {{-- <input id="tab6" type="radio" name="tab_item">
                            <label class="tab_item" for="tab6">楽天ペイ</label> --}}

                            <div class="tab_content" id="tab1_content">
                                <div class="tab_content_description tab1_desc">
                                    <div class="tab1_01">
                                        <div class="tab1_01_01">クレジットカード番号</div>
                                        <div name="number_form" id="number-form" class="payjs-outer"></div>
                                        <span id="errors" style="color: red;"></span>
                                    </div>

                                    <div class="cvc_wrapper">
                                        <div class="tab1_02">
                                            <div class="tab1_02_01">セキュリティコード</div>
                                            <div name="cvc-form" id="cvc-form" class="payjs-outer"></div>
                                        </div>
                                        <div class="tooltip1">
                                            <p>？</p>
                                            <div class="description1">カードの裏面にある末尾3桁の数字</div>
                                        </div>
                                    </div>

                                    <div class="tab1_01">
                                        <div class="tab1_01_01">有効期限</div>
                                        <div name="expiry-form" id="expiry-form" class="payjs-outer"></div>
                                    </div>

                                    {{-- <div class="tab1_04"><input type="checkbox" id="aaa" class="ac_list_checks"><label for="aaa" class="checkbox-fan">このクレジットカード情報を保存する</label></div> --}}

                                    <div class="creca_icon">
                                    <img src="{{ asset('image/credit-card_2.png') }}"><img src="{{ asset('image/credit-card_1.png') }}"><img src="{{ asset('image/credit-card_0.png') }}"><img src="{{ asset('image/credit-card_5.png') }}"><img src="{{ asset('image/credit-card_6.png') }}">
                                    </div>

                                    <div class="tab1_05">
                                    有効期限が残り100日以上のクレジットカード（Visa/Mastercard JCB/Diners Club/American Express）でご利用いただけます。<br>
                                    デビットカード・プリペイドカードの利用は推奨しておりません。<br>
                                    利用される場合は注意事項を必ずご確認ください。<br>
                                    このクレジットカード情報は当社では保持いたしません。
                                    </div>


                                </div>
                            </div><!--/tab_content-->
                            {{-- <div class="tab_content" id="tab2_content">
                                <div class="tab_content_description">
                                <p class="c-txtsp">タブ2の内容</p>
                                </div>
                            </div><!--/tab_content-->
                            <div class="tab_content" id="tab3_content">
                                <div class="tab_content_description">
                                <p class="c-txtsp">タブ3の内容</p>
                                </div>
                            </div><!--/tab_content-->
                            <div class="tab_content" id="tab4_content">
                                <div class="tab_content_description">
                                <p class="c-txtsp">タブ4の内容</p>
                                </div>
                            </div><!--/tab_content--> --}}
                            <div class="tab_content" id="tab5_content">
                                <div class="tab_content_description">
                                <p class="c-txtsp">
                                    PayPayでのお支払い<br/>
                                    以下の必要情報入力後確認画面から「決済する」を押していただくとPayPayの支払い画面へと移動します。
                                </p>
                                </div>
                            </div><!--/tab_content-->
                            {{-- <div class="tab_content" id="tab6_content">
                                <div class="tab_content_description">
                                <p class="c-txtsp">タブ6の内容</p>
                                </div>
                            </div><!--/tab_content--> --}}

                        </div><!--/tab_container-->
                    </div><!--/.as_i_03_01-->

                </div><!--/.as_i_03-->

                <div class="as_i_04">
                    <div class="as_i_tit">必要情報を入力してください</div>
                    <div class="as_i_04_01">プロフィール情報</div>
                    <div class="as_i_txt">「性別」と「生年月日」は公開されません。プロジェクトの集計データとして、プロジェクトオーナーへ提供されます。</div>

                    <div class="as_i_04_02"><span>！</span>必ずお読みください</div>
                    <div class="as_i_txt">
                        決済の領収書などお支払いに関するお問い合わせはこちらへお問い合わせください<br/>
                        株式会社ICH<br/>
                        個人情報保護対応窓口<br/>
                        <a href="href="mailto:support@fanreturn.com">support@fanreturn.com</a>
                    </div>

                </div><!--/.as_i_04-->

            </div><!--/.inner_item-->

            <div class="def_outer_gray">
                <div class=" def_inner inner_item">
                    <input type="hidden" name="payjp_token" id="payjp_token" value="">

                    <div class="form_item_row">
                        <div class="form_item_tit">姓（全角）<span class="hissu_txt">必須</span></div>
                        <input type="text" name="first_name" class="def_input_100p" value="{{ old('first_name', optional($user->profile)->first_name) }}">
                    </div><!--/form_item_row-->

                    <div class="form_item_row">
                        <div class="form_item_tit">名（全角）<span class="hissu_txt">必須</span></div>
                        <input type="text" name="last_name" class="def_input_100p" value="{{ old('last_name', optional($user->profile)->last_name) }}">
                    </div><!--/form_item_row-->

                    <div class="form_item_row">
                        <div class="form_item_tit">セイ（全角）<span class="hissu_txt">必須</span></div>
                        <input type="text" name="first_name_kana" class="def_input_100p" value="{{ old('first_name_kana', optional($user->profile)->first_name_kana) }}">
                    </div><!--/form_item_row-->

                    <div class="form_item_row">
                        <div class="form_item_tit">メイ（全角）<span class="hissu_txt">必須</span></div>
                        <input type="text" name="last_name_kana" class="def_input_100p" value="{{ old('last_name_kana', optional($user->profile)->last_name_kana) }}">
                    </div><!--/form_item_row-->

                    <div class="form_item_row">
                        <div class="form_item_tit">性別<span class="hissu_txt">必須</span></div>
                        <div class="cp_ipselect cp_normal">
                            <select name="gender">
                                <option value="select">選択</option>
                                <option value="男性" {{ old('gender') === "男性" || optional($user->profile)->gender === "男性" ? 'selected' : '' }}>男性</option>
                                <option value="女性" {{ old('gender') === "女性" || optional($user->profile)->gender === "女性" ? 'selected' : '' }}>女性</option>
                                <option value="その他"　{{ old('gender') === "その他" || optional($user->profile)->gender === "その他" ? 'selected' : '' }}>その他</option>
                            </select>
                        </div>
                    </div><!--/form_item_row-->

                    <div class="form_item_row">
                        <div class="form_item_tit">電話番号（ハイフンなし）<span class="hissu_txt">必須</span></div>
                        <input type="number" name="phone_number" class="def_input_100p" value="{{ old('phone_number', optional($user->profile)->phone_number) }}">
                    </div><!--/form_item_row-->

                    <div class="form_item_row">
                        <div class="form_item_tit">郵便番号（ハイフンなし）<span class="hissu_txt">必須</span></div>
                        <input type="number" name="postal_code" onKeyUp="AjaxZip2.zip2addr(this,'prefecture','address');" class="p-postal-code def_input_100p" value="{{ old('postal_code', optional($user->address)->postal_code) }}">
                    </div><!--/form_item_row-->

                    <div class="form_item_row">
                        <div class="form_item_tit">都道府県<span class="hissu_txt">必須</span></div>
                        <div class="cp_ipselect cp_normal">
                            <select name="prefecture" class="p-region">
                                    <option value="non_selected">選択してください</option>
                                @for($i = 1; $i <= 47; $i++)
                                    <option value="{{ PrefectureHelper::getPrefectures()[$i] }}" {{ optional($user->address)->prefecture === PrefectureHelper::getPrefectures()[$i] || old('prefecture') === PrefectureHelper::getPrefectures()[$i] ? 'selected' : '' }}>{{ PrefectureHelper::getPrefectures()[$i] }}</option>
                                @endfor
                            </select>
                        </div>
                    </div><!--/form_item_row-->

                    <div class="form_item_row">
                        <div class="form_item_tit">市区町村<span class="hissu_txt">必須</span></div>
                        <input type="text" name="city" class="p-locality def_input_100p" value="{{ old('city', optional($user->address)->city) }}">
                    </div><!--/form_item_row-->

                    <div class="form_item_row">
                        <div class="form_item_tit">番地<span class="hissu_txt">必須</span></div>
                        <input type="text" name="block" class="p-street-address def_input_100p"  value="{{ old('block', optional($user->address)->block) }}">
                    </div><!--/form_item_row-->

                    <div class="form_item_row">
                        <div class="form_item_tit">建物名<span class="nini_txt">任意</span></div>
                        <input type="text" name="building" class="p-extended-address def_input_100p"  value="{{ old('building', optional($user->address)->building) }}">
                    </div><!--/form_item_row-->

                    <div class="form_item_row">
                        <div class="form_item_tit">生年月日<span class="hissu_txt">必須</span></div>
                        <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
                            <select id="birth_year" class="form-control" name="birth_year">
                                <option value="">----</option>
                                @for ($i = 1980; $i <= 2005; $i++)
                                <option value="{{ $i }}"@if(old('birth_year', optional($user->profile)->getYearOfBirth()) == $i) selected @endif>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
                            <select id="birth_month" class="form-control" name="birth_month">
                                <option value="">--</option>
                                @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}"@if(old('birth_month', optional($user->profile)->getMonthOfBirth()) == $i) selected @endif>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="cp_ipselect cp_normal" >
                            <select id="birth_day" class="form-control" name="birth_day">
                                <option value="">--</option>
                                @for ($i = 1; $i <= 31; $i++)
                                <option value="{{ $i }}"@if(old('birth_day', optional($user->profile)->getDayOfBirth()) == $i) selected @endif>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div><!--/form_item_row-->

                    <div class="form_item_row">
                        <div class="form_item_tit">備考欄<span class="nini_txt">任意</span>　<span style="font-weight: normal;font-size: 1.2rem;">※300文字以内で入力してください</span></div>
                        <textarea name="remarks" class="def_textarea" rows="6">{{ old('remarks') }}</textarea>
                    </div><!--/form_item_row-->

                    <div class="form_item_row">
                        <div class="form_item_tit">応援コメント<span class="nini_txt">任意</span>　<span style="font-weight: normal;font-size: 1.2rem;">※300文字以内で入力してください</span></div>
                        <textarea name="comments" class="def_textarea" rows="6">{{ old('comments') }}</textarea>
                    </div><!--/form_item_row-->
                    <div class="def_btn">
                        <button type="submit" class="disable-btn">
                            <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">確認画面へ</p>
                        </button>
                    </div>

                </div><!--/.inner_item-->
            </div><!--/def_outer_gray-->

        </div>
    </form>
</div>
@endsection

@section('script')
<script src="https://yubinbango.github.io/yubinbango/yubinbango.js" type="text/javascript" charset="UTF-8"></script>
<script>
window.onload = function(){
    if (window.performance.navigation.type == 2){
        Plans.searchCheckedPlans();
    }
}
</script>
<script src="{{ asset('/js/Plans.js') }}"></script>
<script src="https://js.pay.jp/v2/pay.js"></script>
<script>
    var payjp = Payjp('{{ config("app.pay_jp_key_for_test") }}')

    var elements = payjp.elements()

    var errors = document.getElementById('errors');

    let numEl = document.getElementById('number-form')

    let exEl = document.getElementById('expiry-form')

    let cvcEl = document.getElementById('cvc-form')

    const checkCardNumber = (result) => {
        if (result === undefined){
            errors.innerHTML = 'カード情報が不正です。';
            document.querySelector('#payjp_token').value = '';
        } else {
            errors.innerHTML = '';
            document.querySelector('#payjp_token').value = result;
            console.log(document.querySelector('#payjp_token'))
        }
    };

    // 入力フォームを分解して管理・配置できます
    var numberElement = elements.create('cardNumber')
    var expiryElement = elements.create('cardExpiry')
    var cvcElement = elements.create('cardCvc')
    numberElement.mount('#number-form')
    expiryElement.mount('#expiry-form')
    cvcElement.mount('#cvc-form')

    let config = { attribute: true, attributeOldValue: true}

    const observer = new MutationObserver(mutationRecords => {
            for (let MutationRecord of mutationRecords){
                if(MutationRecord.target.classList.contains('PayjpElement--complete')){
                    if (
                            (exEl.classList.contains('PayjpElement--complete')) &&
                            (cvcEl.classList.contains('PayjpElement--complete')) &&
                            (numEl.classList.contains('PayjpElement--complete'))
                        ){
                            payjp.createToken(numberElement).then(function(r) {
                                checkCardNumber(r.id);
                            })
                    }
                }
            }
        });
    observer.disconnect();
    observer.observe(numEl, config);
    observer.observe(exEl, config);
    observer.observe(cvcEl, config);
</script>
@endsection
