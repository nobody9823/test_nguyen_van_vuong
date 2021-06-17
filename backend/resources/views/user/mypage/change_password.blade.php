@extends('user.layouts.base')

@section('title', 'Dashboard')

@section('content')
{{--エラーメッセージ--}}
    <div class="content">
        <div class="section">

            <x-user.mypage-navigation-bar/>

            <div class="fixedcontainer mypage_contents c-password_box">
                <h2><i class="fas fa-lock"></i>パスワード変更</h2>
                <form class="" action="{{ route('user.check.change_password', ['user' => Auth::id()]) }}" method="post">
                    @csrf
                    <div class="form-group user_password">
                        <label class="control-label password" for="user_password_01">今までのパスワード
                        </label>
                        <input class="form-control password" placeholder="今までのパスワード" type="password" name="previous_password" id="user_password_01">
                    </div>

                    <div class="form-group user_password">
                        <label class="control-label password" for="user_password_02">新しいパスワード<br><span class="label_description">(英数字〇文字以上)</span>
                        </label>
                        <input class="form-control password" placeholder="新しいパスワード" type="password" name="new_password" id="user_password_02">
                    </div>

                    <div class="form-group user_password">
                        <label class="control-label password" for="user_password_03">確認用パスワード
                        </label>
                        <input class="form-control password" placeholder="確認用パスワード" type="password" name="new_password_confirmation" id="user_password_03">
                    </div>


                    <div class="submit-box">
                        <input type="submit" name="" value="送信" class="my-page_btn">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
