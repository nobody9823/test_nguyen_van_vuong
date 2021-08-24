@extends('user.layouts.base')

@section('title', 'マイページ | マイプロジェクト')

@section('content')
<section id="supported-projects" class="section_base">
    <div class="tit_L_01 E-font">
        <h2>PROJECT DETAIL</h2>
        <div class="sub_tit_L">プロジェクト詳細</div>
    </div>
    <div class="prof_page_base inner_item">
        <x-user.mypage-navigation-bar/>

            <div class="prof_page_R">
                <div class="su_pr_base">
                    <a href="{{ route('user.my_project.project.edit', ['project' => $project]) }}">
                        @if ($project->projectFiles()->where('file_content_type', 'image_url')->exists())
                            <div class="su_pr_img m_b_1510"><img class="" src="{{ Storage::url($project->projectFiles()->where('file_content_type', 'image_url')->first()->file_url) }}"></div>
                        @else
                            <div class="su_pr_img m_b_1510"><img class="" src="{{ Storage::url('public/sampleImage/now_printing.png') }}"></div>
                        @endif
                    </a>
                    <div class="su_pr_01 m_b_1510">
                        <div class="su_pr_01_01 m_b_1510">タイトル名 : {{ $project->title === '' ? 'なし' : Str::limit($project->title, 46) }}</div>
                        <div class="su_pr_01_02 m_b_1510">現在の支援総額：{{ number_format($project->payments_sum_price) }}円</div>
                        <div class="pds_sec01_progress-bar m_b_1510">
                            <div class="progress-bar_par"><div>0%</div><div>100%</div></div>
                            <div class="progress-bar">
                                <span style="width: {{ $project->achievement_rate }}%; max-width:100%"></span>
                            </div>
                        </div>
                        <div class="su_pr_01_03 m_b_1510">
                            <div>目標金額は¥{{ number_format($project->target_amount) }}</div>
                            <div>支援者数：{{ $project->payments_count !== null && $project->payments_count !== 0 ? $project->payments_count : 'なし' }}</div>
                            @if (DateFormat::checkDateIsFuture($project->start_date))
                                {{-- NOTICE: 追加開発が決まったら以下2箇所とpaymentブレード内のところとDateFormatファサード内のコメントアウトを外してください --}}
                                {{-- @if (DateFormat::checkDateIsWithInADay($project->start_date))
                                    <div style="color: #e65d65;">募集開始まで残り: {{ DateFormat::getDiffCompareWithToday($project->start_date) }}時間</div>
                                @else --}}
                                    <div>募集開始まで残り: {{ DateFormat::getDiffCompareWithToday($project->start_date) }}日</div>
                                {{-- @endif --}}
                            @elseif (DateFormat::checkDateIsPast($project->start_date) && DateFormat::checkDateIsFuture($project->end_date))
                                {{-- @if (DateFormat::checkDateIsWithInADay($project->end_date))
                                    <div style="color: #e65d65;">募集終了まで残り：{{ DateFormat::getDiffCompareWithToday($project->end_date) }}時間</div>
                                @else --}}
                                    <div>募集終了まで残り：{{ DateFormat::getDiffCompareWithToday($project->end_date) }}日</div>
                                {{-- @endif --}}
                            @elseif (DateFormat::checkDateIsPast($project->end_date))
                                <div>募集終了</div>
                            @endif
                        </div><!--/su_pr_01_03-->
                    </div><!--/su_pr_01-->
                    <div class="su_pr_02">
                        <div class="su_pr_02_04 m_b_1510">
                            <div>
                                {{-- FIXME: ここのステータスの部分はユーザーに分かりやすいような文言へと修正が必要そうです --}}
                                <span>あなたのプロジェクトは</span>
                                @if($project->release_status === '---')
                                    <span style="border-bottom: 2px solid #555353">申請前</span>
                                @elseif($project->release_status === '承認待ち')
                                    <span style="border-bottom: 2px solid #555353">審査中</span>
                                @elseif($project->release_status === '掲載中')
                                    <span style="border-bottom: 2px solid #555353">公開中</span>
                                @elseif($project->release_status === '掲載停止中')
                                    <span style="border-bottom: 2px solid #555353">{{ $project->release_status }}</span>
                                @elseif($project->release_status === '差し戻し')
                                    <span style="border-bottom: 2px solid #555353">要修正</span>
                                @endif
                                です。
                            </div>
                        </div>
                    </div>

                    {{-- NOTICE: キャンプファイアの方ではリターンの一覧が特になかったので一旦コメントアウトにしています。 --}}
                    {{-- <div class="tit_L_01 E-font accordion js-accordion">
                        @if ($project->plans_count > 0)
                        <div class="accordion__item js-accordion-trigger">
                            <div class="sub_tit_L accordion__title accordion__arrow">リターン : {{ $project->plans()->count() }}件</div>
                            <div class="accordion__content">
                            @foreach($project->plans as $plan)
                                <div class="su_pr_02_01 m_b_1510">リターン名 : {{ $plan->title }}</div>
                                <div class="su_pr_02_02 m_b_1510"></div>
                                <div class="su_pr_02_03 m_b_1510">
                                    <div><span>商品単価</span><br>{{ $plan->price }}円</div>
                                    <div><span>残り</span><br>{{ $plan->limit_of_supporters }}個</div>
                                </div><!--/su_pr_02_03-->
                                <div class="su_pr_02_04 m_b_1510">
                                    <div>お届け予定日：{{ $plan->delivery_date }}</div>
                                </div><!--/su_pr_02_04-->
                            @endforeach
                            </div>
                        </div>
                        @else
                            <div class="sub_tit_L">プラン : 0件</div>
                        @endif
                    </div><!--/su_pr_02--> --}}

                    <div class="tit_L_01 E-font">
                        <div class="sub_tit_L"><a href="{{ route('user.report.index', ['project' => $project]) }}">活動報告 : {{ $project->reports_count }}件</a></div>
                            {{-- <div class="su_pr_02">
                                <div class="su_pr_02_01 m_b_1510">リターン名</div>
                                <div class="su_pr_02_02 m_b_1510"></div>
                                <div class="su_pr_02_03 m_b_1510">
                                    <div><span>支払い総額</span><br>円</div>
                                    <div><span>商品単価</span><br>円</div>
                                    <div><span>数量</span><br>個</div>
                                </div><!--/su_pr_02_03-->
                                <div class="su_pr_02_04 m_b_1510">
                                    <div>支援日：{{ DateFormat::forJapanese($project->created_at) }}</div>
                                    <div>お届け予定日：</div>
                                </div><!--/su_pr_02_04-->
                                <div class="su_pr_02_05 m_b_1510">
                                    商品の紹介文：
                                </div>
                            </div><!--/su_pr_02--> --}}
                        </div>
                        {{-- <div class="def_btn">
                            @if ($project->relaese_status === '掲載中' && $project->relaese_status === '掲載停止中')
                                <a class="disable-btn">
                                    <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">作成画面へ</p>
                                </a>
                            @else
                                <a class="disable-btn">
                                    <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">掲載後に投稿できます。</p>
                                </a>
                            @endif
                        </div> --}}
                        <div class="tit_L_01 E-font">
                            <div class="sub_tit_L"><a href="{{ route('user.comment.index', ['project' => $project]) }}">コメント : {{ $project->comments_count }}件</a></div>
                                {{-- <div class="su_pr_02">
                                    <div class="su_pr_02_01 m_b_1510">リターン名</div>
                                    <div class="su_pr_02_02 m_b_1510"></div>
                                    <div class="su_pr_02_03 m_b_1510">
                                        <div><span>支払い総額</span><br>円</div>
                                        <div><span>商品単価</span><br>円</div>
                                        <div><span>数量</span><br>個</div>
                                    </div><!--/su_pr_02_03-->
                                    <div class="su_pr_02_04 m_b_1510">
                                        <div>支援日：{{ DateFormat::forJapanese($project->created_at) }}</div>
                                        <div>お届け予定日：</div>
                                    </div><!--/su_pr_02_04-->
                                    <div class="su_pr_02_05 m_b_1510">
                                        商品の紹介文：
                                    </div>
                                </div><!--/su_pr_02--> --}}
                            </div>
                            <div class="tit_L_01 E-font">
                                <div class="sub_tit_L"><a href="{{ route('user.my_project.message.index', ['project' => $project]) }}">支援者とのやりとり : {{ $project->payments_count }}人</a></div>
                                    {{-- <div class="su_pr_02">
                                        <div class="su_pr_02_01 m_b_1510">リターン名</div>
                                        <div class="su_pr_02_02 m_b_1510"></div>
                                        <div class="su_pr_02_03 m_b_1510">
                                            <div><span>支払い総額</span><br>円</div>
                                            <div><span>商品単価</span><br>円</div>
                                            <div><span>数量</span><br>個</div>
                                        </div><!--/su_pr_02_03-->
                                        <div class="su_pr_02_04 m_b_1510">
                                            <div>支援日：{{ DateFormat::forJapanese($project->created_at) }}</div>
                                            <div>お届け予定日：</div>
                                        </div><!--/su_pr_02_04-->
                                        <div class="su_pr_02_05 m_b_1510">
                                            商品の紹介文：
                                        </div>
                                    </div><!--/su_pr_02--> --}}
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
    </div>
</section>
@endsection

@section('script')
<script src="{{ asset('js/accordion.js') }}"></script>
@endsection
