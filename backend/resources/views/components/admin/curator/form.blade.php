<div class="form-group">
    <label for="exampleFormControlInput1">キュレーター名</label>
    <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
        value="{{ old('name', optional($curator)->name) }}">
</div>

<div class="form-group">
    <label for="exampleFormControlInput1">メールアドレス</label>
    <input type="email" name="email" class="form-control" id="exampleFormControlInput1"
        value="{{ old('email', optional($curator)->email) }}">
</div>

@if($curator ?? false)
    <button type="submit" class="btn btn-primary">更新</button>
@else
<div class="form-group">
    <label for="exampleFormControlInput1">パスワード</label>
    <input type="password" name="password" class="form-control" id="exampleFormControlInput1">
</div>

<div class="form-group">
    <label>パスワード(確認用)</label>
    <input type="password" name="password_confirmation" class="form-control" value="">
</div>
    <button type="submit" class="btn btn-primary">作成</button>
@endif
