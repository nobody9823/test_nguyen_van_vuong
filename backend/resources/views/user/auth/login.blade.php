@extends('user.layouts.base')

@section('title', 'ログイン')

@section('content')
<section id="" class="section_base">
    <div class=" def_inner inner_item">

        <div class="tit_L_01 E-font"><h2>LOGIN</h2><div class="sub_tit_L">ログイン</div></div>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form_item_row">
                <div class="form_item_tit">メールアドレス</div>
                <input name="email" type="email" value="{{ old('email') }}" class="def_input_100p" placeholder="メールアドレス">
            </div><!--/form_item_row-->

            <div class="form_item_row">
                <div class="form_item_tit">パスワード<a href="{{ route('user.forgot_password') }}" class="pass_forget_link">パスワードを忘れた方はこちら</a></div>
                <input name="password" type="password" value="" class="def_input_100p" placeholder="パスワード">
            </div><!--/form_item_row-->

            {{-- NOTICE この機能まだ未実装 --}}
            {{-- <div class="login_hozon"><input type="checkbox" id="aaa" class="ac_list_checks"><label for="aaa" class="checkbox-fan">ログイン状態を保存する</label></div> --}}
            <div class="def_btn">
                <button type="submit" class="disable-btn">
                    <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">ログイン</p>
                </button>
            </div>
        </form>

        <div class="login_other"><span>または</span><div></div></div>

        <x-user.oauth-login/>

    </div><!--/.inner_item-->
</section><!--/.section_base-->

<section id="" class="section_base">
    <div class=" def_inner inner_item">

        <div class="tit_L_01 E-font"><h2>NEW MEMBER</h2><div class="sub_tit_L">新規会員登録</div></div>

        <div class="normal_txt m_b_3020">会員登録がお済みでない方はこちら</div>

        <div class="def_btn">新規会員登録<a href="{{ route('user.pre_create') }}" class="cover_link"></a></div>

    </div><!--/.inner_item-->
</section><!--/.section_base-->
@endsection
