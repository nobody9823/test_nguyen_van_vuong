{{--
ソートタイプを表示するコンポーネント
必要引数
props_array = 対象モデルを指定(配列型)
--}}


<select name="sort_type" id="sort" class="form-control mr-2">
    <option value="" {{ !Request::get('sort_type') ? 'selected' : '' }}>
        並び替え</option>
    @foreach ($propsArray as $key => $value)
    <option {{ Request::get('sort_type') === $key."_asc" ? 'selected' : '' }} value={{ $key."_asc" }}>
        {{ $value }}昇順
    </option>
    <option {{ Request::get('sort_type') === $key."_desc" ? 'selected' : '' }} value={{ $key."_desc" }}>
        {{ $value }}降順
    </option>
    @endforeach
</select>
