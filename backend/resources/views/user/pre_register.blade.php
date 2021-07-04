@extends('user.layouts.base')

@section('title', 'ログイン')

@section('content')
    <div class="content">
        <div class="section">
            <div class="fixedcontainer mypage_contents sign-in_box">
                <div class="tit_L_01 E-font"><h2><i class="fas fa-sign-in-alt"></i>新規登録</h2></div>
                {{ Form::open(['route' => 'user.pre_register']) }}
                <div class="tit_L_01 E-font">
                    {{ Form::label('email', 'メールアドレス', ['class' => 'control-label']) }}
                    {{ Form::text('email', null, [
                    'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                    'placeholder' => 'メールアドレス',
                    'style' => 
                        'width: 30%;
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
                <div class="submit-box" style=
                    "display: flex;
                     flex-direction: column;
                     align-items: center;"
                    >
                    <input type="submit" name="" value="新規登録" class="my-page_btn" style="
                            width: 300px;
                            margin: 30px 0px;
                            height: 40px;
                            background-color: #00AEBD;
                            color: white;
                            font-size: 120%;
                            border-radius: 5px;
                            font-weight: bold;
                            ">
                </div>
                {{ Form::close() }}
            </div>

            <x-user.oauth-login/>

        </div>
    </div>
@endsection
