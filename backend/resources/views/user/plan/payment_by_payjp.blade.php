@extends('user.layouts.base')

@section('content')

@section('content')
{{--エラーメッセージ--}}
@if ($errors->any())
<div class="error_message text-center">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="content sub_content detail_content">
    <div class="fixedcontainer">
            <h2 class="sec-ttl">{{ $plan->title }}</h2>
            <div class="detail_info">
                <div class="detail_info_content" style="width: 80%;	margin:0 auto;">
                    <div style="text-align: center;">
                        <h3 style="color: #ff1493">※クレジットカードで支援しますか？</h3>
                        <p>価格</p>
                        <div><span>{{ $plan->price }}</span>円</div>
                    </div>
                    <form action="{{ route('user.plan.join', ['project' => $project, 'plan' => $plan, 'user_address' => $user_address]) }}" method="GET" class="text-center mt-xxl">
                    @csrf
                        <script src="https://checkout.pay.jp/" class="payjp-button" data-key="{{ config('app.pay_jp_key_for_test') }}" data-partial="false"></script>
                    </form>
                </div>
            </div>
    </div>
</div>
@section('script')
<script>
$(function() {
    $('.mt-xxl').click( function() {
        console.log($(this).onTokenCreated);
        $('#payjp_cardSubmit').click( function() {
        })
    })
});
// JayJpの決済ボタンのスタイル上書き
$(document).ready( function(){
    $("#payjp_checkout_box").attr('style', "height: 45px");
    var el = $("#payjp_checkout_box input[type='button']");
    el.attr('style', 'background-color: #ff1493; background-image: initial; width: 35%; height: 100%; font-size: 18px');
});
</script>
@endsection
@endsection
