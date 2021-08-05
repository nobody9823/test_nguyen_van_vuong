@extends('user.layouts.base')

@section('content')
    <div class="Assist-input_base">
        <div class="as_header_01">
            <div class="as_header_inner">
                <div class="as_h_01">
                    <div class="as_h_01_01">
                        <div class="as_h_01_dotted">
                            <div></div>
                        </div>
                        <div class="as_h_01_txt">入力</div>
                    </div>
                    <div class="as_h_01_02">
                        <div class="as_h_01_dotted">
                            <div></div>
                        </div>
                        <div class="as_h_01_txt">確認</div>
                    </div>
                    <div class="as_h_01_03">
                        <div class="as_h_01_dotted as_h_01_current">
                            <div></div>
                        </div>
                        <div class="as_h_01_txt">完了</div>
                    </div>
                </div>
                <!--/-->

                <div class="as_h_line"></div>
                <!--/-->
            </div>
            <!--/as_header_inner-->
        </div>
        <!--/as_header-->

        <div class="as_header_02 inner_item" style="padding: 50px 0 5px 0;">ありがとうございます！</div>
        <div class="as_header_03">
            あなたは、{{ $project->payments_count }}人目の支援者です<br>支援総額は{{ $project->payments_sum_price }}円になりました</div>

        <div class="av_box_base def_inner inner_item">


            <div class="av_box">
                <div class="av_tit">プロジェクト内容</div>

                <div class="ps_rank_img m_b_1510">
                    <img
                        src="{{ Storage::url(optional($project->projectFiles()->where('file_content_type', 'image_url')->first())->file_url) }}">
                </div>
                <div class="m_b_3020">
                    <div class="pds_sec01_progress-bar m_b_1510">
                        <div class="progress-bar_par">
                            <div>0%</div>
                            <div>100%</div>
                        </div>
                        <div class="progress-bar">
                            <span style="width: {{ $project->achievement_rate }}%; max-width:100%"></span>
                        </div>
                    </div>
                    <div class="ps_rank_01_01 m_b_1510">
                        <div>現在：{{ number_format($project->payments_sum_price) }}円</div>
                        <div>支援者数：{{ $project->payments_count }}人</div>
                        <div>募集終了まで残り：{{ $project->number_of_days_left }}日</div>
                    </div>
                    <!--/ps_rank_01_03-->
                    <div class="ps_rank_01_02 m_b_1510">
                        {{ $project->title }}
                    </div>
                    <div class="ps_rank_01_03 m_b_1510">
                        {!! Str::limit($project->content, 400) !!}
                    </div>
                </div>
                <!--/ps_rank_01-->
                <div class="m_b_3020">
                    <div class="ps_rank_01_03 m_b_1510">
                        {!! $project->ps_plan_content !!}
                    </div>
                </div>

            </div>
            <!--/av_box-->


            <div class="av_box">
                <div class="av_tit">支援ID</div>
                <div class="av_txt">
                    {{ $payment->paymentToken->token }}<br>
                </div>
            </div>
            <!--/av_box-->


            <div class="as_header_03" style="padding:30px 0 ;">
                ご入力いただいたメールアドレスに支援完了のメールをお送りしました<br>支援完了メールが届かない場合は、<br>
                <a href="{{ route('user.profile', ['input_type' => 'email']) }}">こちらからメールアドレスの変更</a>をお願い致します
            </div>
            <div class="as_header_02 inner_item" style="padding:30px 0 ;">支援者になったことを是非広めましょう！</div>

            <div class="def_btn">
                <a href="{{ route('user.project.support', ['project' => $project]) }}" style="color: white">
                    プロジェクトサポーター(PS)になる
                </a>
            </div>
            <div class="def_btn">ランキングを見る
                <a href="{{ route('user.project.supporter_ranking', ['project' => $project]) }}" class="cover_link"></a>
            </div>
        </div>
        <!--/av_box_base-->
    </div>
    <!--/.Assist-input_base-->
@endsection
