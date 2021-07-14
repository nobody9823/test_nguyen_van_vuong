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
            <div class="img_box_02">
                @foreach($projects as $project)
                <div class="img_box_02_item">
                    <div class="ib02_01 E-font">
                        <img src="{{ Storage::url($project->projectFiles()->where('file_content_type', 'image_url')->first()->file_url) }}">
                        <a href="{{ route('user.project.show', ['project' => $project]) }}" class="cover_link"></a>
                    </div>

                    <div class="ib02_02">
                        <div class="ib02_03">
                            <h3>{{ Str::limit($project->title, 46) }}</h3>
                            <a href="{{ route('user.project.show', ['project' => $project]) }}" class="cover_link"></a>
                        </div>

                        <div class="ib02_04">
                            <div>現在 <span>{{ number_format($project->payments_sum_price) }}円</span></div>
                            <div>残り <span>{{ Carbon\Carbon::now()->diffInDays(new Carbon\Carbon($project->end_date)) }}日</span></div>
                        </div>
                    </div><!--/.img_box_01_L_item-->
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
