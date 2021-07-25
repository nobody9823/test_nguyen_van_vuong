@extends('user.layouts.base')

@section('content')
<section id="Project-supporter-description" class="section_base">
    <x-user.supporter-description />
    <x-user.invitation-url :project="$project" />
    <div class="m_b_4030">
        <div class="def_btn">ランキングを見る
            <a href="{{ route('user.project.supporter_ranking', ['project' => $project]) }}" class="cover_link"></a>
        </div>
    </div>
</section><!--/.section_base-->
@endsection

@section('script')

@endsection
