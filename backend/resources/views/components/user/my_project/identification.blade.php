<form action="{{ route('user.my_project.project.update', ['project' => $project, 'current_tab' => 'identification']) }}" method="post" class="h-adr" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="ps_description">
        <h4 style="color: #e65d65">以下の注意事項をご確認ください。</h4>
        <ul>
            <li>ここで入力した個人情報は第三者に開示したり、プロジェクトに掲載される事はありません。</li>
        </ul>
    </div>
    <span class="p-country-name" style="display:none;">Japan</span>
    <div class="form_item_row">
        <div class="form_item_tit">姓（全角）<span class="hissu_txt">必須</span></div>
        <input type="text" name="last_name" class="def_input_100p"
            value="{{ old('last_name', optional($user->profile)->last_name) }}" oninput="updateMyProject.textInput(this, {{ $project->id }})">
        <x-common.async-submit-message propName="last_name" />
    </div>

    <div class="form_item_row">
        <div class="form_item_tit">名（全角）<span class="hissu_txt">必須</span></div>
        <input type="text" name="first_name" class="def_input_100p"
            value="{{ old('first_name', optional($user->profile)->first_name) }}" oninput="updateMyProject.textInput(this, {{ $project->id }})">
        <x-common.async-submit-message propName="first_name" />
    </div>

    <div class="form_item_row">
        <div class="form_item_tit">セイ（全角）<span class="hissu_txt">必須</span></div>
        <input type="text" name="last_name_kana" class="def_input_100p"
            value="{{ old('last_name_kana', optional($user->profile)->last_name_kana) }}" oninput="updateMyProject.textInput(this, {{ $project->id }})">
        <x-common.async-submit-message propName="last_name_kana" />
    </div>

    <div class="form_item_row">
        <div class="form_item_tit">メイ（全角）<span class="hissu_txt">必須</span></div>
        <input type="text" name="first_name_kana" class="def_input_100p"
            value="{{ old('first_name_kana', optional($user->profile)->first_name_kana) }}" oninput="updateMyProject.textInput(this, {{ $project->id }})">
        <x-common.async-submit-message propName="first_name_kana" />
    </div>

    <div class="form_item_row">
        <div class="form_item_tit">電話番号（ハイフンなし）<span class="hissu_txt">必須</span></div>
        <input type="number" name="phone_number" class="def_input_100p"
            value="{{ old('phone_number', optional($user->profile)->phone_number !== '00000000000' ? optional($user->profile)->phone_number : '') }}" oninput="updateMyProject.textInput(this, {{ $project->id }})">
        <x-common.async-submit-message propName="phone_number" />
    </div>

    <div class="form_item_row">
        <div class="form_item_tit">郵便番号（ハイフンなし）<span class="hissu_txt">必須</span></div>
        <input type="number" id="postal_code" name="postal_code" class="p-postal-code def_input_100p"
            value="{{ old('postal_code', optional($user->address)->postal_code) }}" onchange="updateMyProject.checkDateIsFilled(this, {{ $project->id }})">
        <x-common.async-submit-message propName="postal_code" />
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
            <x-common.async-submit-message propName="prefecture" />
        </div>
    </div>

    <div class="form_item_row">
        <div class="form_item_tit">市区町村<span class="hissu_txt">必須</span></div>
        <input type="text" id="city" name="city" class="p-locality def_input_100p"
            value="{{ old('city', optional($user->address)->city) }}" oninput="updateMyProject.textInput(this, {{ $project->id }})">
        <x-common.async-submit-message propName="city" />
    </div>

    <div class="form_item_row">
        <div class="form_item_tit">町域<span class="hissu_txt">必須</span></div>
        <input type="text" id="block" name="block" class="p-street-address def_input_100p"
            value="{{ old('block', optional($user->address)->block) }}" oninput="updateMyProject.textInput(this, {{ $project->id }})">
        <x-common.async-submit-message propName="block" />
    </div>

    <div class="form_item_row">
        <div class="form_item_tit">番地<span class="hissu_txt">必須</span></div>
        <input type="text" name="block_number" class="p-extended-address def_input_100p"
            value="{{ old('block_number', optional($user->address)->block_number) }}" oninput="updateMyProject.textInput(this, {{ $project->id }})">
        <x-common.async-submit-message propName="block_number" />
    </div>

    <div class="form_item_row">
        <div class="form_item_tit">建物名<span class="nini_txt">任意</span></div>
        <input type="text" name="building" class="p-extended-address def_input_100p"
            value="{{ old('building', optional($user->address)->building) }}" oninput="updateMyProject.textInput(this, {{ $project->id }})">
        <x-common.async-submit-message propName="building" />
    </div>

    <div class="form_item_row">
        <div class="form_item_tit">
            生年月日<span class="hissu_txt">必須</span>
        </div>
        <input type="text" id="birthday" name="birthday" class="def_input_100p"
            value="{{ old('start_date', $user->profile->birthday !== '0001-01-01' ? $user->profile->birthday : '') }}" oninput="updateMyProject.textInput(this, {{ $project->id }})">
        <x-common.async-submit-message propName="birthday" />
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
                        <img src="{{ asset(Storage::url($user->identification->identify_image_1)) }}">
                    </div>
                    <div class="form_item_tit" style="margin-bottom: 10px">本人確認書類1</div>
                    <div class="input_file_button_wrapper">
                        <label>
                            <input name="identify_image_1" type="file" hidden onChange="uploadedImageHandler(this, 'identify_image_1', {{ $project->id }})">
                            <a class="input_file_button">
                                ファイルを選択する
                            </a>
                            <x-common.async-submit-message propName="identify_image_1" />
                        </label>
                    </div>
                </div>
                <div style="text-align: center;">
                    <div id="identify_image_2" class="ib02_01 E-font my_project_img_wrapper identify_img">
                        <img src="{{ asset(Storage::url($user->identification->identify_image_2)) }}">
                    </div>
                    <div class="form_item_tit" style="margin-bottom: 10px">本人確認書類2</div>
                    <div class="input_file_button_wrapper">
                        <label>
                            <input name="identify_image_2" type="file" hidden onChange="uploadedImageHandler(this, 'identify_image_2', {{ $project->id }})">
                            <a class="input_file_button">
                                ファイルを選択する
                            </a>
                            <x-common.async-submit-message propName="identify_image_2" />
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
                        パスポート（顔写真と所持人記入欄（要住所記入）のページ）<br/>
                        ※2020年1月以前に発行されたもの
                    </li>
                </ul>
                <strong>1枚（表面）</strong>
                <ul>
                    <li>個人番号カード/マイナンバーカード（顔写真付き。表面のみ。通知カードは不可。）</li>
                    <li>在留カード・特別永住者証明書（顔写真付き）</li>
                    <li>住民基本台帳カード/住基カード（顔写真付き）</li>
                </ul>
                <h4 style="color: #e65d65">※顔写真付きの本人確認書類をご提出ください。</h4>
            </div>
        </div>
    </div>

    <div class="form_item_row">
        <div class="form_item_tit">
            銀行口座<span class="hissu_txt">必須</span>
            <br/>
            <span class="disclaimer">
                ※銀行口座が未設定の方は以下のリンクから銀行口座を設定してください。
            </span>
        </div>
        <a href="{{ route('user.bank_account.edit') }}" target="_blank">
            <i class="fas fa-external-link-alt"></i>
            銀行口座入力フォーム
        </a>
    </div>

    <x-common.navigating_page_buttons :project="$project" nextPageButton="unnecessary" />
</form>
