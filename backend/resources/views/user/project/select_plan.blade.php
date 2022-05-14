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
    <form action="{{ route('user.plan.confirmPayment', ['project' => $project, 'inviter_code' => $inviter_code ?? '']) }}" class="h-adr" method="post" id="purchaseForm">
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
                                    <span onClick="Plans.subTotalAmount()" class="pay_minus_btn"></span>
                                    <input type="number" name="display_added_price" id="display_added_price" readonly class="pay_input_count"><span class="pay_input_count_en">円</span>
                                    <span onClick="Plans.addTotalAmount()" class="pay_plus_btn"></span>
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
                            {{-- <input class="tab_item" type="radio" id="tab1" name="payment_way" value="credit" checked> --}}
                            <input id="tab1" type="radio" name="payment_way" value="credit" checked>
                            <label class="tab_item" for="tab1">クレジットカード</label>
                            <input id="tab2" type="radio" name="payment_way" value="cvs">
                            <label class="tab_item" for="tab2">コンビニ</label>
                            {{-- <input id="tab3" type="radio" name="tab_item">
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
                                        <input type="text" name="number_form" id="number-form" class="number_form" placeholder="（例）123456789" />
                                    </div>

                                    <div class="tab1_01">
                                        <div class="tab1_01_01">有効期限</div>
                                        <div class="expiry-wrapper">
                                            <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
                                                <select name="expiry_month" id="expiry-month" class="expiry">
                                                    <option value="">月</option>
                                                    <option value="01">01月</option>
                                                    <option value="02">02月</option>
                                                    <option value="03">03月</option>
                                                    <option value="04">04月</option>
                                                    <option value="05">05月</option>
                                                    <option value="06">06月</option>
                                                    <option value="07">07月</option>
                                                    <option value="08">08月</option>
                                                    <option value="09">09月</option>
                                                    <option value="10">10月</option>
                                                    <option value="11">11月</option>
                                                    <option value="12">12月</option>
                                                </select>
                                            </div>
                                            <div class="cp_ipselect cp_normal">
                                                <select name="expiry_year" id="expiry-year" class="expiry">
                                                    <option value="">年</option>
                                                    @for($i = Carbon\Carbon::now()->year; $i <= Carbon\Carbon::now()->addYear(10)->year; $i ++)
                                                        <option value="{{ $i }}">{{ $i }}年</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab1_01">
                                        <div class="tab1_01_01">セキュリティコード</div>
                                        <div class="cvc-wrapper">
                                            <input type="text" name="cvc-form" id="cvc-form" class="cvc_form" placeholder="（例）123" />
                                            <div class="tooltip1">
                                                <p>？</p>
                                                <div class="description1">カードの裏面にある末尾3桁の数字</div>
                                            </div>
                                        </div>
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

                            {{-- コンビニ決済入力フォーム --}}
                            <div class="tab_content" id="tab2_content">
                                <div class="tab_content_description">
                                    <div class="tab1_01">
                                        <div class="tab1_01_01">支払い先コンビニ名</div>
                                        <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
                                            <select name="cvs_code">
                                                <option value="">ご利用するコンビニをお選びください</option>
                                                <option value="10001">ローソン</option>
                                                <option value="10002">ファミリーマート</option>
                                                <option value="10005">ミニストップ</option>
                                                <option value="10008">セイコーマート</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="creca_icon">
                                    <img src="{{ asset('image/cvs-card_1.png') }}">
                                    <img src="{{ asset('image/cvs-card_2.png') }}">
                                    <img src="{{ asset('image/cvs-card_3.png') }}">
                                    <img src="{{ asset('image/cvs-card_4.png') }}">
                                </div>
                                <div class="tab1_05">
                                    全国の主要なコンビニエンスストア（セブンイレブンを除く）でご利用いただけます。<br/>
                                    <span style="color: red;">ご利用は、支援金額が30万円未満の場合で、支援日時が募集終了日の2日前までに限られます。</span>
                                </div>
                            </div><!--/tab_content-->
                            {{-- <div class="tab_content" id="tab3_content">
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

            <div class="def_outer_gray select_plan">
                <div class=" def_inner inner_item">
                    <input type="hidden" name="payment_method_id" id="payment_method_id" value="">
                    <input type="hidden" name="address_id" id="address_id" value="">
                    <input type="hidden" name="last_name" id="last_name" value="">
                    <input type="hidden" name="first_name" id="first_name" value="">
                    <input type="hidden" name="last_name_kana" id="last_name_kana" value="">
                    <input type="hidden" name="first_name_kana" id="first_name_kana" value="">
                    <input type="hidden" name="phone_number" id="phone_number" value="">
                    <input type="hidden" name="postal_code" id="postal_code" value="">
                    <input type="hidden" name="prefecture" id="prefecture" value="">
                    <input type="hidden" name="city" id="city" value="">
                    <input type="hidden" name="block" id="block" value="">
                    <input type="hidden" name="block_number" id="block_number" value="">
                    <input type="hidden" name="building" id="building" value="">
                    <div class="as_header_02">お届け先を選択してください</div>
                    @foreach($user->address as $address)
                    <div class="form_item_list">
                        <input type="hidden" id="address" name="address[]" value="{{ $address->id }}">
                        <div class="form_item_button">
                            <div class="form_item_row">
                                <div class="form_item_01">
                                    <input type="radio" id="select_address_{{ $loop->index }}" name="select_address" class="form" value="{{ $loop->index }}" {{ optional($address)->is_main === 1 ?'checked':'' }}>
                                    <label for="select_address_{{ $loop->index }}" class="radio-fan"></label>
                                </div>
                            </div>
                        </div>
                        <div class="form_item_address">
                            <div class="form_item_row">
                                <div class="form_item_02">
                                    <span name="last_name[]" value="{{ optional($address)->last_name }}">{{ optional($address)->last_name }}</span>&nbsp;
                                    <span name="first_name[]" value="{{ optional($address)->first_name }}">{{ optional($address)->first_name }}</span>
                                </div>
                            </div><!--/form_item_row-->
                            <div class="form_item_row">
                                <div class="form_item_03">
                                    <span name="last_name_kana[]" value="{{ optional($address)->last_name_kana }}">{{ optional($address)->last_name_kana }}</span>&nbsp;
                                    <span name="first_name_kana[]" value="{{ optional($address)->first_name_kana }}">{{ optional($address)->first_name_kana }}</span>
                                </div>
                            </div><!--/form_item_row-->
                            <div class="form_item_row">
                                <div class="form_item_04">
                                    <span name="phone_number[]" value="{{ optional($address)->phone_number }}">{{ optional($address)->phone_number }}</span>
                                </div>
                            </div><!--/form_item_row-->
                            <div class="form_item_row">
                                <div class="form_item_05">
                                    <span name="postal_code[]" value="{{ optional($address)->postal_code }}">{{ optional($address)->postal_code }}</span>
                                </div>
                            </div><!--/form_item_row-->
                            <div class="form_item_row">
                                <div class="form_item_06">
                                    <span name="prefecture[]" value="{{ optional($address)->prefecture }}">{{ optional($address)->prefecture }}</span>
                                    <span name="city[]" value="{{ optional($address)->city }}">{{ optional($address)->city }}</span>
                                    <span name="block[]" value="{{ optional($address)->block }}">{{ optional($address)->block }}</span>
                                    <span name="block_number[]" value="{{ optional($address)->block_number }}">{{ optional($address)->block_number }}</span>&nbsp;
                                    <span name="building[]" value="{{ optional($address)->building }}">{{ optional($address)->building }}</span>
                                </div>
                            </div><!--/form_item_row-->
                            <div class="form_item_row">
                                <div class="form_item_tit">
                                    <button type="button" id="openModalEdit" class="btn edit_button" value="{{ $loop->index }}">編集</button>
                                    @if ($plans instanceof \App\Models\Plan)
                                    <a class="delete_button" href="{{ route('user.plan.deleteAddress', ['project' => $project, 'plan' => $plans, 'address_id' => $address->id, 'single_return' => true]) }}">削除</a>
                                    @else
                                    <a class="delete_button" href="{{ route('user.plan.deleteAddress', ['project' => $project, 'plan' => $plan, 'address_id' => $address->id, 'single_return' => false]) }}">削除</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div><!--/form_item_list-->
                    @endforeach

                    <div class="def_btn">
                        <button type="button" id="openModal" class="disable-btn">
                            <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">お届け先を追加する</p>
                        </button>
                    </div>

                    <div class="form_item_row">
                        <div class="form_item_tit">性別<span class="hissu_txt">必須</span></div>
                        <div class="cp_ipselect cp_normal">
                            <select name="gender">
                                <option value="select">選択</option>
                                <option value="男性" {{ old('gender') === "男性" || optional($user->profile)->gender === "男性" ? 'selected' : '' }}>男性</option>
                                <option value="女性" {{ old('gender') === "女性" || optional($user->profile)->gender === "女性" ? 'selected' : '' }}>女性</option>
                                <option value="その他" {{ old('gender') === "その他" || optional($user->profile)->gender === "その他" ? 'selected' : '' }}>その他</option>
                            </select>
                        </div>
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
                        <button type="button" id="confirm_button" class="disable-btn">
                            <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">確認画面へ</p>
                        </button>
                    </div>

                </div><!--/.inner_item-->
            </div><!--/def_outer_gray-->

        </div>
    </form>
</div>

<section id="modalArea" class="modalArea">
    <div id="modalBg" class="modalBg"></div>
    <div class="modalWrapper">
        <form id="form1" action="" class="h-adr" method="post">
            @csrf
            <input type="hidden" name="address_id" id="address_id_modal" value="">
            <input type="hidden" name="checked_id" id="checked_id" value="">
            <div class="modalContents">
                <div class="form_item_row">
                    <div class="form_item_tit">姓名（全角）<span class="hissu_txt">必須</span></div>
                    <input type="text" id="last_name_modal" name="last_name" class="def_input_50p" value="{{ old('last_name_model') }}">
                    <input type="text" id="first_name_modal" name="first_name" class="def_input_50p" value="{{ old('first_name_model') }}">
                </div><!--/form_item_row-->
                <div class="form_item_row">
                    <div class="form_item_tit">セイメイ（全角）<span class="hissu_txt">必須</span></div>
                    <input type="text" id="last_name_kana_modal" name="last_name_kana" class="def_input_50p" value="{{ old('last_name_kana_model') }}">
                    <input type="text" id="first_name_kana_modal" name="first_name_kana" class="def_input_50p" value="{{ old('first_name_kana_model') }}">
                </div><!--/form_item_row-->
                <div class="form_item_row">
                    <div class="form_item_tit">電話番号（ハイフンなし）<span class="hissu_txt">必須</span></div>
                    <input type="number" id="phone_number_modal" name="phone_number" class="def_input_100p" value="{{ old('phone_number_model') === '00000000000' ? '' : old('phone_number_model') }}">
                </div><!--/form_item_row-->

                <div class="form_item_row">
                    <div class="form_item_tit">郵便番号<span class="hissu_txt">必須</span></div>
                    <input type="text" id="postal_code_modal" name="postal_code" onKeyUp="AjaxZip2.zip2addr(this,'prefecture','address');" class="p-postal-code def_input_100p" value="{{ old('postal_code_model') === '0' ? '' : old('postal_code_model') }}">
                </div><!--/form_item_row-->

                <div class="form_item_row">
                    <div class="form_item_tit">都道府県<span class="hissu_txt">必須</span></div>
                    <div class="cp_ipselect cp_normal">
                        <select id="prefecture_modal" name="prefecture" class="p-region">
                                <option value="non_selected">選択してください</option>
                            @for($i = 1; $i <= 47; $i++)
                                <option value="{{ PrefectureHelper::getPrefectures()[$i] }}" {{ old('prefecture_model') === PrefectureHelper::getPrefectures()[$i] ? 'selected' : '' }}>{{ PrefectureHelper::getPrefectures()[$i] }}</option>
                            @endfor
                        </select>
                    </div>
                </div><!--/form_item_row-->

                <div class="form_item_row">
                    <div class="form_item_tit">市区町村<span class="hissu_txt">必須</span></div>
                    <input type="text" id="city_modal" name="city" class="p-locality def_input_100p" value="{{ old('city_model') }}">
                </div><!--/form_item_row-->

                <div class="form_item_row">
                    <div class="form_item_tit">町域<span class="hissu_txt">必須</span></div>
                    <input type="text" id="block_modal" name="block" class="p-street-address def_input_100p"  value="{{ old('block_model') }}">
                </div><!--/form_item_row-->

                <div class="form_item_row">
                    <div class="form_item_tit">番地<span class="hissu_txt">必須</span></div>
                    <input type="text" id="block_number_modal" name="block_number" class="p-street-address def_input_100p"  value="{{ old('block_number_model') }}">
                </div><!--/form_item_row-->

                <div class="form_item_row">
                    <div class="form_item_tit">建物名<span class="nini_txt">任意</span></div>
                    <input type="text" id="building_modal" name="building" class="p-extended-address def_input_100p"  value="{{ old('building_model') }}">
                </div><!--/form_item_row-->

                <div class="def_btn">
                    <button id="modal_button" type="button" class="disable-btn">
                        <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">保存</p>
                    </button>
                </div>
            </div>
        </form>
    <div id="closeModal" class="closeModal">
      ×
    </div>
  </div>
</section>
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
                Plans.changeSelectedPlan(check_box[i]);
            }
        }
    }
    let check_box = document.getElementsByClassName('plan_ids');

    for (var i = 0, len = check_box.length; i < len; i++){
        if (check_box[i].checked){
            Plans.changeSelectedPlan(check_box[i]);
        }
    }
}
$('#openModal, #openModalEdit').click(function(){
    if ($(this).attr('id') == "openModalEdit") {
        id = $(this).val()

        $('#last_name_modal').val($('span[name="last_name[]"').eq(id).text())
        $('#first_name_modal').val($('span[name="first_name[]"').eq(id).text())
        $('#last_name_kana_modal').val($('span[name="last_name_kana[]"').eq(id).text())
        $('#first_name_kana_modal').val($('span[name="first_name_kana[]"').eq(id).text())
        $('#phone_number_modal').val($('span[name="phone_number[]"').eq(id).text())
        $('#postal_code_modal').val($('span[name="postal_code[]"').eq(id).text())
        $('#prefecture_modal').val($('span[name="prefecture[]"').eq(id).text())
        $('#city_modal').val($('span[name="city[]"').eq(id).text())
        $('#block_modal').val($('span[name="block[]"').eq(id).text())
        $('#block_number_modal').val($('span[name="block_number[]"').eq(id).text())
        $('#building_modal').val($('span[name="building[]"').eq(id).text())
        $('#address_id_modal').val($('input[name="address[]"').eq(id).val())
    } else {
        $('#last_name_modal').val("{{ old('last_name') }}")
        $('#first_name_modal').val("{{ old('first_name') }}")
        $('#last_name_kana_modal').val("{{ old('last_name_kana') }}")
        $('#first_name_kana_modal').val("{{  old('first_name_kana') }}")
        $('#phone_number_modal').val("{{ old('phone_number') }}")
        $('#postal_code_modal').val("{{ old('postal_code') }}")
        $('#prefecture_modal').val("{{ old('prefecture') }}")
        $('#city_modal').val("{{ old('city') }}")
        $('#block_modal').val("{{ old('block') }}")
        $('#block_number_modal').val("{{ old('block_number') }}")
        $('#building_modal').val("{{ old('building') }}")
        $('#address_id_modal').val("{{ old('address_id') }}")
    }
    $('#modalArea').fadeIn();
});
$('#closeModal , #modalBg').click(function(){
    $('#modalArea').fadeOut();
});
$('#modal_button').click(function() {
    var checked_id = []
    @if ($plans instanceof \App\Models\Plan)
        $('input[name="plan_ids[]"]:checked').each(function() {
            checked_id.push($(this).attr('id'))
        });
    @endif
    $('#checked_id').val(checked_id)
    if ($('#address_id_modal').val() == "") {
        $('#form1').attr('action', "{{ route('user.plan.registAddress', ['project' => $project, 'inviter_code' => $inviter_code ?? '']) }}")
    } else {
        $('#form1').attr('action', "{{ route('user.plan.editAddress', ['project' => $project, 'inviter_code' => $inviter_code ?? '']) }}")
    }
    $('#form1').submit()
})

$('#confirm_button').click(function() {
    id = $('input:radio[name="select_address"]:checked').val()
    $('#last_name').val($('span[name="last_name[]"').eq(id).text())
    $('#first_name').val($('span[name="first_name[]"').eq(id).text())
    $('#last_name_kana').val($('span[name="last_name_kana[]"').eq(id).text())
    $('#first_name_kana').val($('span[name="first_name_kana[]"').eq(id).text())
    $('#phone_number').val($('span[name="phone_number[]"').eq(id).text())
    $('#postal_code').val($('span[name="postal_code[]"').eq(id).text())
    $('#prefecture').val($('span[name="prefecture[]"').eq(id).text())
    $('#city').val($('span[name="city[]"').eq(id).text())
    $('#block').val($('span[name="block[]"').eq(id).text())
    $('#block_number').val($('span[name="block_number[]"').eq(id).text())
    $('#building').val($('span[name="building[]"').eq(id).text())
    $('#address_id').val($('input[name="address[]"').eq(id).val())
    doPurchase()
});
$(function () {
    window.addEventListener("pageshow", function(event) {
        var historyTraversal = event.persisted ||
            (typeof window.performance != "undefined" &&
                window.performance.navigation.type === 2);
        if (historyTraversal) {
            // Handle page restore.
            window.location.reload();
        }
    });
})

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
@elseif(config('app.card_payment_api') === 'GMO')
    {{-- 以下テスト環境URL --}}
    @env('production')
    <script src="https://static.mul-pay.jp/ext/js/token.js"></script>
    @endenv
    @env(['staging', 'local'])
    <script src="https://stg.static.mul-pay.jp/ext/js/token.js"></script>
    @endenv
    <script>
        Multipayment.init('{{ config("app.gmo_shop_id") }}');
    </script>
    <script src="{{ asset('/js/gmo-create-card-token.js') }}?20220203"></script>
@endif

@endsection
