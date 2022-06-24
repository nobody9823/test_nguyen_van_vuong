@extends('user.layouts.base')

@section('title', '新規会員登録')

@section('content')
<section id="" class="section_base">
    <div class=" def_inner inner_item">

        <div class="tit_L_01 E-font"><h2>NEW MEMBER</h2><div class="sub_tit_L">新規会員登録</div></div>

        <form action="{{ route('user.pre_register') }}" method="POST">
            @csrf
            <div class="form_item_row">
                <div class="form_item_tit">メールアドレス</div>
                <input name="email" type="email" value="" class="def_input_100p" placeholder="メールアドレス">
            </div><!--/form_item_row-->

            <div class="form_item_row">
                <div class="form_item_tit">メールアドレス確認用</div>
                <input name="email_confirmation" type="email" value="" class="def_input_100p" placeholder="メールアドレス確認用">
            </div><!--/form_item_row-->

            <div class="nm_s_txt">
                ※上記入力・送信いただくと、ユーザーにFanreturnからメールが届きます。<br>
                ※ FanReturn.comからのメールアドレスが受信拒否設定に含まれていないかご確認ください。<br>
                ※ FanReturnからのメールマガジン/各種お知らせをお送りさせていただきます。<br>
                （不要な場合は登録後に解除できます。）<br>
                ※ 携帯キャリアのメールアドレスでは、応援購入後などにシステムからのメールが届かない場合がありますのでご注意ください。<br>
            </div>

            <div class="def_btn">
                <button type="submit" class="disable-btn">
                    <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">確認用メールの送信</p>
                </button>
            </div>
        </form>

        <div class="nm_other"><span>各種サービスで新規会員登録する</span><div></div></div>

        <x-user.oauth-login/>

    </div><!--/.inner_item-->
</section><!--/.section_base-->

<section id="" class="section_base">
    <div class=" def_inner inner_item">

        <div class="tit_L_01 E-font"><h2>LOGIN</h2><div class="sub_tit_L">ログイン</div></div>

        <div class="normal_txt m_b_3020">すでに会員の方はこちら</div>

        <div class="def_btn">ログイン<a href="{{ route('login') }}" class="cover_link"></a></div>

    </div><!--/.inner_item-->
</section><!--/.section_base-->
@endsection
