@extends('user.layouts.base')

@section('title', 'マイページ | マイプロジェクト')

@section('content')
<section id="supported-projects" class="section_base">
    <div class="tit_L_01 E-font">
        <h2>MY PROJECTS</h2>
        <div class="sub_tit_L">マイプロジェクト</div>
    </div>
    <div class="prof_page_base inner_item">
        <div class="prof_page_L">
            <x-user.mypage-navigation-bar/>
        </div>
        <div class="prof_page_R">
            <section id="pc-top_04" class="section_base">
                <div class="my_project_container">
                    @foreach($projects as $project)
                    <div class="my_project_img_box_wrapper">
                        @if ($project->release_status === ProjectReleaseStatus::getValue('Default') || $project->release_status === ProjectReleaseStatus::getValue('SendBack'))
                        <div>
                            <form action="{{ route('user.my_project.project.destroy', ['project' => $project]) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')" class="my_project_delete_form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="fas fa-times-circle fa-2x my_project_delete_btn"></button>
                            </form>
                        </div>
                        @endif

                        <div class="ib02_01 E-font my_project_img_wrapper
                        @switch($project->release_status)
                            @case(ProjectReleaseStatus::getValue('Default'))
                                default_band
                                @break
                            @case(ProjectReleaseStatus::getValue('Pending'))
                                pending_band
                                @break
                            @case(ProjectReleaseStatus::getValue('Published'))
                                @switch($project->state_of_release_period)
                                    @case('公開前')
                                        published_band__before
                                        @break
                                    @case('公開中')
                                        published_band__progress
                                        @break
                                    @case('公開終了')
                                        published_band__after
                                        @break
                                @endswitch
                                @break
                            @case(ProjectReleaseStatus::getValue('UnderSuspension'))
                                under_suspension_band
                                @break
                            @case(ProjectReleaseStatus::getValue('SendBack'))
                                send_back_band
                                @break
                        @endswitch
                        ">
                            <a href="{{ route('user.my_project.project.show', ['project' => $project]) }}">
                                @if ($project->projectFiles()->where('file_content_type', 'image_url')->count() > 0)
                                    <img src="{{ asset(Storage::url($project->projectFiles()->where('file_content_type', 'image_url')->first()->file_url)) }}">
                                @else
                                    <img src={{ asset(Storage::url('public/sampleImage/now_printing.png')) }}>
                                @endif
                            </a>
                            {{-- NOTICE: MyProjectController, show action --}}
                        </div>
                        <div class="ib02_03">
                            <a href="{{ route('user.my_project.project.show', ['project' => $project]) }}">
                                <h3>{{ Str::limit($project->title, 40) }}</h3>
                                {{-- NOTICE: MyProjectController, show action--}}
                            </a>
                        </div>

                        <div class="def_btn edit_btn">
                            @if(
                            $project->release_status === ProjectReleaseStatus::getValue('Default') ||
                            $project->release_status === ProjectReleaseStatus::getValue('SendBack')
                            )
                            編集
                            {{-- NOTICE: MyProjectController, edit action --}}
                            <a class="display_release_status" href="{{ route('user.my_project.project.edit', ['project' => $project]) }}"></a>
                            @elseif(
                            $project->release_status === ProjectReleaseStatus::getValue('Pending') ||
                            $project->release_status === ProjectReleaseStatus::getValue('Published') ||
                            $project->release_status === ProjectReleaseStatus::getValue('UnderSuspension')
                            )
                            プロジェクト詳細
                            <a class="display_release_status" href="{{ route('user.my_project.project.show', ['project' => $project]) }}"></a>
                            @endif
                        </div>

                        <div class="my_project_img_content_wrapper">
                            <div class="my_project_release_status">
                                <div class="my_project_apply_wrapper">
                                    @if(
                                        $project->release_status === ProjectReleaseStatus::getValue('Default') || $project->release_status === ProjectReleaseStatus::getValue('SendBack')
                                        )
                                    <div class="apply_btn">
                                        <form action="{{ route('user.project.apply', ['project' => $project]) }}" method="POST" id="apply_form">
                                            @csrf
                                            申請
                                            <button
                                                type="button"
                                                class="cover_link disable-btn"
                                                onclick="applySubmit(
                                                    {{ $project }},
                                                    {{ $project->plans }},
                                                    {{ $project->tags }},
                                                    {{ $project->user->profile }},
                                                    {{ $project->user->address }},
                                                    {{$project->user->identification}},
                                                    {{ $bank_account }}
                                                )"
                                            >
                                            </button>
                                        </form>
                                    </div>
                                    @elseif ($project->release_status === ProjectReleaseStatus::getValue('Published'))
                                    <div class="apply_btn">
                                        <form action="{{ route('user.my_project.message.index', ['project' => $project]) }}" method="GET">
                                            @csrf
                                            支援者とのDM
                                            <button type="submit" class="cover_link disable-btn"></button>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div><!--/.img_box_01_L_item-->
                    @endforeach
                </div>
            </section><!--/#pc-top_04-->
            <div class="my_new_project_wrapper">
                {{--NOTICE: MyProjectController, create action --}}
                <a href="{{ route('user.my_project.project.create') }}" class="footer-over_L my_new_project">
                    <div class="footer-over_L_02">
                    <div class="footer-over_L_02_01">New Project</div>
                    <div class="footer-over_L_02_02">新規プロジェクト作成はこちら</div>
                    </div>
                    <div class="footer-over_L_03"><i class="fas fa-chevron-right"></i></div>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
    <script src="{{ asset('/js/apply-submit.js') }}?20220428"></script>
@endsection
