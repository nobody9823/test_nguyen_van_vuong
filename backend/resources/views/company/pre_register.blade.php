@extends('user.layouts.base')

@section('title', '企業アカウント新規登録')

@section('content')
<div class="content">
    <div class="section">
        <div class="fixedcontainer mypage_contents sign-in_box">
            <h2><i class="fas fa-sign-in-alt"></i>企業アカウント新規登録</h2>
            {{ Form::open(['route' => 'company.pre_register']) }}
            <div class="form-group company_login">
                {{ Form::label('email', 'メールアドレス', ['class' => 'control-label']) }}
                {{ Form::text('email', null, [
                    'class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''),
                    'placeholder' => 'メールアドレス',
                ]) }}
                @error('email')
                <div class="invalid-feedback" style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="submit-box">
                <input type="submit" name="" value="新規登録" class="my-page_btn">
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
