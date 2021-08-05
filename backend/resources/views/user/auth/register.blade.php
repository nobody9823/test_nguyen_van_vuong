@extends('user.layouts.base')

@section('title', '本登録画面')

@section('content')
<section id="" class="section_base">
    <div class=" def_inner inner_item">

        <div class="tit_L_01 E-font"><h2>REGISTER</h2><div class="sub_tit_L">本登録</div></div>

        <form action="{{ route('user.register',['token' => $token]) }}" method="POST">
            @csrf
            <div class="form_item_row">
                <div class="form_item_tit">ユーザー名<span class="form_item_tit_desc">※英数字、漢字、平仮名、カタカナも可</span></div>
                <input name="name" type="text" value="" class="def_input_100p" placeholder="ユーザー名">
            </div><!--/form_item_row-->

            <div class="form_item_row">
                <div class="form_item_tit">パスワード<span class="form_item_tit_desc">※半角英数字8文字以上</span></div>
                <input name="password" type="password" value="" class="def_input_100p" placeholder="パスワード">
            </div><!--/form_item_row-->

            <div class="form_item_row">
                <div class="form_item_tit">パスワード確認用</div>
                <input name="password_confirmation" type="password" value="" class="def_input_100p" placeholder="パスワード確認用">
            </div><!--/form_item_row-->

            <div class="nm_doui">
                <input type="checkbox" id="aaa" class="ac_list_checks" required>
                <label for="aaa" class="checkbox-fan">
                    <a href="{{ route('user.terms_of_service') }}">利用規約</a>
                    と
                    <a href="{{ route('user.privacy_policy') }}">プライバシーポリシー</a>
                    に同意する
                </label>
            </div>

            <div class="nm_s_txt">
                ※ mail@fanreturn.comからのメールアドレスが受信拒否設定に含まれていないかご確認ください。<br>
                {{-- ※ FanReturnからのメールマガジン/各種お知らせをお送りさせていただきます。<br>
                （不要な場合は登録後に解除できます。）<br> --}}
                ※ 携帯キャリアのメールアドレスでは、応援購入後などにシステムからのメールが届かない場合がありますのでご注意ください。<br>
            </div>

            <div class="def_btn">
                <button type="submit" class="disable-btn">
                    <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">新規会員登録</p>
                </button>
            </div>
        </form>
    </div><!--/.inner_item-->
</section><!--/.section_base-->
@endsection
