<input type="hidden" id="address_id" name="address_id" value="{{ $address->id }}">
<div class="form-group">
    <label>招待コード</label>
    @if (optional($user->profile)->inviter_code)
    <p>{{ optional($user->profile)->inviter_code }}</p>
    @else
    <small style="display: block">(プロフィール作成時に発行されます)</small style="display: block">
    @endif
</div>

<div class="form-group">
    <label>姓</label>
    <input type="text" name="last_name" class="form-control"
        value="{{ old('last_name', optional($address)->last_name) }}" required>
</div>

<div class="form-group">
    <label>名</label>
    <input type="text" name="first_name" class="form-control"
        value="{{ old('first_name', optional($address)->first_name) }}" required>
</div>

<div class="form-group">
    <label>姓(カナ)</label>
    <input type="text" name="last_name_kana" class="form-control"
        value="{{ old('last_name_kana', optional($address)->last_name_kana) }}" required>
</div>

<div class="form-group">
    <label>名(カナ)</label>
    <input type="text" name="first_name_kana" class="form-control"
        value="{{ old('first_name_kana', optional($address)->first_name_kana) }}" required>
</div>

<div class="form-group">
    <label>出身地</label>
    <input type="text" name="birth_place" class="form-control"
        value="{{ old('birth_place', optional($user->profile)->birth_place) }}" required>
</div>

<div class="form-group">
    <label>誕生日(公開する)
        <input type="checkbox" name="birthday_is_published"
            {{ optional($user->profile)->birthday_is_published === 1 ?'checked':'' }} value=1>
    </label>
    <input type="text" name="birthday" class="form-control date_picker"
        value="{{ old('birthday', optional($user->profile)->birthday) }}" required>
</div>

<div class="form-group">
    <label>性別(公開する)
        <input type="checkbox" name="gender_is_published"
            {{ optional($user->profile)->gender_is_published === 1 ?'checked':'' }} value=1>
    </label>
    <select name="gender" class="form-control" type='text'>
        <option value="">選択してください</option>
        @foreach(config('gender') as $gender)
        <option value="{{ $gender }}"
            {{ old('gender', optional($user->profile)->gender) === $gender ? 'selected' : ''}}>
            {{ $gender }}
        </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>紹介文</label>
    <textarea name="introduction" class="form-control" required>{{ old('introduction', optional($user->profile)->introduction) }}</textarea>
</div>

<div class="form-group">
    <label>電話番号</label>
    <input type="text" name="phone_number" class="form-control"
        value="{{ old('phone_number', optional($address)->phone_number) }}" required>
</div>

{{-- <div class="form-group">
    <label>画像</label>
    <input type="text" name="postal_code" class="form-control"
        value="{{ old('postal_code', optional($user->profile)->postal_code) }}" required>
</div> --}}
<div class="form-group">
    <label for="imageUploader" class="pr-4">画像(現在の画像から更新されます)</label><br>
    <input type="file" name="image_url" id="imageUploader" value="{{ old('image_url') }}"><br>
    @if(isset(optional($user->profile)->image_url))
    <div>
        <img style="max-height:200px; max-width:300px;" src="{{ asset(Storage::url(optional($user->profile)->image_url)) }}">
    </div>
    @endif
</div>

@if($user->profile)
<button type="submit" class="btn btn-primary">更新</button>
@else
<button type="submit" class="btn btn-primary">作成</button>
@endif

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
      var img_src = $('<img>').attr('src', reader.result).attr('style','height:200px;');
      $('#uploadedImage').html(img_src);
    }
    reader.readAsDataURL(file);
  });
});
</script>
