@extends('user.layouts.base')

@section('title', 'Dashboard')

@section('content')
<div class="content">
    <div class="section">

        <x-user.mypage-navigation-bar />

        <div class="fixedcontainer mypage_contents taikai_box">
            <h2><i class="fas fa-lock"></i>支援リターン一覧</h2>

            <div class="project-list my-page_project-list">
                @foreach ($plans as $plan)

                <a class="project-one my-page_project-one" href="{{ route('user.plan.show', ['project' => $plan->project, 'plan' => $plan]) }}">
                    <div class="project-img"><img src={{Storage::url($plan->image_url)}}></div>
                    <div class="project-content">
                        <p class="project-content-ttl">
                            {{$plan->project->title}}
                        </p>
                        <div class="my-page_project_box my-page_talent_name">
                            <div class="my-page_project_tit_S"><i
                                    class="fab fa-itunes-note pri_color_f i_icon"></i>掲載タレント
                            </div>
                            <div>{{$plan->project->talent->name}}</div>
                        </div>
                        <div class="my-page_project_box my-page_my_money">
                            <div class="my-page_project_tit_S"><i class="fas fa-yen-sign pri_color_f i_icon"></i>支援金額
                            </div>
                            <div>{{$plan->price}}円</div>
                        </div>

                        <div class="my-page_project_box my-page_project-my_time">
                            <div class="my-page_project_tit_S"><i class="far fa-clock pri_color_f i_icon"></i>支援日</div>
                            <div>{{date_format($plan->pivot->created_at,'Y-m-d')}}</div>
                        </div>

                        <div class="my-page_project_box my-page_project-plan_desc">
                            <div class="my-page_project_tit_S"><i class="fas fa-sync-alt pri_color_f i_icon"></i>リターン内容
                            </div>
                            <div>{{ $plan->pivot->selected_option }}</div>
                            <div style="white-space: pre-line;">
                                {{$plan->content}}
                            </div>
                        </div>
                        <div class="my-page_project_box my-page_item_02">
                            <div class="my-page_project_tit_S"><i
                                    class="fas fa-arrow-circle-right pri_color_f i_icon"></i>ライブ開催日</div>
                            <div>{{$plan->estimated_return_date}}</div>
                        </div>
                    </div>
                    <div class="project-footer my-page_project-footer">
                        @if (($plan->project->start_date < now()) && ($plan->project->end_date > now()))
                            <div class="project-result-03">支援募集中</div>
                            @elseif($plan->estimated_return_date >= now())
                            <div class="project-result-01">リターン待ち</div>
                            @else
                            <div class="project-result-02">リターン終了</div>
                            @endif
                            <div class="my-page_money">
                                <div class="my-page_project_tit_S"><i class="fas fa-yen-sign pri_color_f i_icon"></i>総金額
                                </div>
                                <div>{{$plan->project->getAchievementAmount()}}円</div>
                            </div>
                            <div class="my-page_people">
                                <div class="my-page_project_tit_S"><i
                                        class="fas fa-hands-helping pri_color_f i_icon"></i>総支援人数
                                </div>
                                <div>{{$plan->project->getCheeringUsersCount()}}人</div>
                            </div>
                    </div>
                </a>
                @endforeach
            </div>

        </div>
    </div>
</div>
@endsection
