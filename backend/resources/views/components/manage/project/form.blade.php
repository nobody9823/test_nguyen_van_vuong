<div class="form-group">
    <label>タイトル</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', optional($project)->title) }}">
</div>

<div class="form-group">
    <label>自己紹介・挨拶</label>
    <textarea type="text" name="greeting_and_introduce" class="form-control">{{old('greeting_and_introduce', optional($project)->greeting_and_introduce)}}</textarea>
</div>

<div class="form-group">
    <label>プロジェクトを立ち上げたきっかけ</label>
    <textarea type="text" name="opportunity" class="form-control">{{old('opportunity', optional($project)->opportunity)}}</textarea>
</div>

<div class="form-group">
    <label>プロジェクト内容</label>
    <textarea type="text" name="explanation" class="form-control">{{old('explanation', optional($project)->explanation)}}</textarea>
</div>

<div class="form-group">
    <label>最後に</label>
    <textarea type="text" name="finally" class="form-control">{{old('finally', optional($project)->finally)}}</textarea>
</div>

<div class="form-row">
    <div class="col-md-11 mb-3">
        <label>目標金額</label>
        <input type="number" name="target_amount" class="form-control mb-2 mr-sm-2" min="0"
            value="{{ old('target_amount', optional($project)->target_amount) }}" step="10000">
    </div>
    <h5 class="pt-5">円</h5>
</div>

@if($role !== "talent")
<div class="form-group">
    <label>掲載タレント</label>
    <div class="dropdown">
        {{ Form::select('talent_id', $talents, old('talent_id', optional($project)->talent_id), ['class' => 'form-control']) }}
    </div>
</div>
@endif

<div>
    <p>注意事項</p>
    <ul>
        <li>掲載開始日時は、現在〜1週間後以降に設定して下さい。(これは審査に1週間程度お時間を頂く為です。)</li>
        <li>掲載期間は60日までです。</li>
    </ul>
</div>
<div class="form-group">
    <label>掲載開始日時</label>
    <input type="text" name="start_date" class="form-control" id="start_date"
        value="{{ old('start_date', optional($project)->start_date) }}">
</div>

<div class="form-group">
    <label>掲載終了日時</label>
    <input type="text" name="end_date" class="form-control" id="end_date"
        value="{{ old('end_date', optional($project)->end_date) }}">
</div>

<div class="form-group">
    <label>カテゴリ</label>
    <div class="dropdown">
        {{ Form::select('category_id', $categories, old('category_id', optional($project)->category_id), ['class' => 'form-control']) }}
    </div>
</div>

<div class="form-group">
    <label>トップ画像</label>
    <input id='imageUploader' type="file" name="images[]" multiple="multiple" value="{{ old('image') }}">
</div>

<div class="form-group">
    <label>動画URL</label>
    <div>
        <ul>
            <li>動画URLはYouTubeのURLを使用してください。</li>
        </ul>
    </div>
    <input type="text" name="video_url" class="form-control" value="{{ old('video_url', optional(optional($project)->projectVideo)->video_url) }}" placeholder="https://www.youtube.com/watch?v=xxxxxxxxxxxxxx">
    <section class="d-flex justify-content-left">
        <div class="col-sm-4">
            {{ DisplayVideoHelper::getVideoAtManage(optional(optional($project)->projectVideo)->video_url) }}
        </div>
    </section>
</div>

@if($project ?? false)
<button type="submit" class="btn btn-primary">更新</button>
@else
<button type="submit" class="btn btn-primary">作成</button>
@endif
