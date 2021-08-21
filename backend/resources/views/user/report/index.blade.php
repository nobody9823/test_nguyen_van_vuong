@extends('user.layouts.base')

@section('title', '活動報告一覧')

@section('content')
<section id="supported-projects" class="section_base">

    <div class="tit_L_01 E-font">
        <h2>REPORTS</h2>
        <div class="sub_tit_L">活動報告一覧</div>
    </div>

    <div class="prof_page_base inner_item">
        <div class="prof_page_L">
            <x-user.mypage-navigation-bar/>
        </div><!--/prof_page_L-->

        <div class="prof_page_R">
          @if($reports)
            @foreach($reports as $key => $report)

            @endforeach
          @endif
        </div>
    </div>
</section>
@endsection