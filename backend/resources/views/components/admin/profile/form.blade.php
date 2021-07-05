<div class="form-group">
    <label>招待コード</label>
    <p>{{ optional($user->profile)->inviter_code }}</p>
</div>

<div class="form-group">
    <label>姓</label>
    <input type="text" name="last_name" class="form-control"
        value="{{ old('last_name', optional($user->profile)->last_name) }}" required>
</div>

<div class="form-group">
    <label>名</label>
    <input type="text" name="first_name" class="form-control"
        value="{{ old('first_name', optional($user->profile)->first_name) }}" required>
</div>

<div class="form-group">
    <label>姓(カナ)</label>
    <input type="text" name="last_name_kana" class="form-control"
        value="{{ old('last_name_kana', optional($user->profile)->last_name_kana) }}" required>
</div>

<div class="form-group">
    <label>名(カナ)</label>
    <input type="text" name="first_name_kana" class="form-control"
        value="{{ old('first_name_kana', optional($user->profile)->first_name_kana) }}" required>
</div>

<div class="form-group">
    <label>誕生日(公開する)
        <input type="checkbox" name="birthday_is_published"
            {{ optional($user->profile)->birthday_is_published === 1 ?'checked':'' }} value=1>
    </label>
    <input type="text" name="birthday" class="form-control datetime_picker"
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
    <input type="text" name="introduction" class="form-control"
        value="{{ old('introduction', optional($user->profile)->introduction) }}" required>
</div>

<div class="form-group">
    <label>電話番号</label>
    <input type="text" name="phone_number" class="form-control"
        value="{{ old('phone_number', optional($user->profile)->phone_number) }}" required>
</div>

{{-- <div class="form-group">
    <label>画像</label>
    <input type="text" name="postal_code" class="form-control"
        value="{{ old('postal_code', optional($user->profile)->postal_code) }}" required>
</div> --}}

@if($user->profile)
<button type="submit" class="btn btn-primary">更新</button>
@else
<button type="submit" class="btn btn-primary">作成</button>
@endif

{{--
<div class="form-group">
    <label>都道府県</label>
    <div class="dropdown">
        <select class='form-control' name="prefecture" required>
            <option value="">選択してください</option>
            @foreach(PrefectureHelper::getPrefectures() as $key => $value)
            <option value="{{ $value }}"
{{ old('prefecture', optional($user->profile)->prefecture) === $value ? 'selected' : ''}}>
{{ $value }}
</option>
@endforeach
</select>
</div>
</div> --}}
