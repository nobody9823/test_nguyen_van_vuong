<div class="form_item_row">
    <div class="form_item_tit">名前<span class="hissu_txt">必須</span></div>
    <input type="text" name="first_name" class="def_input_100p" value="">
</div>

<div class="form_item_row">
    <div class="form_item_tit">電話番号（ハイフンなし）<span class="hissu_txt">必須</span></div>
    <input type="number" name="phone_number" class="def_input_100p" value="">
</div><!--/form_item_row-->

<div class="form_item_row">
    <div class="form_item_tit">郵便番号（ハイフンなし）<span class="hissu_txt">必須</span></div>
        <input type="number" name="postal_code" onKeyUp="AjaxZip2.zip2addr(this,'prefecture','address');" class="p-postal-code def_input_100p" value="">
    </div><!--/form_item_row-->

    <div class="form_item_row">
        <div class="form_item_tit">都道府県<span class="hissu_txt">必須</span></div>
        <div class="cp_ipselect cp_normal">
            <select name="prefecture" class="p-region">
                    <option value="non_selected">選択してください</option>
                @for($i = 1; $i <= 47; $i++)
                    <option value="{{ PrefectureHelper::getPrefectures()[$i] }}">{{ PrefectureHelper::getPrefectures()[$i] }}</option>
                @endfor
            </select>
        </div>
    </div><!--/form_item_row-->

    <div class="form_item_row">
        <div class="form_item_tit">市区町村<span class="hissu_txt">必須</span></div>
        <input type="text" name="city" class="p-locality def_input_100p" value="">
    </div><!--/form_item_row-->

    <div class="form_item_row">
        <div class="form_item_tit">番地<span class="hissu_txt">必須</span></div>
        <input type="text" name="block" class="p-street-address def_input_100p"  value="">
    </div><!--/form_item_row-->

    <div class="form_item_row">
        <div class="form_item_tit">建物名<span class="nini_txt">任意</span></div>
        <input type="text" name="building" class="p-extended-address def_input_100p"  value="">
    </div><!--/form_item_row-->

<div class="form_item_row">
    <div class="form_item_tit">生年月日<span class="hissu_txt">必須</span></div>
    <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
        <select id="birth_year" class="form-control" name="birth_year">
            <option value="">----</option>
            @for ($i = 1980; $i <= 2005; $i++)
            <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>
    <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
        <select id="birth_month" class="form-control" name="birth_month">
            <option value="">--</option>
            @for ($i = 1; $i <= 12; $i++)
            <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>
    <div class="cp_ipselect cp_normal" >
        <select id="birth_day" class="form-control" name="birth_day">
            <option value="">--</option>
            @for ($i = 1; $i <= 31; $i++)
            <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>
</div>

<div class="form_item_row">
    <div class="form_item_tit">画像<span style="font-weight: normal;font-size: 1.2rem;">※300文字以内で入力してください</span></div>
    <input type="file">
    <input type="file">
</div>

<div class="form_item_row">
    <div class="form_item_tit">銀行名<span class="hissu_txt">必須</span></div>
    <input type="text" name="first_name" class="def_input_100p" value="">
</div>

<div class="form_item_row">
    <div class="form_item_tit">支店番号<span class="hissu_txt">必須</span></div>
    <input type="number" name="phone_number" class="def_input_100p" value="">
</div><!--/form_item_row-->

<div class="form_item_row">
    <div class="form_item_tit">口座種別<span class="hissu_txt">必須</span></div>
    <div class="cp_ipselect cp_normal">
        <select name="prefecture" class="p-region">
            <option value="false">普通</option>
            <option value="false">当座</option>
            <option value="false">貯蓄</option>
        </select>
    </div>
</div>

<div class="form_item_row">
    <div class="form_item_tit">口座番号<span class="hissu_txt">必須</span></div>
    <input type="number" name="phone_number" class="def_input_100p" value="">
</div><!--/form_item_row-->

<div class="form_item_row">
    <div class="form_item_tit">口座名義<span class="hissu_txt">必須</span></div>
    <input type="text" name="first_name" class="def_input_100p" value="">
</div>