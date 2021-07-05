<div class="form-group">
    <label>郵便番号</label>
    <input type="text" name="postal_code" class="form-control" id="exampleFormControlInput1"
        value="{{ old('postal_code', optional($user->address)->postal_code) }}" required>
</div>

<div class="form-group">
    <label>都道府県</label>
    <div class="dropdown">
        <select class='form-control' name="prefecture" required>
            <option value="">選択してください</option>
            @foreach(PrefectureHelper::getPrefectures() as $key => $value)
            <option value="{{ $value }}"
                {{ old('prefecture', optional($user->address)->prefecture) === $value ? 'selected' : ''}}>
                {{ $value }}
            </option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <label>住所1(市町村など)</label>
    <input type="text" name="city" class="form-control" id="exampleFormControlInput3"
        value="{{ old('city', optional($user->address)->city) }}" required>
</div>

<div class="form-group">
    <label>住所2(番地など)</label>
    <input type="text" name="block" class="form-control" id="exampleFormControlInput4"
        value="{{ old('block', optional($user->address)->block) }}" required>
</div>

<div class="form-group">
    <label>住所3(建物番号など)</label>
    <input type="text" name="building" class="form-control" id="exampleFormControlInput5"
        value="{{ old('building', optional($user->address)->building) }}" required>
</div>

@if($user->address)
<button type="submit" class="btn btn-primary">更新</button>
@else
<button type="submit" class="btn btn-primary">作成</button>
@endif
