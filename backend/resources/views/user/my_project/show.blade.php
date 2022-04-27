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
                                <span>あなたのプロジェクトは</span>
                                <span class="status_text">
                                    @switch($project->release_status)
                                    @case(ProjectReleaseStatus::getValue('Default'))
                                        申請前
                                        @break
                                    @case(ProjectReleaseStatus::getValue('Pending'))
                                        審査中
                                        @break
                                    @case(ProjectReleaseStatus::getValue('Published'))
                                        {{ $project->state_of_release_period }}
                                        @break
                                    @case(ProjectReleaseStatus::getValue('UnderSuspension'))
                                        掲載停止中
                                        @break
                                    @case(ProjectReleaseStatus::getValue('SendBack'))
                                        修正が必要
                                        @break
                                    @endswitch
                                </span>
                                <span>です。</span>
                            </div>
                            @if(
                                $project->release_status === ProjectReleaseStatus::getValue('Default') || $project->release_status === ProjectReleaseStatus::getValue('SendBack')
                                )
                                <div class="def_btn">
                                    プロジェクトを編集する
                                    {{-- NOTICE: MyProjectController, edit action --}}
                                    <a
                                        class="cover_link"
                                        href="{{ route('user.my_project.project.edit', ['project' => $project]) }}">
                                    </a>
                                </div>
                            @endif
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
                            @else
                            <div class="def_btn">
                                <a
                                    class="cover_link"
                                    href="{{ route('user.project_preview', ['project' => $project] )}}">
                                </a>
                                <i class="fas fa-eye">　プレビュー</i>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div>
                    <div class="content">
                        <div class="sub_tit_L">
                            <h2><i class="fas fa-address-card"></i>&ensp;支援者一覧</h2>
                            <p class="content_explanatory_text">プロジェクト支援者の個人情報(住所や電話番号等)が閲覧できます。</p>
                        </div>
                        @if ($project->release_status === ProjectReleaseStatus::getValue('Published'))
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
                                {{ $project->release_status === ProjectReleaseStatus::getValue('UnderSuspension')
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
                        @if ($project->release_status === ProjectReleaseStatus::getValue('Published'))
                        <a href="{{ route('user.my_project.message.index', ['project' => $project]) }}">
                            <div class="display_count_btn">
                                {{-- FIXME: ここはmainブランチとコンフリクトすると思いますので、支援者のDM件数が表示されるようにしてください。 2021/12/26 --}}
                                @if ($not_read_message_count > 0)
                                <p>未読のDMが{{ $not_read_message_count }}件あります</p>
                                @else
                                <p>現在支援者からのDMはありません</p>
                                @endif
                            </div>
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                        @else
                        <div class="caution_box">
                            <p>
                                {{ $project->release_status === ProjectReleaseStatus::getValue('UnderSuspension')
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
                        @if ($project->release_status === ProjectReleaseStatus::getValue('Published'))
                        <a href="{{ route('user.comment.index', ['project' => $project]) }}">
                            <div class="display_count_btn">
                                @if ($project->comments_count > 0)
                                <p>{{ $project->comments_count }}件のコメントがあります</p>
                                @else
                                <p>現在支援者からのコメントはありません</p>
                                @endif
                            </div>
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                        @else
                        <div class="caution_box">
                            <p>
                                {{ $project->release_status === ProjectReleaseStatus::getValue('UnderSuspension')
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
                        @if ($project->release_status === ProjectReleaseStatus::getValue('Published'))
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
                                {{ $project->release_status === ProjectReleaseStatus::getValue('UnderSuspension')
                                    ? '掲載停止中の為、投稿できません'
                                    : 'プロジェクトの審査を通過すると投稿可能です'
                                }}
                            </p>
                        </div>
                        @endif
                    </div>
                    <div class="content_ps">
                        <div class="sub_tit_L content_explanatory">
                            <h2><i class="fas fa-gift fa-lg"></i>&ensp;このプロジェクトのPSリターン</h2>
                            <p class="content_explanatory_text">
                                支援者があなたのプロジェクトをSNSなどで拡散します。<br>
                                拡散した支援者に特別なリターンを送ることができます。
                            </p>
                        </div>
                        @if ($project->release_status === ProjectReleaseStatus::getValue('Published'))
                        <a href="{{ route('user.project.support', ['project' => $project]) }}">
                            <div class="display_count_btn">
                                <p>プロジェクトサポーター(PS)とは</p>
                            </div>
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                        <a href="{{ route('user.project.supporter_ranking', ['project' => $project]) }}">
                            <div class="display_count_btn">
                                <p>プロジェクトサポーター(PS)ランキングページ</p>
                            </div>
                            <i class="fas fa-arrow-circle-right"></i>
                        </a>
                        @else
                        <div class="ps_caution_box">
                            <p>
                                {{ $project->release_status === ProjectReleaseStatus::getValue('UnderSuspension')
                                    ? '掲載停止中の為、閲覧できません。'
                                    : 'プロジェクトの審査を通過すると閲覧可能です'
                                }}
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
    </div>
</section>
@endsection

@section('script')
<script src="{{ asset('js/accordion.js') }}"></script>
<script src="{{ asset('/js/apply-submit.js') }}?20220428"></script>
@endsection
