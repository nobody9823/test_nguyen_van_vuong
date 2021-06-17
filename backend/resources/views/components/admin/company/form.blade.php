@php
use App\Enums\ContractStatus;
@endphp

<div class="form-group">
    <label for="imageUploader" class="pr-4">イメージ画像</label><br>
    <input type="file" name="image_url" id="imageUploader" value="{{ old('image_url') }}"><br>
    @if(isset($company))
        <div>
            <img style="max-height:200px; max-width:300px;" src="{{ Storage::url($company->image_url) }}">
        </div>
    @endif
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">社名</label>
    <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
        value="{{ old('name', optional($company)->name) }}">
</div>

<div class="form-group">
    <label for="exampleFormControlInput1">メールアドレス</label>
    <input type="email" name="email" class="form-control" id="exampleFormControlInput1"
        value="{{ old('email' ,optional($company)->email) }}">
</div>

<div class="form-group">
    <label>契約状況</label>
    <select name="contract_status" class="custom-select">
        @foreach(ContractStatus::getValues() as $contract_status)
            <option value="{{ $contract_status }}"
                {{ ((old('contract_status') !== null) && (old('contract_status') == $contract_status)) ? 'selected' : (optional($company)->contract_status == $contract_status ? 'selected' : '') }}>
                {{ $contract_status }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="datepicker_1">契約日</label>
    <input type="text" class="form-control" name="contract_date" id="datepicker_1"
        value="{{ old('contract_date', optional($company)->contract_date) }}">
</div>

<div class="form-group">
    <label for="datepicker_2">契約終了日</label>
    <input type="text" class="form-control" name="cancellation_date" id="datepicker_2"
        value="{{ old('cancellation_date', optional($company)->cancellation_date) }}">
</div>

<div class="form-group">
    <label>企業メモ</label>
    <textarea name="remarks" class="form-control" rows="10">{{ old('remarks', optional($company)->remarks) }}</textarea>
</div>

@if($company ?? false)
    <button type="submit" class="btn btn-primary">更新</button>
@else
<div class="form-group">
    <label for="exampleFormControlInput1">パスワード</label>
    <input type="password" name="password" class="form-control" id="exampleFormControlInput1"
        value="">
</div>

<div class="form-group">
    <label>パスワード(確認用)</label>
    <input type="password" name="password_confirmation" class="form-control" value="">
</div>

    <button type="submit" class="btn btn-primary">作成</button>
@endif

<!-- 画像をアップロードした際、ブラウザにリアルタイムで画像を表示させる -->
<script src="{{ asset('/js/image-upload-browser.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-datetimepicker@2.5.20/build/jquery.datetimepicker.full.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-datetimepicker@2.5.20/jquery.datetimepicker.css">
<script>
    $(function () {
        $('#datepicker_1').datetimepicker({
            format: 'Y-m-d'
        });
        $('#datepicker_2').datetimepicker({
            format: 'Y-m-d'
        });
    });
</script>
