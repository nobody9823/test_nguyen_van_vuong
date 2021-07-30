<form action="{{ route('user.my_project.project.update', ['project' => $project, 'current_tab' => 'identification']) }}" method="post" class="h-adr">
    @csrf
    @method('PUT')
<span class="p-country-name" style="display:none;">Japan</span>
<div class="form_item_row">
    <div class="form_item_tit">姓（全角）<span class="hissu_txt">必須</span></div>
    <input type="text" name="first_name" class="def_input_100p" value="{{ old('first_name', optional($user->profile)->first_name) }}">
</div>

<div class="form_item_row">
    <div class="form_item_tit">名（全角）<span class="hissu_txt">必須</span></div>
    <input type="text" name="last_name" class="def_input_100p" value="{{ old('last_name', optional($user->profile)->last_name) }}">
</div>

<div class="form_item_row">
    <div class="form_item_tit">セイ（全角）<span class="hissu_txt">必須</span></div>
    <input type="text" name="first_name_kana" class="def_input_100p" value="{{ old('first_name_kana', optional($user->profile)->first_name_kana) }}">
</div>

<div class="form_item_row">
    <div class="form_item_tit">メイ（全角）<span class="hissu_txt">必須</span></div>
    <input type="text" name="last_name_kana" class="def_input_100p" value="{{ old('last_name_kana', optional($user->profile)->last_name_kana) }}">
</div>

<div class="form_item_row">
    <div class="form_item_tit">電話番号（ハイフンなし）<span class="hissu_txt">必須</span></div>
    <input type="number" name="phone_number" class="def_input_100p" value="{{ old('phone_number', optional($user->profile)->phone_number) }}">
</div>

<div class="form_item_row">
    <div class="form_item_tit">郵便番号（ハイフンなし）<span class="hissu_txt">必須</span></div>
        <input type="number" name="postal_code" onKeyUp="AjaxZip2.zip2addr(this,'prefecture','address');" class="p-postal-code def_input_100p" value="{{ old('postal_code', optional($user->address)->postal_code) }}">
    </div>

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
    </div>

    <div class="form_item_row">
        <div class="form_item_tit">市区町村<span class="hissu_txt">必須</span></div>
        <input type="text" name="city" class="p-locality def_input_100p" value="{{ old('city', optional($user->address)->city) }}">
    </div>

    <div class="form_item_row">
        <div class="form_item_tit">番地<span class="hissu_txt">必須</span></div>
        <input type="text" name="block" class="p-street-address def_input_100p"  value="{{ old('block', optional($user->address)->block) }}">
    </div>

    <div class="form_item_row">
        <div class="form_item_tit">建物名<span class="nini_txt">任意</span></div>
        <input type="text" name="building" class="p-extended-address def_input_100p"  value="{{ old('building', optional($user->address)->building) }}">
    </div>

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
</div>

<div class="form_item_row">
    <div class="form_item_tit">
        本人確認書類
        <span class="hissu_txt">必須</span>
    </div>
    <div class="identify_image_wrapper">
        <div>
            <div style="text-align: center;">
                @if (optional($user)->identification->identify_image_1 !== null)
                    <div class="ib02_01 E-font my_project_img_wrapper identify_img">
                        <img src="{{ Storage::url($user->identification->identify_image_1) }}">
                    </div>
                @endif
                <div class="form_item_tit" style="margin-bottom: 10px">本人確認書類1</div>
                <div class="input_file_button_wrapper">
                    <label>
                        <input type="file" hidden onChange="uploadIdentifyImage(this, {{ $project->id }}, 'identify_image_1', {{ $user->identification->id }})">
                        <a class="input_file_button">
                            ファイルを選択する
                        </a>
                    </label>
                </div>
            </div>
            <div style="text-align: center;">
                @if (optional($user)->identification->identify_image_2 !== null)
                    <div class="ib02_01 E-font my_project_img_wrapper identify_img">
                        <img src="{{ Storage::url($user->identification->identify_image_2) }}">
                    </div>
                @endif
                <div class="form_item_tit" style="margin-bottom: 10px">本人確認書類2</div>
                <div class="input_file_button_wrapper">
                    <label>
                        <input type="file" hidden onChange="uploadIdentifyImage(this, {{ $project->id }}, 'identify_image_2', {{ $user->identification->id }})">
                        <a class="input_file_button">
                            ファイルを選択する
                        </a>
                    </label>
                </div>
            </div>
        </div>
        <div class="identify_image_description">
            <h4 style="color: #e65d65">以下の注意事項をご確認ください。</h4>
            <strong>2枚（表裏両面）</strong>
            <ul>
                <li>運転免許証</li>
                <li>
                    健康保険被保険者証<br/>
                    ※保険者番号、被保険者等記号・番号・QRコードについては撮影時に隠してください
                </li>
                <li>
                    パスポート（顔写真と所持人記入欄（要住所記入）のページ）<br/>
                    ※2020年1月以前に発行されたもの
                </li>
            </ul>
            <strong>1枚（表面）</strong>
            <ul>
                <li>個人番号カード/マイナンバーカード（表面のみ。通知カードは不可）</li>
                <li>在留カード</li>
                <li>
                    住民票の写し<br/>
                    ※本籍・マイナンバーの表記がないもの
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="form_item_row">
    <div class="form_item_tit">金融機関コード・銀行コード<span class="hissu_txt">必須</span></div>
    <input type="number" name="bank_code" class="def_input_100p" value="{{ old('bank_code', optional($user->identification)->bank_code) }}">
</div>

<div class="form_item_row">
    <div class="form_item_tit">支店番号<span class="hissu_txt">必須</span></div>
    <input type="number" name="branch_code" class="def_input_100p" value="{{ old('branch_code', optional($user->identification)->branch_code) }}">
</div>

<div class="form_item_row">
    <div class="form_item_tit">口座種別<span class="hissu_txt">必須</span></div>
    <div class="cp_ipselect cp_normal">
        <select name="account_type" class="p-region">
            @foreach(\App\Enums\BankAccountType::getValues() as $account_type)
                <option value="{{ $account_type }}" {{ optional($user->identification)->account_type === $account_type ? 'selected' : '' }}>{{ $account_type }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form_item_row">
    <div class="form_item_tit">口座番号<span class="hissu_txt">必須</span></div>
    <input type="number" name="account_number" class="def_input_100p" value="{{ old('account_number', optional($user->identification)->account_number) }}">
</div>

<div class="form_item_row">
    <div class="form_item_tit">口座名義<span class="hissu_txt">必須</span></div>
    <input type="text" name="account_name" class="def_input_100p" value="{{ old('account_name', optional($user->identification)->account_number) }}">
</div>

<x-common.save_back_button />
</form>
