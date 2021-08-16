<div class="form_item_row">
    <div class="form_item_tit">
        <div class="spinner-wrapper">
            <div class="spinner" id="spinner_return_title{{ $plan === null ? '' : '_'.$plan->id }}"></div>
            <i class="fa fa-check-circle green" aria-hidden="true" id="saved_return_title{{ $plan === null ? '' : '_'.$plan->id }}"></i>
            <span id="errors_return_title{{ $plan === null ? '' : '_'.$plan->id }}" style="color: red;"></span>
        </div>
        タイトル
        <span class="hissu_txt">必須</span>
    </div>
    <input type="text" name="title" class="def_input_100p" value="{{ old('title', optional($plan)->title) }}" oninput="updateMyPlan.textInput(this, {{ $project->id }}, {{ $plan === null ? $plan : $plan->id }})">
</div>

<div class="form_item_row">
    <div class="form_item_tit">
        <div class="spinner-wrapper">
            <div class="spinner" id="spinner_return_content{{ $plan === null ? '' : '_'.$plan->id }}"></div>
            <i class="fa fa-check-circle green" aria-hidden="true" id="saved_return_content{{ $plan === null ? '' : '_'.$plan->id }}"></i>
            <span id="errors_return_content{{ $plan === null ? '' : '_'.$plan->id }}" style="color: red;"></span>
        </div>
        本文
        <span class="hissu_txt">必須</span>
        <span class="disclaimer">※2000文字以内で入力してください</span>
    </div>
    <textarea name="content" class="def_textarea" rows="6" oninput="updateMyPlan.textInput(this, {{ $project->id }}, {{ $plan === null ? $plan : $plan->id }})">{{ old('content', optional($plan)->content) }}</textarea>
</div>

<div class="form_item_row">
    <div class="form_item_tit">
        <div class="spinner-wrapper">
            <div class="spinner" id="spinner_return_limit_of_supporters_is_required{{ $plan === null ? '' : '_'.$plan->id }}"></div>
            <i class="fa fa-check-circle green" aria-hidden="true" id="saved_return_limit_of_supporters_is_required{{ $plan === null ? '' : '_'.$plan->id }}"></i>
            <span id="errors_return_limit_of_supporters_is_required{{ $plan === null ? '' : '_'.$plan->id }}" style="color: red;"></span>
        </div>
        限定数
    </div>
    <input type="checkbox" id="limit_of_supporters_is_required{{ $plan === null ? '' : '_'.$plan->id }}" class="ac_list_checks" name="limit_of_supporters_is_required" value="1"
    onchange="updateMyPlan.limitOfSupportersIsChecked(this, {{ $project->id }}, {{ $plan === null ? $plan : $plan->id }})"
        @if(!is_null($plan))
        {{  $plan->limit_of_supporters_is_required ? 'checked' : '' }}>
        @else
        >
        @endif
    <label for="limit_of_supporters_is_required{{ $plan === null ? '' : '_'.$plan->id }}" class="checkbox-fan">限定数を設定する</label>

    <div class="spinner-wrapper">
        <div class="spinner" id="spinner_return_limit_of_supporters{{ $plan === null ? '' : '_'.$plan->id }}"></div>
        <i class="fa fa-check-circle green" aria-hidden="true" id="saved_return_limit_of_supporters{{ $plan === null ? '' : '_'.$plan->id }}"></i>
        <span id="errors_return_limit_of_supporters{{ $plan === null ? '' : '_'.$plan->id }}" style="color: red;"></span>
    </div>
    <input type="number" id="limit_of_supporters{{ $plan === null ? '' : '_'.$plan->id }}" name="limit_of_supporters" class="p-postal-code def_input_100p"
        style="display:
            @if(!is_null($plan))
            {{  $plan->limit_of_supporters_is_required ? 'block' : 'none' }}"
            @else
            {{ 'none' }}"
            @endif
        value="{{ optional($plan)->limit_of_supporters ?: 1 }}" placeholder="（例）100000" oninput="updateMyPlan.textInput(this, {{ $project->id }}, {{ $plan === null ? $plan : $plan->id }})">
</div>

<div class="form_item_row">
    <div class="form_item_tit">お届け予定日<span class="hissu_txt">必須</span></div>
        <div class="spinner-wrapper">
            <div class="spinner" id="spinner_return_delivery_date{{ $plan === null ? '' : '_'.$plan->id }}"></div>
            <i class="fa fa-check-circle green" aria-hidden="true" id="saved_return_delivery_date{{ $plan === null ? '' : '_'.$plan->id }}"></i>
            <span id="errors_return_delivery_date{{ $plan === null ? '' : '_'.$plan->id }}" style="color: red;"></span>
        </div>
        <input type="text" name="delivery_date" class="p-postal-code def_input_100p delivery_date"
            value="{{ old('delivery_date', optional($plan)->delivery_date) }}" placeholder="（例）100000" oninput="updateMyPlan.textInput(this, {{ $project->id }}, {{ $plan === null ? $plan : $plan->id }})">
    </div>

<div class="form_item_row">
    <div class="form_item_tit">
        <div class="spinner-wrapper">
            <div class="spinner" id="spinner_return_price{{ $plan === null ? '' : '_'.$plan->id }}"></div>
            <i class="fa fa-check-circle green" aria-hidden="true" id="saved_return_price{{ $plan === null ? '' : '_'.$plan->id }}"></i>
            <span id="errors_return_price{{ $plan === null ? '' : '_'.$plan->id }}" style="color: red;"></span>
        </div>
        金額
        <span class="hissu_txt">必須</span>
    </div>
    <input type="number" name="price" class="p-postal-code def_input_100p" value="{{ old('price', optional($plan)->price) }}" placeholder="（例）100000" oninput="updateMyPlan.textInput(this, {{ $project->id }}, {{ $plan === null ? $plan : $plan->id }})">
</div>

<div class="form_item_row" style="display: flex; flex-direction: column">
    <div class="form_item_tit">リターン画像<span class="hissu_txt">必須</span></div>
    <div class="plan_image_wrapper">
        <div class="form_item_tit">
            <div class="spinner-wrapper">
                <div class="spinner" id="spinner_return_image_url{{ $plan === null ? '' : '_'.$plan->id }}"></div>
                <i class="fa fa-check-circle green" aria-hidden="true" id="saved_return_image_url{{ $plan === null ? '' : '_'.$plan->id }}"></i>
            </div>
        </div>
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
        <div class="input_file_button_wrapper">
            <label>
                <input type="file" name="image_url" hidden onChange="updateMyPlan.uploadImage(this, {{ $project->id }}, {{ $plan === null ? $plan : $plan->id }})">
                <a class="input_file_button">
                    ファイルを選択する
                </a>
            </label>
        </div>
    </div>
</div>

<div class="form_item_row">
    <div class="form_item_tit">
        <div class="spinner-wrapper">
            <div class="spinner" id="spinner_return_address_is_required{{ $plan === null ? '' : '_'.$plan->id }}"></div>
            <i class="fa fa-check-circle green" aria-hidden="true" id="saved_return_address_is_required{{ $plan === null ? '' : '_'.$plan->id }}"></i>
            <span id="errors_return_address_is_required{{ $plan === null ? '' : '_'.$plan->id }}" style="color: red;"></span>
        </div>
        住所情報の取得
        <small>(※リターンを配送する場合等に利用)</small>
        <span class="hissu_txt">必須</span>
    </div>
    <div class="cp_ipselect cp_normal">
        <select name="address_is_required" class="p-region" onChange="updateMyPlan.selectorInput(this, {{ $project->id }}, {{ $plan === null ? $plan : $plan->id }})">
            <option value=0 {{ optional($plan)->address_is_required === 0 ? 'selected' : '' }}>要</option>
            <option value=1 {{ optional($plan)->address_is_required === 1 ? 'selected' : '' }}>不要</option>
        </select>
    </div>
</div>
<div class="def_btn">
    <button type="submit" class="disable-btn">
        <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">保存する</p>
    </button>
</div>
