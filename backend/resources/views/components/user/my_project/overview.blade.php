<div class="form_item_row">
    <div class="form_item_tit">タイトル<span class="hissu_txt">必須</span></div>
    <input type="text" name="first_name" class="def_input_100p" value="">
</div>

<div class="form_item_row">
    <div class="form_item_tit">概要文<span class="nini_txt">任意</span>　<span style="font-weight: normal;font-size: 1.2rem;">※300文字以内で入力してください</span></div>
    <textarea name="remarks" class="def_textarea" rows="6"></textarea>
</div>

<div class="form_item_row">
    <div class="form_item_tit">タグ<span class="hissu_txt">必須</span></div>
    <div class="cp_ipselect cp_normal">
        <select name="prefecture" class="p-region">
                <option value="non_selected">選択してください</option>
            @foreach($tags as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
    </div>
</div>