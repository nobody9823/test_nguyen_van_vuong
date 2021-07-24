@extends('user.layouts.base')

@section('title', 'パスワード再設定')

@section('content')
<section id="" class="section_base">
    <div class=" def_inner inner_item">

        <div class="tit_L_01 E-font"><h2>FORGOT PASSWORD</h2><div class="sub_tit_L">パスワード再設定</div></div>

        <form action="{{ route('user.send_reset_password_mail') }}" method="POST">
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
                ※ 会員登録時にご登録して頂いたメールアドレスを入力してください。パスワード再発行手続きのメールを送信します。<br>
                ※ FanReturn.comからのメールアドレスが受信拒否設定に含まれていないかご確認ください。<br>
                ※ 携帯キャリアのメールアドレスでは、応援購入後などにシステムからのメールが届かない場合がありますのでご注意ください。<br>
            </div>

            <div class="def_btn">
                <button type="submit" class="disable-btn">
                    <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">再設定メールを送信</p>
                </button>
            </div>
        </form>
    </div><!--/.inner_item-->
</section><!--/.section_base-->
@endsection
