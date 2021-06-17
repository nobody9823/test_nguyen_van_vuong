@extends('user.layouts.base')

@section('content')

@section('content')
{{--エラーメッセージ--}}
<div class="content sub_content detail_content">
    <div class="fixedcontainer">
        <div class="detail_info">
            <div class="detail_info_content" style="width: 80%;	margin:0 auto;">
                <div style="text-align: center;">
                    <h3 style="color: #ff1493"><h3>支援が完了しました。</h3>
                    <p>支援詳細についてはマイページをご覧ください。</p>
                    <a class="plan-btn" href="{{ route('user.plan') }}" style="display: inline-block; width: 45%">マイページへ戻る</a>
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