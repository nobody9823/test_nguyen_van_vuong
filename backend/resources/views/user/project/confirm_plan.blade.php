@extends('user.layouts.base')

@section('content')
<div class="Assist-input_base">

    <div class="as_header_01">
        <div class="as_header_inner">
            <div class="as_h_01">
                <div class="as_h_01_01"><div class="as_h_01_dotted"><div></div></div><div class="as_h_01_txt">入力</div></div>
                <div class="as_h_01_02"><div class="as_h_01_dotted as_h_01_current"><div></div></div><div class="as_h_01_txt">確認</div></div>
                <div class="as_h_01_03"><div class="as_h_01_dotted"><div></div></div><div class="as_h_01_txt">完了</div></div>
            </div><!--/-->

            <div class="as_h_line"></div><!--/-->
        </div><!--/as_header_inner-->
    </div><!--/as_header-->

    <div class="as_header_02 inner_item">内容をご確認の上、完了ボタンを押してください</div>

    <div class="av_box_base def_inner inner_item">

        <div class="av_box">
            <div class="av_tit">決済金額</div>
            <div class="av_txt">
                購入者側の手数料要確認(支援金額：2,500円<br>システム利用料：220円（税込）)
                <div>合計：{{ $payment->price }}円</div>
            </div>
        </div><!--/av_box-->

        <div class="av_box">
            <div class="av_tit">リターン内容</div>
            @foreach($payment->includedPlans as $plan)
            <div class="av_txt">
                <div>{{ $plan->title }}<br>支援金額：{{ $plan->price }}円</div>
                支援者：500人(未実装) <br>お届け予定：{{ $plan->delivery_date }}
            </div>
            <br>
            @endforeach
        </div><!--/av_box-->

        <div class="av_box">
            <div class="av_tit">備考欄<span class="av_tit_span_01">※非公開</span></div>
            <div class="av_txt">
                {{ $payment->remarks }}
            </div>
        </div><!--/av_box-->

        <div class="av_box">
            <div class="av_tit">コメント<span class="av_tit_span_01">※公開</span></div>
            <div class="av_txt">
                {{ $payment->comment->content }}
            </div>
        </div><!--/av_box-->

        <div class="av_box">
            <div class="av_tit">お支払い方法</div>
            <div class="av_txt">
                @if($payment->pay_jp_id !== null)
                    {{ 'credit' }}<br>
                    クレジットカード（VISA）<br>
                    クレジットカード番号：1234567891011123<br>
                    セキュリティコード：123<br>
                    有効期限：6月2021年<br>
                @else
                    {{ 'pay pay' }}
                @endif
            </div>
        </div><!--/av_box-->

        <div class="av_box">
            <div class="av_tit">お客様情報</div>
            <div class="av_txt">
                お名前(フリガナ)：{{ Auth::user()->profile->first_name_kana }} {{ Auth::user()->profile->last_name_kana }}<br>
                お名前：{{ Auth::user()->profile->first_name }} {{ Auth::user()->profile->last_name }}<br>
                性別：{{ Auth::user()->profile->gender }}<br>
                電話番号：{{ Auth::user()->profile->phone_number }}<br>
                生年月日：{{ Auth::user()->profile->birthday }}<br>
            </div>
        </div><!--/av_box-->

        <div class="av_box">
            <div class="av_tit">お届け先情報</div>
            <div class="av_txt">
                〒{{ Auth::user()->address->postal_code }}<br>
                {{ Auth::user()->address->prefecture }}
                {{ Auth::user()->address->city }}
                {{ Auth::user()->address->block }}
                {{ Auth::user()->address->building }}<br>
            </div>
        </div><!--/av_box-->

        <div class="av_box">
            <div class="av_tit">メールアドレス</div>
            <div class="av_txt">
                {{ Auth::user()->email }}<br>
            </div>
        </div><!--/av_box-->

        <div class="av_caution">※入力に誤りがないか今一度確認の上、完了にお進みください</div>

        <div class="def_btn">
            @if ($payment->pay_jp_id !== null)
                <a href="{{ route('user.plan.paymentForPayJp', ['project' => $project, 'payment' => $payment]) }}" style="color: white">決済する</a>
            @else
                <a href="{{ $qr_code['data']['url'] }}" style="color: white">決済する</a>
            @endif
        </div>

        {{-- <div class="def_btn_02">内容を変更する</div> --}}
    </div>
</div>
@endsection
