@extends('user.layouts.base')

@section('title', 'Dashboard')

@section('content')
    <div class="content">
        <div class="section">
            <div class="fixedcontainer mypage_contents re-password_box">
                <h2><i class="fas fa-lock"></i>パスワード再設定</h2>
                <p style="margin-bottom: 20px;">※登録されたメールアドレスをご入力してください。パスワード再設定用のURLをメールにて送信します。</p>
                <form class="" action="">
                    <div class="form-group user_password">
                        <label class="control-label password" for="user_password_01">メールアドレス <span class="label_req">必須</span>
                        </label>
                        <input class="form-control password" placeholder="あなたのメールアドレス" type="password" name="" id="user_password_01">
                    </div>

                    <div class="submit-box">
                        <input type="submit" name="" value="送信" class="my-page_btn">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
