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
                        <h3 style="color: #ff1493">※PayPayで支援しますか？</h3>
                        <p>価格</p>
                        <div><span>{{ $plan->price }}</span>円</div>
                        
                        <a class="plan-btn" href="{{ $qr_code['url'] }}" style="display: inline-block; width: 45%">paypayで決済する</a>
                    </div>
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
@endsection
@endsection
