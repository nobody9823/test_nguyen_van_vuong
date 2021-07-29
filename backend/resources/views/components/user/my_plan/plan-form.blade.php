<div class="form_item_row">
    <div class="form_item_tit">タイトル<span class="hissu_txt">必須</span></div>
    <input type="text" name="title" class="def_input_100p" value="{{ old('title', optional($plan)->title) }}">
</div>

<div class="form_item_row">
    <div class="form_item_tit">本文<span class="hissu_txt">必須</span><span style="font-weight: normal;font-size: 1.2rem;">※300文字以内で入力してください</span></div>
    <textarea name="content" class="def_textarea" rows="6">{{ old('content', optional($plan)->content) }}</textarea>
</div>

<div class="form_item_row">
    <div class="form_item_tit">限定数</div>
    <input type="number" name="limit_of_supporters" class="p-postal-code def_input_100p" value="{{ old('limit_of_supporters', optional($plan)->limit_of_supporters) }}" placeholder="（例）100000">
</div>

<div class="form_item_row">
    <div class="form_item_tit">お届け予定日<span class="hissu_txt">必須</span></div>
    <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
        <select id="delivery_year" class="form-control" name="delivery_year" readonly>
        @for($i = (int) date('Y'); $i <= (int) date('Y') + 2; $i ++)
            <option value="{{ $i }}" {{ $i == old('delivery_year', optional(optional($plan)->delivery_date)->year) ? 'selected' : '' }}>{{ $i }}</option>
        @endfor
        </select>
    </div>
    <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
        <select id="delivery_month" class="form-control" name="delivery_month">
            @for ($i = 0; $i <= 12; $i++)
            <option value="{{ sprintf('%02d', $i) }}" {{ optional(optional($plan)->delivery_date)->month == sprintf('%02d', $i) ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
        </select>
    </div>
    <div class="cp_ipselect cp_normal" style="margin-right: 10px;">
        <select id="delivery_day" class="form-control" name="delivery_day">
            @for ($i = 0; $i <= 31; $i++)
            <option value="{{ sprintf('%02d', $i) }}" {{ optional(optional($plan)->delivery_date)->day == sprintf('%02d', $i) ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
        </select>
    </div>
</div>

<div class="form_item_row">
    <div class="form_item_tit">金額<span class="hissu_txt">必須</span></div>
    <input type="number" name="price" class="p-postal-code def_input_100p" value="{{ old('price', optional($plan)->price) }}" placeholder="（例）100000">
</div>

<div class="form_item_row">
    @if (optional($plan)->image_url !== null)
        <div class="ib02_01 E-font my_project_img_wrapper">
            <img src="{{ Storage::url($plan->image_url) }}">
        </div>
    @endif
    <div class="form_item_tit" style="margin-bottom: 10px">画像</div>
    <div class="input_file_button_wrapper">
        <label>
            <input type="file" name="image_url" hidden>
            <a class="input_file_button">
                ファイルを選択する
            </a>
        </label>
    </div>
</div>

<div class="form_item_row">
    <div class="form_item_tit">住所の有無<span class="hissu_txt">必須</span></div>
    <div class="cp_ipselect cp_normal">
        <select name="address_is_required" class="p-region">
            <option value=0 {{ optional($plan)->address_is_required === 0 ? 'selected' : '' }}>なし</option>
            <option value=1 {{ optional($plan)->address_is_required === 1 ? 'selected' : '' }}>あり</option>
        </select>
    </div>
</div>
<div class="def_btn">
    <button type="submit" class="disable-btn">
        <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">保存する</p>
    </button>
</div>
