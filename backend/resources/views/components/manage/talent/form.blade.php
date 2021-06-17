@php
    use App\Enums\EmploymentStatus;
    use App\Enums\EvaluationStatus;
    use App\Enums\RecruitmentStatus;
    use App\Enums\ResignationStatus;
@endphp

@if($companies ?? false)
<div class="form-group">
    <label for="exampleFormControlInput1">所属企業</label>
    <div class="dropdown">
        {{ Form::select('company_id', $companies, old('company_id', optional($talent)->company_id), ['class' => 'form-control']) }}
    </div>
</div>
@endif

<div class="form-group">
    <label for="imageUploader" class="pr-4">イメージ画像</label><br>
    <input type="file" name="image_url" id="imageUploader" value="{{ old('image_url') }}"><br>
    @if(isset($talent))
        <div>
            <img style="max-height:200px; max-width:300px;" src="{{ Storage::url($talent->image_url) }}">
        </div>
    @endif
</div>
<div class="form-group">
    <label for="exampleFormControlInput1">タレント名</label>
    <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
        value="{{ old('name' ,optional($talent)->name) }}">
</div>

<div class="form-group">
    <label for="exampleFormControlInput1">メールアドレス</label>
    <input type="email" name="email" class="form-control" id="exampleFormControlInput1"
        value="{{ old('email' ,optional($talent)->email) }}">
</div>

<div class="form-group">
    <label>採用状況</label>
    <select name="recruitment_status" class="custom-select">
        @foreach(RecruitmentStatus::getValues() as $recruitment_status)
            <option value="{{ $recruitment_status }}"
                {{ ((old('recruitment_status') !== null) && (old('recruitment_status') == $recruitment_status)) ? 'selected' : (optional($talent)->recruitment_status == $recruitment_status ? 'selected' : '') }}>
                {{ $recruitment_status }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>雇用形態</label>
    <select name="employment_status" class="custom-select">
        @foreach(EmploymentStatus::getValues() as $employment_status)
            <option value="{{ $employment_status }}"
                {{ ((old('employment_status') !== null) && (old('employment_status') == $employment_status)) ? 'selected' : (optional($talent)->employment_status == $employment_status ? 'selected' : '') }}>
                {{ $employment_status }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>待遇</label>
    <select name="evaluation_status" class="custom-select">
        @foreach(EvaluationStatus::getValues() as $evaluation_status)
            <option value="{{ $evaluation_status }}"
                {{ ((old('evaluation_status') !== null) && (old('evaluation_status') == $evaluation_status)) ? 'selected' : (optional($talent)->evaluation_status == $evaluation_status ? 'selected' : '') }}>
                {{ $evaluation_status }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>時給</label>
    <div class="input-group">
        <input type="number" name="hourly_wage" class="form-control" min="0" value="{{ old('hourly_wage', optional($talent)->hourly_wage) }}" aria-describedby="hourlyWage">
        <div class="input-group-append">
            <span class="input-group-text" id="hourlyWage">円</span>
        </div>
    </div>
</div>

<div class="form-group">
    <label>退職状況</label>
    <select name="resignation_status" class="custom-select">
        @foreach(ResignationStatus::getValues() as $resignation_status)
            <option value="{{ $resignation_status }}"
                {{ ((old('resignation_status') !== null) && (old('resignation_status') == $resignation_status)) ? 'selected' : (optional($talent)->resignation_status == $resignation_status ? 'selected' : '') }}>
                {{ $resignation_status }}
            </option>
        @endforeach
    </select>
</div>

@if($talent ?? false)
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
