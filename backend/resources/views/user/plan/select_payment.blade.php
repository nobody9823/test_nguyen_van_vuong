@extends('user.layouts.base')

@section('content')
<div class="content sub_content detail_content">
    <div class="fixedcontainer">
        <div class="sec-ttl">
            <p>{{ $plan->title }}</p>
            <p>【{{ session('selected_option') }}】</p>
        </div>
        <div class="detail_info">
            <div class="detail_info_content" style="width: 80%;	margin:0 auto;">
                <div style="text-align: center;">
                    <h3 style="color: #ff1493">※決済方法を選んでください。</h3>
                    <p>価格</p>
                    <div><span>{{ $plan->price }}</span>円</div>
                </div>
                <div class="plan-btn-wrap address-submit-wrap"><a class="plan-btn address-submit" href="{{ $qr_code['data']['url'] }}" style="margin-bottom: 8px; display: inline-block; width: 100%; max-width: 300px;">PayPayで決済する</a>
                <form action="{{ route('user.plan.join_for_payjp', ['project' => $project, 'plan' => $plan, 'unique_token' => $unique_token]) }}" method="GET" class="text-center mt-xxl">
                @csrf
                    <script src="https://checkout.pay.jp/" class="payjp-button" data-key="{{ config('app.pay_jp_key_for_test') }}" data-partial="false"></script>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
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
    el.attr('style', 'background-color: #ff1493; background-image: initial; max-width: 300px; width: 100%; height: 48px; font-size: 18px; border-radius: 5px; border: 2px solid #ff1493');
});
</script>
@endsection
