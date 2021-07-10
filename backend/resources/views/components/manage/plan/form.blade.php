<div class="form-group">
    <label>リターン名</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', optional($plan)->title) }}">
</div>

<div class="form-group">
    <label>リターン内容</label>
    <textarea type="text" name="content" class="form-control">{{old('content', optional($plan)->content)}}</textarea>
</div>

<div class="form-group">
    <label>価格</label>
    @if($plan)
    <p>{{optional($plan)->price}}円</p>
    @else
    <div class="input-group">
        <input type="number" name="price" class="form-control" min="500" value="{{ old('price') }}" step="500">
        <div class="input-group-append">
            <span class="input-group-text">円</span>
        </div>
    </div>
    @endif
</div>

<div class="form-group">
    <label>支援者の方の住所登録</label>
    <span class="text-secondary">※ライブイベントなど支援者の方に住所を求める必要がない場合など</span>
    <div class="form-check ">
        <input class="form-check-input" type="radio" name="address_is_required" id="inlineRadio1" value="1" {{ optional($plan)->address_is_required ? 'checked' : '' }}>
        <label class="form-check-label" for="inlineRadio1">あり</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="address_is_required" id="inlineRadio1" value="0" {{ optional($plan)->address_is_required || !isset($plan) ? '' : 'checked' }}>
        <label class="form-check-label" for="inlineRadio2">なし</label>
    </div>
</div>
<!-- 現状オプションは使用しない為、コメントアウト -->
{{--
<div class="form-group">
    <label>オプション</label>
    <span class="text-secondary">※最大数10</span>
    @if(optional(optional($plan)->options)->count() >= 1)
    <div id="exists_option_form_box">
        @foreach($plan->options as $option)
        <div class="exists_option_form_area card-header mb-1">
            <label>オプションタイトル</label>
            <button type="button" id="option_{{ $option->id }}" class="deleteExistsOption btn btn-sm btn-danger mb-0">削除</button>
            <p class="form-control">{{ $option->name }}</p>
            @if(!is_null($option->quantity))
            <label>個数</label>
            <p class="form-control">{{ $option->quantity }}</p>
            @else
            <p>個数設定なし</p>
            @endif
        </div>
        @endforeach
    </div>
    @endif
    <div id="new_option_form_box">
        <div class="option_form_area card-header mb-1">
            <label>オプションタイトル</label>
            <button type="button" class="addOptionButton btn btn-sm btn-success mb-0">オプションを追加する</button>
            <button type="button" class="deleteOptionButton btn btn-sm btn-danger mb-0">削除</button>
            <input name="options[0][name]" class="form-control mb-1" type="text" placeholder="例）サイズ : M、 カラー : 白、 開催地 : 東京都〇〇区〇〇1−1−1など">
            <label>個数</label>
            <input name="options[0][quantity]" class="form-control" type="number">
        </div>
    </div>
</div>
--}}
<div class="form-group">
    <label>個数</label>
    <input type="number" name="limit_of_supporters" class="form-control" value="{{ old('limit_of_supporters', optional($plan)->limit_of_supporters) }}">
</div>

<div class="form-group">
    <label>リターン提供日</label>
    <input type="text" name="delivery_date" class="form-control" id="delivery_date" value="{{ old('delivery_date', optional($plan)->delivery_date) }}">
</div>

<div class="form-group">
    <label>画像</label>
    <input id="imageUploader" type="file" name="image_url" value="{{ old('image') }}">
</div>


<button type="submit" class="btn btn-primary">{{ isset($plan) ? '更新' : '作成'}}</button>

<!-- NOTE:現状オプションは使用しない為、以下コメントアウト。 -->
<!-- <script src="{{ asset('/js/Option.js') }}"></script> -->
{{-- <script>
    ExistsOptionDelete('{{ $guard }}');
</script> --}}