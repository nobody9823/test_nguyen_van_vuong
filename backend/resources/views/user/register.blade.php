@extends('user.layouts.base')

@section('title', '本登録画面')

@section('content')
<div class="content" style=" background: #f5f5f5; padding: 80px 0;">
    <div class="section">
        <div class="fixedcontainer mypage_contents sign-in_box">
            <h2><i class="fas fa-sign-in-alt"></i>本登録</h2>
            <form action={{route('user.register',['token' => $token])}} method='post'>
                @csrf
                <div class="form-group user_login">
                    {{ Form::label('name', 'お名前', ['class' =>  'control-label']) }}
                    <input style="margin-bottom: 10px;" name='name' type="text"
                        class={{"form-control".($errors->has('name') ? ' is-invalid' : '')}} placeholder='お名前'
                        value="{{ old('name') }}" required>
                    {{ Form::label('password', 'パスワード', ['class' =>  'control-label']) }}
                    <input style="margin-bottom: 10px;" name='password' type="password"
                        class={{"form-control".($errors->has('name') ? ' is-invalid' : '')}} placeholder='パスワード'
                        value="{{ old('password') }}" required>
                    {{ Form::label('password_confirmation', '確認パスワード', ['class' =>  'control-label']) }}
                    <input style="margin-bottom: 10px;" name='password_confirmation' type="password"
                        class={{"form-control".($errors->has('name') ? ' is-invalid' : '')}} placeholder='確認パスワード'
                        value="{{ old('password_confirmation') }}" required>
                </div>
                <div class="wlr_64_R">
                    <div class="as_01">
                        <input type="checkbox" class="checkbox-fan" id="tos" required>
                        <label for="tos" class="checkbox-fan_02"></label>
                    </div>
                    <a href="{{ route('user.terms_of_service') }}">利用規約</a>
                    <p>と</p>
                    <a href="{{ route('user.privacy_policy') }}">プライバシーポリシー</a>
                    <p>に同意する</p>
                </div>
                <div class="submit-box">
                    <input type="submit" name="" value="本登録を完了する" class="my-page_btn">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
