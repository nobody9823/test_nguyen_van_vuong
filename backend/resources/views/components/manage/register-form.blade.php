<div class="form-group user_login">
    <label class="control-label">企業名</label>
    <input style="margin-bottom: 10px;" name='name' type="text"
        class={{"form-control".($errors->has('name') ? ' is-invalid' : '')}} placeholder='お名前'
        value="{{ old('name') }}" required>
    <label class="control-label">事業所在地</label>
    <input style="margin-bottom: 10px;" name='office_address' type="text"
        class={{"form-control".($errors->has('office_address') ? ' is-invalid' : '')}} placeholder='123-1234 東京都〇〇区〇〇ー〇ー〇'
        value="{{ old('office_address') }}" required>
    <label class="control-label">電話番号</label>
    <input style="margin-bottom: 10px;" name='phone_number' type="text" pattern="^\d{11}$|^\d{2,4}-\d{3,4}-\d{4}$"
        class={{"form-control".($errors->has('phone_number') ? ' is-invalid' : '')}} placeholder='012-3456-7890 ※ハイフンあり'
        value="{{ old('phone_number') }}" required>
    <label class="control-label">振込先銀行名<br/>※支援金の振込先銀行口座</label>
    <input style="margin-bottom: 10px;" name='bank_name' type="text"
        class={{"form-control".($errors->has('bank_name') ? ' is-invalid' : '')}} placeholder='東京〇〇銀行'
        value="{{ old('bank_name') }}" required>
    <label class="control-label">振込先銀行支店名</label>
    <input style="margin-bottom: 10px;" name='bank_branch_name' type="text"
        class={{"form-control".($errors->has('bank_branch_name') ? ' is-invalid' : '')}} placeholder='〇〇支店'
        value="{{ old('bank_branch_name') }}" required>
    <label class="control-label">振込先銀行口座番号</label>
    <input style="margin-bottom: 10px;" name='bank_account_number' type="text" pattern="^\d{14,16}$"
        class={{"form-control".($errors->has('bank_account_number') ? ' is-invalid' : '')}} placeholder='123456789012345 14桁〜16桁の数字'
        value="{{ old('bank_account_number') }}" required>
    <label class="control-label">振込先銀行口座名義人名</label>
    <input style="margin-bottom: 10px;" name='bank_account_holder' type="text" pattern="^[A-Z\x20]*$"
        class={{"form-control".($errors->has('bank_account_holder') ? ' is-invalid' : '')}} placeholder='GUARDIAN TAROU 大文字英字 間に半角スペースを入れてください'
        value="{{ old('bank_account_holder') }}" required>
    <label class="control-label">ログインパスワード</label>
    <input style="margin-bottom: 10px;" name='password' type="password" pattern="^(?=.*?[a-zA-Z])(?=.*?\d)[a-zA-Z\d]{8,100}$"
        class={{"form-control".($errors->has('password') ? ' is-invalid' : '')}} placeholder='※半角英数字それぞれ1文字以上含む8文字以上の文字列'
        value="{{ old('password') }}" required>
    <label class="control-label">ログインパスワード（確認用）</label>
    <input style="margin-bottom: 10px;" name='password_confirmation' type="password"
        class={{"form-control".($errors->has('password_confirmation') ? ' is-invalid' : '')}} placeholder='ログインパスワード（確認用）'
        value="{{ old('password_confirmation') }}" required>
    <label class="control-label">証明書/登記簿謄本等確認書類<br/>※登記簿謄本は発行から３ヶ月以内のもの<br/>(最大3つ)</label>
    <div class="user_profile_img">
        <label class="btn-image-upload" style="cursor: pointer;">
            <i class="far fa-image"></i>
            <input type="file" name="certificate_files[]" style="display: none;"
                accept="image/jpeg, image/png, application/pdf, application/zip, application/msword, application/msexcel"
                class="image_file" id="numberOfFiles" multiple="multiple" onchange="uploadImage(this);">
            <p>ファイルをアップロードする</p>
            <p>※.jpg, .jpeg, .png, .pdf, .zip, .doc, .xls形式のファイル</p>
        </label>
        <div id="preview"></div>
    </div>
    <label class="control-label">このサービスを知ったきっかけ<br/>(任意)</label>
    <select style="margin-bottom: 10px;" name='recognition_of_service'
        class={{"select_item_main".($errors->has('recognition_of_service') ? ' is-invalid' : '')}}>
        <option value="---" class="select_item_tit">---</option>
        <option value="Web検索" class="select_item_tit">Web検索</option>
        <option value="SNS" class="select_item_tit">SNS</option>
        <option value="広告" class="select_item_tit">広告</option>
        <option value="友人、知人" class="select_item_tit">友人、知人</option>
        <option value="その他" class="select_item_tit">その他</option>
    </select>
</div>
<div class="my-page_checkbox">
    <input type="checkbox" required>
    <a href="{{ route('user.terms') }}" target="_blank">利用規約</a>
    <p>と</p>
    <a href="{{ route('user.privacy_policy') }}" target="_blank">プライバシーポリシー</a>
    <p>に同意する</p>
</div>
<button type="submit" id="send" class="my-page_btn">本登録申請を完了する</button>
