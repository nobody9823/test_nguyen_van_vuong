@extends('user.layouts.base')

@section('title', 'ログイン')

@section('content')
    <div class="content">
        <div class="section">
            <div class="fixedcontainer mypage_contents sign-in_box">
                <h2><i class="fas fa-sign-in-alt"></i>ログイン</h2>
                {{ Form::open(['route' => 'login']) }}
                    <div class="form-group user_login">
                        {{ Form::label('email', 'メールアドレス', ['class' =>  'control-label']) }}
                        {{ Form::text('email', null, [
                        'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                        'placeholder' => 'メールアドレス'
                    ]) }}
                        @error('email')
                        <div class="invalid-feedback" style="color: red;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group user_password">
                        {{ Form::label('password', 'パスワード', ['class' => 'control-label']) }}
                        {{ Form::password('password', [
                        'class' => 'form-control password ' . ($errors->has('password') ? ' is-invalid' : ''),
                        'type' => 'password',
                        'placeholder' => 'パスワード（英数字8文字以上）',
                    ]) }}
                        @error('password')
                        <div class="invalid-feedback" style="color: red;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group user_remember_me i_form_item">
                        <label>
                            <input type="checkbox" name=""><i class="far fa-square fa-2x"></i><i class="far fa-check-square fa-2x"></i>ログイン状態を保存する
                        </label>
                        <label>
                            <a href="{{ route('user.forgot_password') }}" class="pass_forget">パスワードを忘れた方はこちら</a>
                        </label>
                    </div>
                    <div class="submit-box">
                        <input type="submit" name="" value="ログイン" class="my-page_btn">
                    </div>
                {{ Form::close() }}
            </div>

            <x-user.oauth-login/>

        </div>
    </div>
@endsection
