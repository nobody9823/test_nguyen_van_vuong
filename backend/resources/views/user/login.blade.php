@extends('user.layouts.base')

@section('title', 'ログイン')

@section('content')
    <div class="content">
        <div class="section">
            <div class="fixedcontainer mypage_contents sign-in_box">
                <div class="tit_L_01 E-font"><h2><i class="fas fa-sign-in-alt"></i>ログイン</h2></div>
                {{ Form::open(['route' => 'login']) }}
                    <div class="tit_L_01 E-font">
                        {{ Form::label('email', 'メールアドレス', ['class' =>  'control-label','style' => 'margin-right: 10px;']) }}
                        {{ Form::text('email', null, [
                        'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                        'placeholder' => 'メールアドレス',                    
                        'style' => 'width: 30%;
                        height: 40px;
                        padding: 10px;
                        border: solid 1px #DBDBDB;
                        border-radius: 4px;'
                    ]) }}
                        @error('email')
                        <div class="invalid-feedback" style="color: red;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="tit_L_01 E-font">
                        {{ Form::label('password', 'パスワード', ['class' => 'control-label', 'style' => 'margin-right: 50px;']) }}
                        {{ Form::password('password', [
                        'class' => 'form-control password ' . ($errors->has('password') ? ' is-invalid' : ''),
                        'type' => 'password',
                        'placeholder' => 'パスワード（英数字8文字以上）',
                        'style' => 'width: 30%;
                            height: 40px;
                            padding: 10px;
                            border: solid 1px #DBDBDB;
                            border-radius: 4px;'
                    ]) }}
                        @error('password')
                        <div class="invalid-feedback" style="color: red;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div style=
                    "display: flex;
                     flex-direction: column;
                     align-items: center;"
                    >
                        <label>                        
                            <input type="checkbox" name=""><i class="far fa-check-square fa-2x"></i>ログイン状態を保存する
                        </label>
                        <label>
                            <a href="{{ route('user.forgot_password') }}" class="pee_pass_link">パスワードを忘れた方はこちら</a>
                        </label>
                        <div class="submit">
                            <input type="submit" name="" value="ログイン" style="
                            width: 300px;
                            margin: 50px;
                            height: 40px;
                            background-color: #00AEBD;
                            color: white;
                            font-size: 120%;
                            border-radius: 5px;
                            font-weight: bold;
                            ">
                        </div>
                    </div>
                    </div>
                {{ Form::close() }}

            <x-user.oauth-login/>

        </div>
    </div>
@endsection
