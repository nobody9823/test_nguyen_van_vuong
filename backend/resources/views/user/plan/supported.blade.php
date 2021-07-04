@extends('user.layouts.base')

@section('content')
<div class="Assist-input_base">
	<div class="as_header_01">
		<div class="as_header_inner">
			<div class="as_h_01">
				<div class="as_h_01_01"><div class="as_h_01_dotted"><div></div></div><div class="as_h_01_txt">入力</div></div>
				<div class="as_h_01_02"><div class="as_h_01_dotted"><div></div></div><div class="as_h_01_txt">確認</div></div>
				<div class="as_h_01_03"><div class="as_h_01_dotted as_h_01_current"><div></div></div><div class="as_h_01_txt">完了</div></div>
			</div><!--/-->

			<div class="as_h_line"></div><!--/-->
		</div><!--/as_header_inner-->
	</div><!--/as_header-->

	<div class="as_header_02 inner_item" style="padding: 50px 0 5px 0;">ありがとうございます！</div>
	<div class="as_header_03">あなたは、{{ $supporter_count }}人目の支援者です<br>支援総額は{{ $total_amount }}円になりました</div>

	<div class="av_box_base def_inner inner_item">


		<div class="av_box">
			<div class="av_tit">プロジェクト名</div>
			<div class="av_txt">
				{{ $project->title }}
			</div>
		</div><!--/av_box-->


		<div class="av_box">
			<div class="av_tit">支援ID</div>
			<div class="av_txt">
				{{ $payment->merchant_payment_id }}<br>
			</div>
		</div><!--/av_box-->


		<div class="as_header_03" style="padding:30px 0 ;">
            ご入力いただいたメールアドレスに支援完了のメールをお送りしました<br>支援完了メールが届かない場合は、<br>
            <a href="{{ route('user.profile', ['input_type' => 'email']) }}">こちらからメールアドレスの変更</a>をお願い致します
        </div>
		<div class="as_header_02 inner_item" style="padding:30px 0 ;">支援者になったことを是非広めましょう！</div>

        <div class="def_btn">
            <a href="{{ route('user.project.support', ['project' => $project]) }}" style="color: white">
                プロジェクトサポーターになる
            </a>
        </div>
	</div><!--/av_box_base-->
</div><!--/.Assist-input_base-->
@endsection
