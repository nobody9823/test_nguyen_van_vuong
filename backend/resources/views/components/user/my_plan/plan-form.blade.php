<div class="form_item_row">
    <div class="form_item_tit">
        リターン名
        <span class="hissu_txt">必須</span>
        <span class="disclaimer">※45文字以内で入力してください</span>
    </div>
    <input type="text" name="title" class="def_input_100p" value="{{ old('title', optional($plan)->title) }}" oninput="updateMyPlan.textInput(this, {{ $project->id }}, {{ $plan === null ? '' : $plan->id }})">
    <div class="form_item_tit">
        <x-common.async-submit-message propName="return_title{{ $plan === null ? '' : '_'.$plan->id }}" />
    </div>
</div>

<div class="form_item_row">
    <div class="form_item_tit">
        詳細
        <span class="hissu_txt">必須</span>
        <span class="disclaimer">※2000文字以内で入力してください</span>
    </div>
    <textarea name="content" class="def_textarea" rows="6" oninput="updateMyPlan.textInput(this, {{ $project->id }}, {{ $plan === null ? '' : $plan->id }})">{{ old('content', optional($plan)->content) }}</textarea>
    <div class="form_item_tit">
        <x-common.async-submit-message propName="return_content{{ $plan === null ? '' : '_'.$plan->id }}" />
    </div>
</div>

<div class="form_item_row">
    <div class="form_item_tit">
        限定数
        <span class="disclaimer">※個数に制限がない場合、チェックを入れる必要はありません</span>
    </div>
    <input type="checkbox" id="limit_of_supporters_is_required{{ $plan === null ? '' : '_'.$plan->id }}" class="ac_list_checks" name="limit_of_supporters_is_required" value="1"
    onchange="updateMyPlan.limitOfSupportersIsChecked(this, {{ $project->id }}, {{ $plan === null ? '' : $plan->id }})"
        @if(!is_null($plan))
        {{  $plan->limit_of_supporters_is_required ? 'checked' : '' }}>
        @else
        >
        @endif
    <label for="limit_of_supporters_is_required{{ $plan === null ? '' : '_'.$plan->id }}" class="checkbox-fan">このリターンの個数を設定する</label>

    <input type="number" id="limit_of_supporters{{ $plan === null ? '' : '_'.$plan->id }}" name="limit_of_supporters" class="p-postal-code def_input_100p"
        style="display:
            @if(!is_null($plan))
            {{  $plan->limit_of_supporters_is_required ? 'block' : 'none' }}"
            @else
            {{ 'none' }}"
            @endif
        value="{{ optional($plan)->limit_of_supporters ?: 1 }}" placeholder="（例）100000" oninput="updateMyPlan.textInput(this, {{ $project->id }}, {{ $plan === null ? '' : $plan->id }})">
    <div class="form_item_tit">
        <x-common.async-submit-message propName="return_limit_of_supporters_is_required{{ $plan === null ? '' : '_'.$plan->id }}" />
        <x-common.async-submit-message propName="return_limit_of_supporters{{ $plan === null ? '' : '_'.$plan->id }}" />
    </div>
</div>

<div class="form_item_row">
    <div class="form_item_tit">お届け予定日<span class="hissu_txt">必須</span></div>
    <input type="text" name="delivery_date" class="p-postal-code def_input_100p delivery_date"
        value="{{ old('delivery_date', optional($plan)->delivery_date) ?: $project->end_date }}" placeholder="（例）100000" oninput="updateMyPlan.textInput(this, {{ $project->id }}, {{ $plan === null ? '' : $plan->id }})">
    <div class="form_item_tit">
        <x-common.async-submit-message propName="return_delivery_date{{ $plan === null ? '' : '_'.$plan->id }}" />
    </div>
</div>

<div class="form_item_row">
    <div class="form_item_tit">
        金額
        <span class="hissu_txt">必須</span>
        <span class="disclaimer">※半角数字のみで入力してください。</span>
    </div>
    <input type="number" name="price" class="p-postal-code def_input_50p" value="{{ old('price', optional($plan)->price) }}" placeholder="（例）100000" oninput="updateMyPlan.textInput(this, {{ $project->id }}, {{ $plan === null ? '' : $plan->id }})" min="0"><span>&emsp;円</span>
    <div class="form_item_tit">
        <x-common.async-submit-message propName="return_price{{ $plan === null ? '' : '_'.$plan->id }}" />
    </div>
</div>

<div class="form_item_row" style="display: flex; flex-direction: column">
    <div class="form_item_tit">リターン画像<span class="hissu_txt">必須</span></div>
    <div class="plan_image_wrapper">
        @if ($plan !== null)
            <div id="image_url_{{ $plan->id }}" class="ib02_01 E-font my_project_img_wrapper">
        @else
            <div id="image_url" class="ib02_01 E-font my_project_img_wrapper">
        @endif

        @if (optional($plan)->image_url !== null)
            <img src="{{ Storage::url($plan->image_url) }}">
        @else
            <img src="{{ Storage::url('public/sampleImage/now_printing.png') }}">
        @endif
        </div>
        <div class="form_item_tit" style="margin-bottom: 10px"></div>
        <div class="input_file_button_wrapper">
            <label>
                <input type="file" name="image_url" hidden onChange="updateMyPlan.uploadImage(this, {{ $project->id }}, {{ $plan === null ? '' : $plan->id }})">
                <a class="input_file_button">
                    ファイルを選択する
                </a>
            </label>
        </div>
        <div class="form_item_tit">
            <x-common.async-submit-message propName="return_image_url{{ $plan === null ? '' : '_'.$plan->id }}" />
        </div>
    </div>
</div>

<div class="form_item_row">
    <div class="form_item_tit">
        住所情報の取得
        <small>(※リターンを配送する場合等に利用)</small>
        <span class="hissu_txt">必須</span>
    </div>
    <div class="cp_ipselect cp_normal">
        <select name="address_is_required" class="p-region" onChange="updateMyPlan.selectorInput(this, {{ $project->id }}, {{ $plan === null ? '' : $plan->id }})">
            <option value=0 {{ optional($plan)->address_is_required === 0 ? 'selected' : '' }}>要</option>
            <option value=1 {{ optional($plan)->address_is_required === 1 ? 'selected' : '' }}>不要</option>
        </select>
    </div>
    <div class="form_item_tit">
        <x-common.async-submit-message propName="return_address_is_required{{ $plan === null ? '' : '_'.$plan->id }}" />
    </div>
</div>
<div class="def_btn">
    <button type="submit" class="disable-btn">
        <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">保存する</p>
    </button>
</div>
