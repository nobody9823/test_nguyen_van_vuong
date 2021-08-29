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
            <section id="pc-top_04" class="section_base">
                <div class="img_box_02">
                    @foreach($projects as $project)
                    <div class="my_project_img_box_wrapper">
                        <div class="ib02_01 E-font my_project_img_wrapper">
                            <a href="{{ route('user.my_project.project.show', ['project' => $project]) }}">
                                @if ($project->projectFiles()->where('file_content_type', 'image_url')->count() > 0)
                                    <img src="{{ Storage::url($project->projectFiles()->where('file_content_type', 'image_url')->first()->file_url) }}">
                                @else
                                    <img src={{ Storage::url('public/sampleImage/now_printing.png') }}>
                                @endif
                            </a>
                            {{-- NOTICE: MyProjectController, show action --}}
                        </div>

                        <div class="my_project_img_content_wrapper">
                            <div class="ib02_02 my_project_release_status">
                                <div>
                                ({{ $project->release_status === ProjectReleaseStatus::getValue('Default') ? '申請前' : $project->release_status }})
                                </div>
                                <div class="my_project_apply_wrapper">
                                    @if($project->release_status === ProjectReleaseStatus::getValue('Default') || $project->release_status === ProjectReleaseStatus::getValue('SendBack') || $project->release_status === ProjectReleaseStatus::getValue('UnderSuspension'))
                                    <div class="def_btn my_project_apply">
                                        <form action="{{ route('user.project.apply', ['project' => $project]) }}" method="POST" onsubmit="return confirm('送信しますか？')">
                                            @csrf
                                            申請する
                                            <button type="submit" class="cover_link disable-btn">
                                            </button>
                                        </form>
                                    </div>
                                    @endif

                                    @if ($project->release_status === ProjectReleaseStatus::getValue('Default') || $project->release_status === ProjectReleaseStatus::getValue('SendBack'))
                                    <div class="def_btn my_project_apply">
                                        <form action="{{ route('user.my_project.project.destroy', ['project' => $project]) }}" method="POST" onsubmit="return confirm('送信しますか？')">
                                            @csrf
                                            @method('DELETE')
                                            削除する
                                            <button type="submit" class="cover_link disable-btn">
                                            </button>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="ib02_03">
                                <a href="{{ route('user.my_project.project.show', ['project' => $project]) }}">
                                    <h3>{{ Str::limit($project->title, 46) }}</h3>
                                    {{-- NOTICE: MyProjectController, show action--}}
                                </a>
                            </div>
                        </div>

                        <div class="def_btn">
                            @if($project->release_status === '---' || $project->release_status === '差し戻し' || $project->release_status === '掲載停止中')
                            編集
                            {{-- NOTICE: MyProjectController, edit action --}}
                            <a class="cover_link" href="{{ route('user.my_project.project.edit', ['project' => $project]) }}"></a>
                            @elseif($project->release_status === '承認待ち' || $project->release_status === '掲載中')
                            {{ $project->release_status }}
                            <a class="cover_link"></a>
                            @endif
                        </div>
                    </div><!--/.img_box_01_L_item-->
                    @endforeach
                </div>
            </section><!--/#pc-top_04-->
        </div>
    </div>
</section>
@endsection
