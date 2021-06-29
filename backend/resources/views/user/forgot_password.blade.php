@extends('user.layouts.base')

@section('title', 'パスワード再設定')

@section('content')
    <div class="content">
        <div class="section">
            <div class="fixedcontainer mypage_contents re-password_box">
                <h3>パスワード再設定</h3>
                <form action="{{ route('user.send_reset_password_mail') }}" method="POST">
                    @csrf
                    <label>メールアドレスを入力</label>
                    <input name="email" type="email" placeholder="メールアドレス"/>
                    <button type="submit">再設定メールを送信</button>
                    <p>会員登録時にご登録して頂いたメールアドレスを入力してください。パスワード再発行手続きのメールを送信します。</p>
                </form>
            </div>
        </div>
    </div>
@endsection
