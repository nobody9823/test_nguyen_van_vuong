<div class="form_item_row">
    <div class="form_item_tit">
      <p class="prof_edit_01">タイトル</p>
    </div>
    <span class="disclaimer">
        ※50文字まで
    </span>
    <input type="text" name="title" class="p-postal-code def_input_100p" value="{{ old('title', optional($report)->title) }}" required maxlength='50'>
</div>

<div class="form_item_row">
    <div class="form_item_tit">
        <p class="prof_edit_01">活動報告内容</p>
        <span class="disclaimer">
            ※2000文字まで
        </span>
    </div>
    <textarea class="def_textarea" rows="20" name="content" required maxlength='2000'>{{ old('content', optional($report)->content) }}</textarea>
</div>

<div class="form_item_row">
    <div class="prof_edit_01">プロフィール写真</div>
    <div class="prof_edit_editbox">
      <span class="prof_edit_editbox_desc">ファイルサイズは1MB以下<br>ファイル形式は jpeg、gif、png 形式のみ可</span>
      <input id="imageUploader" type="file" name="image_url" accept=".png, .jpg, .jpeg, .gif"><br>
      @if($report)
      <img src="{{asset(Storage::url($report->image_url))}}" style='height:200px; object-fit: cover;' alt="image">
      @endif
    </div>
</div>

<br>
<div class="def_btn">
  <button type="submit" class="disable-btn">
    <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">保存</p>
  </button>
</div>

@if($report)
<div class="def_btn">
  <button type="submit" class="disable-btn" onclick="return confirm('本当に削除しますか？')" name="delete" value="delete">
    <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">削除</p>
  </button>
</div>
@endif

@section('script')
<script>
  $(function() {
    $('#imageUploader').after('<span id="uploadedImage"></span>');

    // アップロードするファイルを選択
    $('#imageUploader').change(function() {
      var file = $(this).prop('files')[0];

      // 画像以外は処理を停止
      if (! file.type.match('image.*')) {
        // クリア
        $(this).val('');
        $('#uploadedImage').html('');
        return;
      }

      // 画像表示
      var reader = new FileReader();
      reader.onload = function() {
        var img_src = $('<img>').attr('src', reader.result).attr('style','height:300px; width:300px; object-fit: contain;');
        $('#uploadedImage').html(img_src);
      }
      reader.readAsDataURL(file);
    });
  });
</script>
@endsection