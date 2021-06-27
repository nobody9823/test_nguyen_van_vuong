<div class="form-group">
    <label>タイトル</label>
    <input type="text" name="title" class="form-control" value="{{ old('title' ,optional($report)->title) }}">
    
</div>

<div class="form-group">
    <label>内容</label>
    <textarea name="content" class="form-control">{{ old('content',optional($report)->content) }}</textarea>
</div>

<div class="form-group">
    <label>画像</label>
    <input id="imageUploader" type="file" name="image_url">
</div>

<button type="submit" class="btn btn-primary">{{ isset($report) ? "更新" : "作成" }}</button>
