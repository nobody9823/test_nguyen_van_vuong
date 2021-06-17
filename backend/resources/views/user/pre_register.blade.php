@extends('user.layouts.base')

@section('title', 'ログイン')

@section('content')
    <div class="content">
        <div class="section">
            <div class="fixedcontainer mypage_contents sign-in_box">
                <h2><i class="fas fa-sign-in-alt"></i>新規登録</h2>
                {{ Form::open(['route' => 'user.pre_register']) }}
                <div class="form-group user_login">
                    {{ Form::label('email', 'メールアドレス', ['class' => 'control-label']) }}
                    {{ Form::text('email', null, [
                    'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
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

            <x-user.oauth-login/>

        </div>
    </div>
@endsection
