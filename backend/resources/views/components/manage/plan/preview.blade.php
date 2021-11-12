@extends('user.layouts.base')

@section('content')
<div class="content sub_content detail_content">
    <div class="fixedcontainer">
        <div class="breadcrumb">
            <p><a href="/">TOP</a>　＞　<a href="/search">応援プロジェクト</a>　＞　<a href="">セクハラ</a>　＞　{{ $project->title }}　＞　{{ $plan->title }}</p>
        </div>
            <h2 class="sec-ttl">{{ $plan->title }}</h2>
            <div class="project-user detail-user"><img src="{{ Storage::url($project->talent->image_url) }}">{{ $project->talent->name }}</div>
            <div class="detail_info">
                <div class="detail_imgs">
                    <div class="detail-slider-for">
                            <div><img src="{{ Storage::url($plan->image_url) }}"></div>
                    </div>
                </div>
                <div class="detail_info_content">
                    <p>価格</p>
                    <div><span>{{ $plan->price }}</span>円(税込)</div>
                    <p>目標人数 {{ number_format($project->target_number) }}人</p>

                    <p style="white-space: pre-line;">詳細<br>{!! $plan->content !!}</p>
                    <p>支援状況</p>
                    <div><span>{{ count($plan->users) }}人</span></div>
                    <p>お返しお届け予定日</p>
                    <div>
                        {{ $plan->estimated_return_date }}
                    </div>
                    <p>アイドル</p>
                    <div class="project-user detail-user">
                      <img src="{{ Storage::url($project->talent->image_url) }}">
                        {{ $project->talent->name }}
                    </div>
                    <div class="plan-btn-wrap"><a class="plan-btn" href="{{ route('user.plan.address', ['project' => $project, 'plan' => $plan]) }}">決済画面へ</a>
                </div>
            </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('/js/pointer-events.js') }}"></script>
@endsection
