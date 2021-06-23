<form action={{route('user.search')}}>
    @csrf
    <div>
        <p>全体検索</p>
        <div>
            <input type="text" name="free_word" placeholder="キーワードから探す" id="keyword_search" value="{{ $free_word }}">
        </div>
    </div>
    <!--スマホ用絞り込み検索アコーディオン-->
    <input id="cfh_acd-check1" class="cfh_acd-check" type="checkbox">
    <label class="cfh_acd-label" for="cfh_acd-check1">条件を絞り込む</label>
    <div class="cfh_acd-content">
        <div>
            <p>カテゴリ</p>
            <div>
                {{ Form::select("tag_id", $tags(), old('tag_id',$tag_id),['rel' => 'dropdown','placeholder' => '指定しない','id' => 'tag']) }}
            </div>
        </div>
        <div>
            <p>並び替え</p>
            <div>
                <select rel="dropdown" name="sort_type" id="sort">
                    <option value="">指定しない</option>
                    <option value="0" {{ $sort_type == '0'  ? 'selected' : '' }}>
                        人気順</option>
                    <option value="1" {{ $sort_type == '1'  ? 'selected' : '' }}>
                        新着順</option>
                    <option value="2" {{ $sort_type == '2'  ? 'selected' : '' }}>
                        終了日が近い順</option>
                    <option value="3" {{ $sort_type == '3'  ? 'selected' : '' }}>
                        支援総額順</option>
                    <option value="4" {{ $sort_type == '4'  ? 'selected' : '' }}>
                        支援者数順</option>
                </select>
            </div>
        </div>
        <div>
            <p>募集状況</p>
            {{ Form::select("holding_check", ['0'=>'公開前', '1'=>'支援募集中', '2'=>'募集終了', ], old('holding_check',$holding_check),['rel' => 'dropdown','placeholder' => '指定しない','id' => 'holding_check']) }}
        </div>
        <div>
            <p>応援したもののみを表示</p>
            <label><input type="checkbox" name="cheered_check" {{$cheered_check ? 'checked' : ''}}>ON</label>
        </div>


        <div class="select-wrap btn-wrap">
            <button type="submit">絞り込み検索</button>
            <input id="clear_btn" value="クリア" type="button">
        </div>
        <p class="small">※開催ライブなど交通費などはお客様各自での手配、支払いとなります。</p>
    </div>
</form>
