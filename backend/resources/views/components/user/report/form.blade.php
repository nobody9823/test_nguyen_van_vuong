<div class="form_item_row">
    <div class="form_item_tit">
      <p class="prof_edit_01">タイトル</p>
    </div>
    <span class="disclaimer">
        ※50文字まで
    </span>
    <input type="text" name="title" class="p-postal-code def_input_100p" value="{{ old('title', optional($report)->title) }}">
</div>

<div class="form_item_row">
    <div class="form_item_tit">
        <p class="prof_edit_01">活動報告内容</p>
        <span class="disclaimer">
            ※2000文字まで
        </span>
    </div>
    <textarea class="def_textarea" rows="20" name="content">{{ old('content', optional($report)->content) }}</textarea>
</div>

<div class="form_item_row">
    <div class="prof_edit_01">プロフィール写真</div>
    <div class="prof_edit_editbox">
        <input type="file" name="image_url" accept=".png, .jpg, .jpeg, .gif"><br>
        <span class="prof_edit_editbox_desc">ファイルサイズは1MB以下<br>ファイル形式は jpeg、gif、png 形式のみ可</span>
    </div>
</div>

<div class="def_btn">
  <button type="submit" class="disable-btn">
    <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">保存</p>
  </button>
</div>


<style>
  .report_form{
    margin: 40px 5px 40px 5px;
  }

    /* PCサイズ */
  @media (min-width: 767px) {
  .report_form .prof_edit_01 { width: 35%;}
  .report_form .prof_edit_editbox { width: 65%; }
}
</style>