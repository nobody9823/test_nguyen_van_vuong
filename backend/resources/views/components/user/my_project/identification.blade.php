<form action="{{ route('user.my_project.project.update', ['project' => $project, 'current_tab' => 'identification']) }}" method="post" class="h-adr my_project" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="ps_description">
        <h4 style="color: #e65d65">以下の注意事項をご確認ください。</h4>
        <ul>
            <li>ここで入力した個人情報は第三者に開示したり、プロジェクトに掲載される事はありません。</li>
        </ul>
    </div>
    <span class="p-country-name" style="display:none;">Japan</span>
    @foreach($user->address as $address)
    <div class="form_item_list identidication">
        <input type="hidden" id="address" name="address[]" value="{{ $address->id }}">
        <div class="form_item_button">
            <div class="form_item_row">
                <div class="form_item_01">
                    <input
                        type="radio"
                        id="select_address_{{ $loop->index }}"
                        name="select_address"
                        class="form"
                        value="{{ $loop->index }}"
                        onclick="updateMyProject.inputIsMain(this, {{ $address->id }})"
                        {{ optional($address)->is_main === 1 ?'checked':'' }}
                    >
                    <label for="select_address_{{ $loop->index }}" class="radio-fan"></label>
                </div>
            </div>
        </div>
        <div class="form_item_address">
            <div class="spinner-wrapper">
                <div class="spinner" id="spinner_select_address_{{ $loop->index }}"></div>
                <p class="saved_icon" aria-hidden="true" aria-hidden="true" style="display: none;" id="saved_select_address_{{ $loop->index }}">メインアカウントに更新しました</p>
                <span id="errors_select_address_{{ $loop->index }}" style="color: red;"></span>
            </div>
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
                    <button type="button" id="openModalEdit" class="btn btn-primary form-btn edit_button" value="{{ $loop->index }}">編集</button>
                    <a class="delete_button" href="{{ route('user.my_project.delete_address', ['project' => $project, 'address_id' => $address->id]) }}">削除</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="form_item_row">
        <div class="form_item_tit def_btn">
            <button type="button" id="openModal" class="disable-btn">
                <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">お届け先を追加する</p>
            </button>
        </div>
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

<section id="modalArea" class="modalArea">
    <div id="modalBg" class="modalBg"></div>
    <div class="modalWrapper">
        <form id="form1" action="" class="h-adr" method="post">
            @csrf
            <input type="hidden" name="address_id" id="address_id_modal" value="">
            <input type="hidden" name="is_main" id="is_main_modal" value="">
            <div class="form_item_row">
                <div class="form_item_tit">姓（全角）<span class="hissu_txt">必須</span></div>
                <input type="text" id="last_name_modal" name="last_name" class="def_input_100p">
            </div>

            <div class="form_item_row">
                <div class="form_item_tit">名（全角）<span class="hissu_txt">必須</span></div>
                <input type="text" id="first_name_modal" name="first_name" class="def_input_100p">
            </div>

            <div class="form_item_row">
                <div class="form_item_tit">セイ（全角）<span class="hissu_txt">必須</span></div>
                <input type="text" id="last_name_kana_modal" name="last_name_kana" class="def_input_100p">
            </div>

            <div class="form_item_row">
                <div class="form_item_tit">メイ（全角）<span class="hissu_txt">必須</span></div>
                <input type="text" id="first_name_kana_modal" name="first_name_kana" class="def_input_100p">
            </div>

            <div class="form_item_row">
                <div class="form_item_tit">電話番号（ハイフンなし）<span class="hissu_txt">必須</span></div>
                <input type="number" id="phone_number_modal" name="phone_number" class="def_input_100p">
            </div>

            <div class="form_item_row">
                <div class="form_item_tit">郵便番号<span class="hissu_txt">必須</span></div>
                <input type="text" id="postal_code_modal" name="postal_code" class="p-postal-code def_input_100p">
            </div>

            <div class="form_item_row">
                <div class="form_item_tit">都道府県<span class="hissu_txt">必須</span></div>
                <div class="cp_ipselect cp_normal">
                    <select id="prefecture_modal" name="prefecture" class="p-region">
                            <option value="non_selected">選択してください</option>
                        @for($i = 1; $i <= 47; $i++)
                            <option value="{{ PrefectureHelper::getPrefectures()[$i] }}">{{ PrefectureHelper::getPrefectures()[$i] }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="form_item_row">
                <div class="form_item_tit">市区町村<span class="hissu_txt">必須</span></div>
                <input type="text" id="city_modal" name="city" class="p-locality def_input_100p">
            </div>

            <div class="form_item_row">
                <div class="form_item_tit">町域<span class="hissu_txt">必須</span></div>
                <input type="text" id="block_modal" name="block" class="p-street-address def_input_100p">
            </div>

            <div class="form_item_row">
                <div class="form_item_tit">番地<span class="hissu_txt">必須</span></div>
                <input type="text" id="block_number_modal" name="block_number" class="p-extended-address def_input_100p">
            </div>

            <div class="form_item_row">
                <div class="form_item_tit">建物名<span class="nini_txt">任意</span></div>
                <input type="text" id="building_modal" name="building" class="p-extended-address def_input_100p">
            </div>
            <div class="def_btn">
                <button id="modal_button" type="button" class="disable-btn">
                    <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">保存</p>
                </button>
            </div>
        </form>
    <div id="closeModal" class="closeModal">
      ×
    </div>
  </div>
</section>
<script>
$('#openModal, #openModalEdit').click(function() {
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
    if ($('#address_id_modal').val() == "") {
        $('#is_main_modal').val(1)
        $('#form1').attr('action', "{{ route('user.my_project.regist_address', ['project' => $project]) }}")
    } else {
        $('#is_main_modal').val(1)
        $('#form1').attr('action', "{{ route('user.my_project.edit_address', ['project' => $project]) }}")
    }
    $('#form1').submit()
})
</script>
