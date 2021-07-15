@extends('user.layouts.base')

@section('title', 'マイページ | マイプロジェクト')

@section('content')
<section class="section_base">
    <div class="tit_L_01 E-font">
        <h2>MY PROJECTS</h2>
        <div class="sub_tit_L">マイプロジェクト</div>
    </div>
    <div class="prof_page_base inner_item">
        <x-user.mypage-navigation-bar/>
        <div class="prof_page_R">
            <div class="my_new_project_wrapper">
                {{--NOTICE: MyProjectController, create action --}}
                <a href="#create" class="footer-over_L my_new_project">
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
                    <div class="img_box_02_item">
                        <div class="ib02_01 E-font my_project_img_wrapper">
                            <img src="{{ Storage::url($project->projectFiles()->where('file_content_type', 'image_url')->first()->file_url) }}">
                            {{-- NOTICE: MyProjectController, show action --}}
                            <a href="#show" class="cover_link"></a>
                        </div>

                        <div class="ib02_02">
                            ({{ $project->release_status === '---' ? '申請前' : $project->release_status }})
                        </div>

                        <div class="ib02_03">
                            <h3>{{ Str::limit($project->title, 46) }}</h3>
                            {{-- NOTICE: MyProjectController, show action--}}
                            <a href="#show" class="cover_link"></a>
                        </div>

                        <div class="pds_sec02_01_btn">
                            @if($project->release_status === '---' || $project->release_status === '差し戻し' || $project->release_status === '掲載停止中')
                            編集
                            {{-- NOTICE: MyProjectController, edit action --}}
                            <a class="cover_link" href="#edit"></a>
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
