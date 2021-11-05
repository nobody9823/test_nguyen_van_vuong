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
    <form action="{{ route('user.plan.confirmPayment', ['project' => $project, 'inviter_code' => $inviter_code ?? '']) }}" class="h-adr" onsubmit="return onSubmit(this)" method="post">
        @csrf
        <input type="hidden" class="p-country-name" value="Japan">
        <!--★選択時 ↓as_select_return　に　asr_currentを追加-->
        @if ($plans instanceof \App\Models\Plan)
            <x-user.plan.plan-payment-card :plan="$plans" isSelected="1" />
        @else
            @foreach($project->plans as $plan)
                <x-user.plan.plan-payment-card :plan="$plan" isSelected="0" />
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
                            <input class="radio-fan" type="radio" id="tab1" name="payment_way" value="credit" checked>
                            {{-- <input id="tab1" type="radio" name="tab_item" checked> --}}
                            <label class="tab_item" for="tab1">クレジットカード</label>
                            {{-- <input id="tab2" type="radio" name="tab_item">
                            <label class="tab_item" for="tab2">コンビニ</label>
                            <input id="tab3" type="radio" name="tab_item">
                            <label class="tab_item" for="tab3">銀行振込</label>
                            <input id="tab4" type="radio" name="tab_item">
                            <label class="tab_item" for="tab4">キャリア決済</label> --}}
                            {{-- <input class="radio-fan" type="radio" id="tab5" name="payment_way" value="paypay"> --}}
                            {{-- <input id="tab5" type="radio" name="tab_item"> --}}
                            {{-- <label class="tab_item" for="tab5">PayPay</label> --}}
                            {{-- <input id="tab6" type="radio" name="tab_item">
                            <label class="tab_item" for="tab6">楽天ペイ</label> --}}

                            <div class="tab_content" id="tab1_content">
                                <div class="tab_content_description tab1_desc">
                                    <div class="tab1_01">
                                        <div class="tab1_01_01">クレジットカード番号</div>
                                        <div name="number_form" id="number-form"></div>
                                        <span id="number_errors" style="color: red;"></span>
                                    </div>

                                    <div class="tab1_01">
                                        <div class="tab1_01_01">セキュリティコード</div>
                                        <div class="cvc-wrapper">
                                            <div name="cvc-form" id="cvc-form" class="cvc_form"></div>
                                            <div class="tooltip1">
                                                <p>？</p>
                                                <div class="description1">カードの裏面にある末尾3桁の数字</div>
                                            </div>
                                        </div>
                                        <span id="cvc_errors" style="color: red;"></span>
                                    </div>

                                    <div class="tab1_01">
                                        <div class="tab1_01_01">有効期限</div>
                                        <div name="expiry-form" id="expiry-form"></div>
                                        <span id="expiry_errors" style="color: red;"></span>
                                    </div>
                                </div>

                                {{-- <div class="tab1_04"><input type="checkbox" id="aaa" class="ac_list_checks"><label for="aaa" class="checkbox-fan">このクレジットカード情報を保存する</label></div> --}}

                                <div class="creca_icon">
                                <img src="{{ asset('image/credit-card_2.png') }}">
                                <img src="{{ asset('image/credit-card_1.png') }}">
                                <img src="{{ asset('image/credit-card_0.png') }}">
                                <img src="{{ asset('image/credit-card_5.png') }}">
                                <img src="{{ asset('image/credit-card_6.png') }}">
                                <img src="{{ asset('image/credit-card_14.png') }}">
                                </div>

                                <div class="tab1_05">
                                有効期限が残り100日以上のクレジットカード（Visa/Mastercard/JCB/American Express/Diners Club/Discover）でご利用いただけます。<br>
                                デビットカード・プリペイドカードの利用は推奨しておりません。<br>
                                利用される場合は注意事項を必ずご確認ください。<br>
                                このクレジットカード情報は当社では保持いたしません。<br>
                                <span style="color: red;">各決済ごとの領収書発行機能は提供しておりません。利用元のクレジットカード明細のご確認をお願いいたします。</span>
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
                                    以下の必要情報入力後確認画面から「決済する」を押していただくとPayPayの支払い画面へと移動します。<br>
                                    <span style="color: red;">バーコードまたはQRコードで支払いした領収書は発行しておりません。<br>
                                    実際にPayPayを利用してお支払いをした店舗でご相談ください。<br>
                                    なお、「請求書払い」をご利用の場合は、請求書発行元にお問い合わせください。</span>
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
                        <a href="mailto:support@fanreturn.com">support@fanreturn.com</a>
                    </div>

                </div><!--/.as_i_04-->

            </div><!--/.inner_item-->

            <div class="def_outer_gray">
                <div class=" def_inner inner_item">
                    <input type="hidden" name="payment_method_id" id="payment_method_id" value="">

                    <div class="form_item_row">
                        <div class="form_item_tit">姓（全角）<span class="hissu_txt">必須</span></div>
                        <input type="text" name="last_name" class="def_input_100p" value="{{ old('last_name', optional($user->profile)->last_name) }}">
                    </div><!--/form_item_row-->

                    <div class="form_item_row">
                        <div class="form_item_tit">名（全角）<span class="hissu_txt">必須</span></div>
                        <input type="text" name="first_name" class="def_input_100p" value="{{ old('first_name', optional($user->profile)->first_name) }}">
                    </div><!--/form_item_row-->

                    <div class="form_item_row">
                        <div class="form_item_tit">セイ（全角）<span class="hissu_txt">必須</span></div>
                        <input type="text" name="last_name_kana" class="def_input_100p" value="{{ old('last_name_kana', optional($user->profile)->last_name_kana) }}">
                    </div><!--/form_item_row-->

                    <div class="form_item_row">
                        <div class="form_item_tit">メイ（全角）<span class="hissu_txt">必須</span></div>
                        <input type="text" name="first_name_kana" class="def_input_100p" value="{{ old('first_name_kana', optional($user->profile)->first_name_kana) }}">
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
                            <select id="birth_year" name="birth_year">
                                <option value="">年</option>
                                @foreach(array_reverse(range(today()->year - 100, today()->year)) as $birth_year)
                                    <option value="{{ $birth_year }}" {{ old('birth_year', $user->profile->getYearOfBirth()) == $birth_year ? 'selected' : '' }}>{{ $birth_year }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
                            <select id="birth_month" name="birth_month">
                                <option value="">月</option>
                                @foreach(range(1, 12) as $birth_month)
                                    <option value="{{ $birth_month }}" {{ old('birth_month', $user->profile->getMonthOfBirth()) == $birth_month ? 'selected' : '' }}>{{ $birth_month }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="cp_ipselect cp_normal">
                            <select id="birth_day" name="birth_day" data-old-value="{{ old('birth_day', $user->profile->getDayOfBirth()) }}"></select>
                        </div>
                    </div><!--/form_item_row-->

                    <div class="form_item_row">
                        <div class="form_item_tit">備考欄<span class="nini_txt">任意</span>　<span class="disclaimer">※300文字以内で入力してください</span></div>
                        <textarea name="remarks" class="def_textarea" rows="6">{{ old('remarks') }}</textarea>
                    </div><!--/form_item_row-->

                    <div class="form_item_row">
                        <div class="form_item_tit">応援コメント<span class="nini_txt">任意</span>　<span class="disclaimer">※300文字以内で入力してください</span></div>
                        <span class="message-warning">※応援コメントはプロジェクト詳細画面の応援コメント一覧に表示されます</span>
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
const emptyYearAndMonth = () => {
    alert('「年」または「月」が選択されていません。');
}
let birthDayHtml;
function setBirthDay() {
    // 年の値を取得
    const birthYearVal = document.getElementById('birth_year').value;

    // 月の値を取得
    const birthMonthVal = document.getElementById('birth_month').value;

    // 日のセレクトボックスを取得
    const birthDaySelectBox = document.getElementById('birth_day');

    // 年月が有効な値の場合のみ日付の選択肢を加える
    if (birthYearVal !== '' && birthMonthVal !== '') {

        birthDaySelectBox.removeEventListener('click', emptyYearAndMonth);
        // 特定の年月の最後の日付を取得する
        const birthLastDay = (new Date(birthYearVal, birthMonthVal, 0)).getDate();
        // optionを組み立てる
        birthDayHtml += '<option value="">日</option>';
        for (let birthDay = 1; birthDay <= birthLastDay; birthDay++) {
            birthDayHtml += '<option value="' + birthDay + '">' + birthDay + '</option>';
        }
    } else {
        birthDaySelectBox.addEventListener('click', emptyYearAndMonth)
    }
    birthDaySelectBox.innerHTML = birthDayHtml;
};
window.onload = function(){
    setBirthDay();

    document.getElementById('birth_year').addEventListener('change', setBirthDay);
    document.getElementById('birth_month').addEventListener('change', setBirthDay);

    const birthDayElem = document.getElementById('birth_day');
    birthDayElem.value = birthDayElem.getAttribute('data-old-value');

    if (window.performance.navigation.type == 2){
        Plans.searchCheckedPlans();
        let check_box = document.getElementsByClassName('plan_ids');

        for (var i = 0, len = check_box.length; i < len; i++){
            if (check_box[i].checked){
                Plans.planIsChecked(check_box[i]);
            }
        }
    }
    let check_box = document.getElementsByClassName('plan_ids');

    for (var i = 0, len = check_box.length; i < len; i++){
        if (check_box[i].checked){
            Plans.planIsChecked(check_box[i]);
        }
    }
}
</script>
<script src="{{ asset('/js/Plans.js') }}"></script>

@if(config('app.card_payment_api') === 'payjp')
    <script src="https://js.pay.jp/v2/pay.js"></script>
    <script>
        var payjp = Payjp('{{ config("app.pay_jp_key") }}')
    </script>
    <script src="{{ asset('/js/payjp-create-card-token.js') }}"></script>
@elseif(config('app.card_payment_api') === 'stripe')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ config("app.stripe_key") }}');
    </script>
    <script src="{{ asset('/js/stripe-create-card-token.js') }}"></script>
@endif

<script>
    const paypayIsChecked = () => {
    let result = false;
    document.getElementsByName('payment_way').forEach(function (e) {
        if(e.value === 'paypay' && e.checked){
            return result = true;
        };
    });
    return result;
}
</script>
@endsection
