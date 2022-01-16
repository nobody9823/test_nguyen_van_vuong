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

            <div class="prof_page_R my_project_detail">
                <div class="su_pr_base">
                    <x-common.mypage.project-information :project="$project" />

                    <div class="su_pr_02">
                        <div class="su_pr_02_04 m_b_1510 my_project_dashboard">
                            <div class="my_project_dashboard_status">
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
                            <div class="def_btn">
                                @if($project->release_status === '---' || $project->release_status === '差し戻し')
                                プロジェクトを編集する
                                {{-- NOTICE: MyProjectController, edit action --}}
                                <a class="cover_link" href="{{ route('user.my_project.project.edit', ['project' => $project]) }}"></a>
                                @elseif(
                                    $project->release_status === '承認待ち' ||
                                    $project->release_status === '掲載中' ||
                                    $project->release_status === '掲載停止中'
                                )
                                {{ $project->release_status }}
                                <a class="cover_link"></a>
                                @endif
                            </div>
                            @if(
                                $project->release_status === ProjectReleaseStatus::getValue('Default') || $project->release_status === ProjectReleaseStatus::getValue('SendBack')
                            )
                            <div class="def_btn">
                                <form
                                    action="{{ route('user.project.apply', ['project' => $project]) }}"
                                    method="POST"
                                    onclick=
                                    "applySubmit(
                                        {{ $project }},
                                        {{ $project->plans }},
                                        {{ $project->tags }},
                                        {{ $project->user->profile }},
                                        {{ $project->user->address }},
                                        {{$project->user->identification}},
                                        {{ $bank_account }}
                                    )"
                                >
                                    @csrf
                                    申請する
                                    <button type="button" class="cover_link disable-btn">
                                    </button>
                                </form>
                            </div>
                            @endif
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
                                    <div><span>商品単価</span><br>{{ $plan->price }}円(税込)</div>
                                    <div><span>残り</span><br>{{ $plan->limit_of_supporters }}個</div>
                                </div><!--/su_pr_02_03-->
                                <div class="su_pr_02_04 m_b_1510">
                                    <div>お届け予定日：{{ $plan->formatted_delivery_date }}</div>
                                </div><!--/su_pr_02_04-->
                            @endforeach
                            </div>
                        </div>
                        @else
                            <div class="sub_tit_L">プラン : 0件</div>
                        @endif
                    </div><!--/su_pr_02--> --}}

                <div>
                    <div class="content">
                        <div class="sub_tit_L">
                            <h2><i class="fas fa-address-card"></i>&ensp;支援者一覧</h2>
                            <p class="content_explanatory_text">プロジェクト支援者の個人情報(住所や電話番号等)が閲覧できます。</p>
                        </div>
                        @if ($project->release_status === '掲載中')
                        <a href="{{ route('user.supporter.index', ['project' => $project]) }}">
                            <div class="display_count_btn">
                                @if ($project->payments_count > 0)
                                <p>{{ $project->payments_count }}人の支援者がいます</p>
                                @else
                                <p>現在支援者はいません</p>
                                @endif
                            </div>
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                        @else
                        <div class="caution_box">
                            <p>
                                {{ ProjectReleaseStatus::getValue('UnderSuspension')
                                    ? '掲載停止中の為、閲覧できません'
                                    : 'プロジェクトの審査を通過すると閲覧可能です'
                                }}
                            </p>
                        </div>
                        @endif
                    </div>
                    <div class="content">
                        <div class="sub_tit_L">
                            <h2><i class="fas fa-envelope"></i>&ensp;支援者とのDM</h2>
                            <p class="content_explanatory_text">プロジェクト支援者と起案者でやり取りが必要な場合、ダイレクトメッセージをご利用ください。</p>
                        </div>
                        @if ($project->release_status === '掲載中')
                        <a href="{{ route('user.my_project.message.index', ['project' => $project]) }}">
                            <div class="display_count_btn">
                                {{-- FIXME: ここはmainブランチとコンフリクトすると思いますので、支援者のDM件数が表示されるようにしてください。 2021/12/26 --}}
                                @if ($project->payments_count > 0)
                                <p>{{ $project->payments_count }}件のDMがあります</p>
                                @else
                                <p>現在支援者からのDMはありません</p>
                                @endif
                            </div>
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                        @else
                        <div class="caution_box">
                            <p>
                                {{ ProjectReleaseStatus::getValue('UnderSuspension')
                                    ? '掲載停止中の為、閲覧できません'
                                    : 'プロジェクトの審査を通過すると閲覧可能です'
                                }}
                            </p>
                        </div>
                        @endif
                    </div>
                    <div class="content">
                        <div class="sub_tit_L">
                            <h2><i class="fas fa-comments"></i>&ensp;コメント</h2>
                            <p class="content_explanatory_text">プロジェクト支援者から受け取った応援コメントの閲覧や返信ができます。</p>
                        </div>
                        @if ($project->release_status === '掲載中')
                        <a href="{{ route('user.comment.index', ['project' => $project]) }}">
                            <div class="display_count_btn">
                                @if ($project->comments_count > 0)
                                <p>{{ $project->comments_count }}人からのコメントがあります</p>
                                @else
                                <p>現在支援者からのコメントはありません</p>
                                @endif
                            </div>
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                        @else
                        <div class="caution_box">
                            <p>
                                {{ ProjectReleaseStatus::getValue('UnderSuspension')
                                    ? '掲載停止中の為、閲覧できません'
                                    : 'プロジェクトの審査を通過すると閲覧可能です'
                                }}
                            </p>
                        </div>
                        @endif
                    </div>
                    <div class="content">
                        <div class="sub_tit_L">
                            <h2><i class="fas fa-bullhorn"></i>&ensp;活動報告</h2>
                            <p class="content_explanatory_text">プロジェクトの活動進捗を支援者に向け、発信する事ができます。</p>
                        </div>
                        @if ($project->release_status === '掲載中')
                        <a href="{{ route('user.report.index', ['project' => $project]) }}">
                            <div class="display_count_btn">
                                @if ($project->reports_count > 0)
                                <p>{{ $project->reports_count }}件の活動報告があります</p>
                                @else
                                <p>活動報告は未作成です</p>
                                @endif
                            </div>
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                        @else
                        <div class="caution_box">
                            <p>
                                {{ ProjectReleaseStatus::getValue('UnderSuspension')
                                    ? '掲載停止中の為、投稿できません'
                                    : 'プロジェクトの審査を通過すると投稿可能です'
                                }}
                            </p>
                        </div>
                        @endif
                    </div>
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
                </div>
            </div>
    </div>
</section>
@endsection

@section('script')
<script src="{{ asset('js/accordion.js') }}"></script>
<script src={{ asset('/js/apply-submit.js') }}></script>
@endsection
