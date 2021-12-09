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

                        <div class="ib02_03">
                            <a href="{{ route('user.my_project.project.show', ['project' => $project]) }}">
                                <h3>{{ Str::limit($project->title, 40) }}</h3>
                                {{-- NOTICE: MyProjectController, show action--}}
                            </a>
                        </div>

                        <div class="def_btn edit_btn">
                            @if($project->release_status === '---' || $project->release_status === '差し戻し' || $project->release_status === '掲載停止中')
                            編集
                            {{-- NOTICE: MyProjectController, edit action --}}
                            <a class="display_release_status" href="{{ route('user.my_project.project.edit', ['project' => $project]) }}"></a>
                            @elseif($project->release_status === '承認待ち' || $project->release_status === '掲載中')
                            {{ $project->release_status }}
                            <a class="display_release_status"></a>
                            @endif
                        </div>

                        <div class="my_project_img_content_wrapper">
                            <div class="my_project_release_status">
                                <div class="my_project_apply_wrapper">
                                    @if($project->release_status === ProjectReleaseStatus::getValue('Default') || $project->release_status === ProjectReleaseStatus::getValue('SendBack') || $project->release_status === ProjectReleaseStatus::getValue('UnderSuspension'))
                                    <div class="apply_btn">
                                        <form action="{{ route('user.project.apply', ['project' => $project]) }}" method="POST" id="apply_form">
                                            @csrf
                                            申請
                                            <button type="button" class="cover_link disable-btn" onclick="applySubmit()"></button>
                                        </form>
                                        {{-- <form action="{{ route('user.project.apply', ['project' => $project]) }}" method="POST" onsubmit="return confirm('本当に申請してもよろしいでしょうか？')">
                                            @csrf
                                            申請
                                            <button type="submit" class="cover_link disable-btn"></button>
                                        </form> --}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @if($project->release_status === '差し戻し' || $project->release_status === '掲載停止中')
                            <div class="caution_release_status">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ $project->release_status }}
                            </div>
                            @endif
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
<script>
    function applySubmit() {
        // if ({{ $project->title === "" }}) {
        //     alert('タイトルが記述されていません');
        // } else if ({{ $project->description === "" }}) {
        //     alert('概要が記述されていません');
        // } else {
            document.getElementById('apply_form').submit();
        // }
    }
</script>
@endsection
