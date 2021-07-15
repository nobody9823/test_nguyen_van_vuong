<div class="form_item_row">
    <div class="form_item_tit">タイトル<span class="hissu_txt">必須</span></div>
    <input type="text" name="first_name" class="def_input_100p" value="">
</div>

<div class="form_item_row">
    <div class="form_item_tit">金額<span class="hissu_txt">必須</span></div>
    <input type="number" name="postal_code" class="p-postal-code def_input_100p" value="" placeholder="（例）100000">
</div><!--/form_item_row-->

<div class="form_item_row">
    <div class="form_item_tit">本文<span class="hissu_txt">必須</span><span style="font-weight: normal;font-size: 1.2rem;">※300文字以内で入力してください</span></div>
    <textarea name="remarks" class="def_textarea" rows="6"></textarea>
</div>

<div class="form_item_row">
    <div class="form_item_tit">掲載開始日(日付、時刻)<span class="hissu_txt">必須</span></div>
    <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
        <select id="birth_year" class="form-control" name="birth_year" readonly>
            <option value="{{ date('Y') }}">{{ date('Y') }}</option>
        </select>
    </div>
    <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
        <select id="birth_month" class="form-control" name="birth_month">
            @for ($i = 1; $i <= 12; $i++)
            <option value="{{ $i }}" {{ date('mm') == $i ? selected : '' }}>{{ $i }}</option>
            @endfor
        </select>
    </div>
    <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
        <select id="birth_day" class="form-control" name="birth_day">
            @for ($i = 1; $i <= 31; $i++)
            <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>
</div><!--/form_item_row-->

<div class="form_item_row">
    <div class="form_item_tit">画像<span style="font-weight: normal;font-size: 1.2rem;">※300文字以内で入力してください</span></div>
    <input type="file">
</div>

<div class="form_item_row">
    <div class="form_item_tit">限定数</div>
    <input type="number" name="postal_code" class="p-postal-code def_input_100p" value="" placeholder="（例）100000">
</div>

<div class="form_item_row">
    <div class="form_item_tit">住所の有無<span class="hissu_txt">必須</span></div>
    <div class="cp_ipselect cp_normal">
        <select name="prefecture" class="p-region">
            <option value="false">なし</option>
            <option value="true">あり</option>
        </select>
    </div>
</div>