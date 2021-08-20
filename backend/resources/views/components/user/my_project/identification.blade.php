<form action="{{ route('user.my_project.project.update', ['project' => $project, 'current_tab' => 'identification']) }}" method="post" class="h-adr" enctype="multipart/form-data">
    @csrf
    @method('PUT')
<span class="p-country-name" style="display:none;">Japan</span>
<div class="form_item_row">
    <div class="form_item_tit">姓（全角）<span class="hissu_txt">必須</span></div>
    <input type="text" name="last_name" class="def_input_100p"
        value="{{ old('last_name', optional($user->profile)->last_name) }}" oninput="updateMyProject.textInput(this, {{ $project->id }})">
    <div class="spinner-wrapper">
        <div class="spinner" id="spinner_last_name"></div>
        <p class="saved_icon" aria-hidden="true" aria-hidden="true" style="display: none;" id="saved_last_name">保存しました</p>
        <span id="errors_last_name" style="color: red;"></span>
    </div>
</div>

<div class="form_item_row">
    <div class="form_item_tit">名（全角）<span class="hissu_txt">必須</span></div>
    <input type="text" name="first_name" class="def_input_100p"
        value="{{ old('first_name', optional($user->profile)->first_name) }}" oninput="updateMyProject.textInput(this, {{ $project->id }})">
    <div class="spinner-wrapper">
        <div class="spinner" id="spinner_first_name"></div>
        <p class="saved_icon" aria-hidden="true" aria-hidden="true" style="display: none;" id="saved_first_name">保存しました</p>
        <span id="errors_first_name" style="color: red;"></span>
    </div>
</div>

<div class="form_item_row">
    <div class="form_item_tit">セイ（全角）<span class="hissu_txt">必須</span></div>
    <input type="text" name="last_name_kana" class="def_input_100p"
        value="{{ old('last_name_kana', optional($user->profile)->last_name_kana) }}" oninput="updateMyProject.textInput(this, {{ $project->id }})">
    <div class="spinner-wrapper">
        <div class="spinner" id="spinner_last_name_kana"></div>
        <p class="saved_icon" aria-hidden="true" aria-hidden="true" style="display: none;" id="saved_last_name_kana">保存しました</p>
        <span id="errors_last_name_kana" style="color: red;"></span>
    </div>
</div>

<div class="form_item_row">
    <div class="form_item_tit">メイ（全角）<span class="hissu_txt">必須</span></div>
    <input type="text" name="first_name_kana" class="def_input_100p"
        value="{{ old('first_name_kana', optional($user->profile)->first_name_kana) }}" oninput="updateMyProject.textInput(this, {{ $project->id }})">
    <div class="spinner-wrapper">
        <div class="spinner" id="spinner_first_name_kana"></div>
        <p class="saved_icon" aria-hidden="true" aria-hidden="true" style="display: none;" id="saved_first_name_kana">保存しました</p>
        <span id="errors_first_name_kana" style="color: red;"></span>
    </div>
</div>

<div class="form_item_row">
    <div class="form_item_tit">電話番号（ハイフンなし）<span class="hissu_txt">必須</span></div>
    <input type="number" name="phone_number" class="def_input_100p"
        value="{{ old('phone_number', optional($user->profile)->phone_number) }}" oninput="updateMyProject.textInput(this, {{ $project->id }})">
    <div class="spinner-wrapper">
        <div class="spinner" id="spinner_phone_number"></div>
        <p class="saved_icon" aria-hidden="true" aria-hidden="true" style="display: none;" id="saved_phone_number">保存しました</p>
        <span id="errors_phone_number" style="color: red;"></span>
    </div>
</div>

<div class="form_item_row">
    <div class="form_item_tit">郵便番号（ハイフンなし）<span class="hissu_txt">必須</span></div>
    <input type="number" id="postal_code" name="postal_code" class="p-postal-code def_input_100p"
        value="{{ old('postal_code', optional($user->address)->postal_code) }}" onchange="updateMyProject.checkDateIsFilled(this, {{ $project->id }})">
    <div class="spinner-wrapper">
        <div class="spinner" id="spinner_postal_code"></div>
        <p class="saved_icon" aria-hidden="true" aria-hidden="true" style="display: none;" id="saved_postal_code">保存しました</p>
        <span id="errors_postal_code" style="color: red;"></span>
    </div>
</div>

<div class="form_item_row">
    <div class="form_item_tit">都道府県<span class="hissu_txt">必須</span></div>
    <div class="cp_ipselect cp_normal">
        <select id="prefecture" name="prefecture" class="p-region" oninput="updateMyProject.textInput(this, {{ $project->id }})">
                <option value="non_selected">選択してください</option>
            @for($i = 1; $i <= 47; $i++)
                <option value="{{ PrefectureHelper::getPrefectures()[$i] }}" {{ optional($user->address)->prefecture === PrefectureHelper::getPrefectures()[$i] || old('prefecture') === PrefectureHelper::getPrefectures()[$i] ? 'selected' : '' }}>{{ PrefectureHelper::getPrefectures()[$i] }}</option>
            @endfor
        </select>
    </div>
    <div class="form_item_tit">
        <div class="spinner-wrapper">
            <div class="spinner" id="spinner_prefecture"></div>
            <p class="saved_icon" aria-hidden="true" aria-hidden="true" style="display: none;" id="saved_prefecture">保存しました</p>
        </div>
    </div>
</div>

<div class="form_item_row">
    <div class="form_item_tit">市区町村<span class="hissu_txt">必須</span></div>
    <input type="text" id="city" name="city" class="p-locality def_input_100p"
        value="{{ old('city', optional($user->address)->city) }}" oninput="updateMyProject.textInput(this, {{ $project->id }})">
    <div class="spinner-wrapper">
        <div class="spinner" id="spinner_city"></div>
        <p class="saved_icon" aria-hidden="true" aria-hidden="true" style="display: none;" id="saved_city">保存しました</p>
    </div>
</div>

<div class="form_item_row">
    <div class="form_item_tit">町域•番地<span class="hissu_txt">必須</span></div>
    <input type="text" id="block" name="block" class="p-street-address def_input_100p"
        value="{{ old('block', optional($user->address)->block) }}" oninput="updateMyProject.textInput(this, {{ $project->id }})">
    <div class="spinner-wrapper">
        <div class="spinner" id="spinner_block"></div>
        <p class="saved_icon" aria-hidden="true" aria-hidden="true" style="display: none;" id="saved_block">保存しました</p>
    </div>
</div>

<div class="form_item_row">
    <div class="form_item_tit">建物名<span class="nini_txt">任意</span></div>
    <input type="text" name="building" class="p-extended-address def_input_100p"
        value="{{ old('building', optional($user->address)->building) }}" oninput="updateMyProject.textInput(this, {{ $project->id }})">
    <div class="spinner-wrapper">
        <div class="spinner" id="spinner_building"></div>
        <p class="saved_icon" aria-hidden="true" aria-hidden="true" style="display: none;" id="saved_building">保存しました</p>
    </div>
</div>

<div class="form_item_row">
    <div class="form_item_tit">
        生年月日<span class="hissu_txt">必須</span>
    </div>
    <input type="text" id="birthday" name="birthday" class="p-postal-code def_input_100p"
        value="{{ old('start_date', $user->profile->birthday) }}" oninput="updateMyProject.textInput(this, {{ $project->id }})">
    <div class="spinner-wrapper">
        <div class="spinner" id="spinner_birthday"></div>
        <p class="saved_icon" aria-hidden="true" aria-hidden="true" style="display: none;" id="saved_birthday">保存しました</p>
        <span id="errors_birthday" style="color: red;"></span>
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
                <div id="identify_image_1" class="ib02_01 E-font my_project_img_wrapper identify_img">
                    <img src="{{ Storage::url($user->identification->identify_image_1) }}">
                </div>
                <div class="form_item_tit" style="margin-bottom: 10px">本人確認書類1</div>
                <div class="input_file_button_wrapper">
                    <label>
                        <input name="identify_image_1" type="file" hidden onChange="uploadedImageHandler(this, 'identify_image_1', {{ $project->id }})">
                        <a class="input_file_button">
                            ファイルを選択する
                        </a>
                        <div class="spinner-wrapper">
                            <div class="spinner" id="spinner_identify_image_1"></div>
                            <p class="saved_icon" aria-hidden="true" style="display: none;" id="saved_identify_image_1">保存しました</p>
                            <span id="errors_identify_image_1" style="color: red;"></span>
                        </div>
                    </label>
                </div>
            </div>
            <div style="text-align: center;">
                <div id="identify_image_2" class="ib02_01 E-font my_project_img_wrapper identify_img">
                    <img src="{{ Storage::url($user->identification->identify_image_2) }}">
                </div>
                <div class="form_item_tit" style="margin-bottom: 10px">本人確認書類2</div>
                <div class="input_file_button_wrapper">
                    <label>
                        <input name="identify_image_2" type="file" hidden onChange="uploadedImageHandler(this, 'identify_image_2', {{ $project->id }})">
                        <a class="input_file_button">
                            ファイルを選択する
                        </a>
                        <div class="spinner-wrapper">
                            <div class="spinner" id="spinner_identify_image_2"></div>
                            <p class="saved_icon" aria-hidden="true" style="display: none;" id="saved_identify_image_2">保存しました</p>
                            <span id="errors_identify_image_2" style="color: red;"></span>
                        </div>
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
                    健康保険被保険者証
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
    <div class="form_item_tit">
        金融機関コード・銀行コード
        <span class="hissu_txt">必須</span>
    <br/>
        <span>
            <a href="https://www.zenginkyo.or.jp/abstract/outline/organization/member-01/" target="_blank">
                <i class="fas fa-external-link-alt"></i>
                金融機関コードが不明な方はこちら
            </a>
        </span>
    </div>
    <input type="number" name="bank_code" class="def_input_100p"
        value="{{ old('bank_code', optional($user->identification)->bank_code) }}" oninput="updateMyProject.textInput(this, {{ $project->id }})">
    <div class="spinner-wrapper">
        <div class="spinner" id="spinner_bank_code"></div>
        <p class="saved_icon" aria-hidden="true" style="display: none;" id="saved_bank_code">保存しました</p>
        <span id="errors_bank_code" style="color: red;"></span>
    </div>
</div>

<div class="form_item_row">
    <div class="form_item_tit">支店番号<span class="hissu_txt">必須</span></div>
    <input type="number" name="branch_code" class="def_input_100p"
        value="{{ old('branch_code', optional($user->identification)->branch_code) }}" oninput="updateMyProject.textInput(this, {{ $project->id }})">
    <div class="spinner-wrapper">
        <div class="spinner" id="spinner_branch_code"></div>
        <p class="saved_icon" aria-hidden="true" style="display: none;" id="saved_branch_code">保存しました</p>
        <span id="errors_branch_code" style="color: red;"></span>
    </div>
</div>

<div class="form_item_row">
    <div class="form_item_tit">口座種別<span class="hissu_txt">必須</span></div>
    <div class="cp_ipselect cp_normal">
        <select name="account_type" class="p-region" oninput="updateMyProject.textInput(this, {{ $project->id }})">
            @foreach(\App\Enums\BankAccountType::getValues() as $account_type)
                <option value="{{ $account_type }}" {{ optional($user->identification)->account_type === $account_type ? 'selected' : '' }}>{{ $account_type }}</option>
            @endforeach
        </select>
    </div>
    <div class="form_item_tit">
        <div class="spinner-wrapper">
            <div class="spinner" id="spinner_account_type"></div>
            <p class="saved_icon" aria-hidden="true" style="display: none;" id="saved_account_type">保存しました</p>
            <span id="errors_account_type" style="color: red;"></span>
        </div>
    </div>
</div>

<div class="form_item_row">
    <div class="form_item_tit">口座番号<span class="hissu_txt">必須</span></div>
    <input type="number" name="account_number" class="def_input_100p"
        value="{{ old('account_number', optional($user->identification)->account_number) }}" oninput="updateMyProject.textInput(this, {{ $project->id }})">
    <div class="spinner-wrapper">
        <div class="spinner" id="spinner_account_number"></div>
        <p class="saved_icon" aria-hidden="true" style="display: none;" id="saved_account_number">保存しました</p>
        <span id="errors_account_number" style="color: red;"></span>
    </div>
</div>

<div class="form_item_row">
    <div class="form_item_tit">口座名義<span class="hissu_txt">必須</span></div>
    <input type="text" name="account_name" class="def_input_100p"
        value="{{ old('account_name', optional($user->identification)->account_number) }}" oninput="updateMyProject.textInput(this, {{ $project->id }})">
    <div class="spinner-wrapper">
        <div class="spinner" id="spinner_account_name"></div>
        <p class="saved_icon" aria-hidden="true" style="display: none;" id="saved_account_name">保存しました</p>
        <span id="errors_account_name" style="color: red;"></span>
    </div>
</div>

<x-common.save_back_button />
</form>
