@extends($role.'.layouts.base')

@php
/**
* @var \App\Models\Plan $plan
**/
@endphp

@section('title', 'プロジェクト詳細')

@section('css')
<style type="text/css">
    .media-body {
        word-break: break-word;
    }
</style>
@endsection

@section('content')
<div class="card-header d-flex align-items-center">
    <div class="flex-grow-1">プロジェクト詳細</div>
    <div class="text-right">
        @if ($role === 'admin')
        @if ($project->release_status === "承認待ち")
        <a href="{{ route($role.'.project.send_back', ['project' => $project]) }}" onclick="return confirm('差し戻ししますか？')"
            class="btn btn-warning btn-send-back">差し戻しする</a>
        <a href="{{ route($role.'.project.approved', ['project' => $project]) }}" onclick="return confirm('掲載しますか？')"
            class="btn btn-success btn-approved">掲載する</a>
        @elseif ($project->release_status === "掲載中")
        <a href="{{ route($role.'.project.under_suspension', ['project' => $project]) }}" onclick="return confirm('掲載停止しますか？')"
            class="btn btn-secondary btn-under-suspension">掲載停止する</a>
        @endif
        @elseif ($role !== 'admin')
        @if ($project->release_status === '---' || $project->release_status === "差し戻し" || $project->release_status ===
        "掲載停止中")
        <a href="{{ route($role.'.project.approval_request', ['project' => $project]) }}"
            class="btn btn-primary btn-approval-request" onclick="return confirm('認証申請を行うと編集、削除が一切できなくなります。よろしいですか？')">承認申請を行う</a>
        @endif
        @endif
        <a href="{{ route($role.'.project.index') }}" class="btn btn-outline-info">プロジェクト一覧へ戻る</a>
    </div>
</div>

<div class="card-body">
    <div class="container-fluid">
        <div class="row mb-5">
            <div class="col-sm-12">

                <div class="accordion" id="projectDetail">

                    {{--プロジェクト詳細--}}
                    <div class="card border-info">
                        <div class="card-header d-flex align-items" id="projectDetailHeader">
                            <div class="flex-grow-1">
                                <a class="btn btn-link" data-toggle="collapse" data-target="#projectDetailBody"
                                    aria-expanded="true" aria-controls="projectDetailBody">
                                    <h5 class="flex-grow-1 text-left">
                                        プロジェクト詳細▼</h5>
                                </a>
                            </div>
                            <div class="text-right">
                                <a href="{{ route('user.project_preview', compact('project')) }}"
                                    class="btn btn-success">プレビュー</a>
                                @if ($project->release_status !== '掲載中' && $project->release_status !== '承認待ち' || $role
                                === "admin")
                                <a href="{{ route($role.'.project.edit', compact('project')) }}"
                                    class="btn btn-primary">編集</a>
                                <div style="display: inline-flex">
                                    <form action="{{ route($role.'.project.destroy', compact('project')) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-dell-project" type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div id="projectDetailBody" class="collapse show" aria-labelledby="projectDetailHeader"
                            data-parent="#projectDetail">
                            <div class="card-body">
                                <div class="row p-0">
                                    <div class="col-sm-4">
                                        <div class="carousel slide" data-ride="carousel" id="carouselControl">
                                            <ol class="carousel-indicators">
                                                @for($i = 0; $i < $project->projectFiles->count(); $i++)
                                                    @if($i === 0)
                                                    <li data-target="#carouselControl" data-slide-to="{{ $i }}"
                                                        class="active"></li>
                                                    @else
                                                    <li data-target="#carouselControl" data-slide-to="{{ $i }}"></li>
                                                    @endif
                                                    @endfor
                                                    @if($project->projectVideo !== null)
                                                    <li data-target="#carouselControl"
                                                        data-slide-to="{{ $project->projectImages->count() }}"></li>
                                                    @endif
                                            </ol>
                                            <div class="carousel-inner">
                                                @foreach($project->projectFiles as $project_file)
                                                @if($loop->first)
                                                <div class="carousel-item active">
                                                    <img src="{{ asset(Storage::url($project_file->file_url)) }}"
                                                        style="max-width: 100%" class="d-block w-100">
                                                </div>
                                                @else
                                                <div class="carousel-item">
                                                    <img src="{{ asset(Storage::url($project_file->file_url)) }}"
                                                        style="max-width: 100%" class="d-block w-100">
                                                </div>
                                                @endif
                                                @endforeach
                                                @if($project->projectVideo !== null)
                                                <div class="carousel-item">
                                                    {{ DisplayVideoHelper::getVideoAtManage(optional(optional($project)->projectVideo)->video_url) }}
                                                </div>
                                                @endif
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselControl" role="button"
                                                data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselControl" role="button"
                                                data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <h3 class="font-weight-bold mb-4">{{ $project->title }}</h3>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <h3>掲載タレント : </h3>
                                                <h5 class="mb-3">{{ $project->user->name }}</h5>
                                                <h3>自己紹介・挨拶(30文字) : </h3>
                                                <h5 class="mb-3">{{ Str::limit($project->greeting_and_introduce) }}</h5>
                                                <h3>プロジェクトを立ち上げたきっかけ(30文字) : </h3>
                                                <h5 class="mb-3">{{ Str::limit($project->opportunity) }}</h5>
                                                <h3>プロジェクト説明文(30文字) : </h3>
                                                <h5 class="mb-3">{{ Str::limit($project->explanation) }}</h5>
                                                <h3>最後に(30文字) : </h3>
                                                <h5 class="mb-3">{{ Str::limit($project->finally) }}</h5>
                                            </div>
                                            <div class="col-sm-4">
                                                <h3>目標金額 : </h3>
                                                <h5 class="mb-3">
                                                    {{ number_format($project->target_number) }}人
                                                </h5>
                                                <h3>募集方式 : </h3>
                                                <h5 class="mb-3">{{ $project->funded_type }}</h5>
                                                <h3>支援者総数 : </h3>
                                                <h5 class="mb-3">{{ $project->payments_count }}人</h5>
                                                <h3>支援金総額 : </h3>
                                                <h5 class="mb-3">{{ number_format($project->payments_sum_price) }}
                                                    円</h5>
                                                <h3>目標額達成率 : </h3>
                                                <h5 class="mb-3">{{ $project->achievement_rate }}％</h5>
                                                <h3>プロジェクト終了まで : </h3>
                                                <h5 class="mb-3">{{ $project->getEndDate() }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{--リターン一覧--}}
                    <div class="card border-info">
                        <div class="card-header" id="planListHead">
                            <a class="btn btn-link" data-toggle="collapse" data-target="#planListBody"
                                aria-expanded="true" aria-controls="planListBody">
                                <h5>リターン一覧▼</h5>
                            </a>
                        </div>
                        <div id="planListBody" class="collapse" aria-labelledby="planListHead"
                            data-parent="#projectDetail">
                            <div class="card-body">
                                <div class="row">
                                    @foreach($project->plans as $plan)
                                    <div class="col-4 mb-3">
                                        <div class="card border-secondary" style="border-width: thick">
                                            <img src="{{ asset(Storage::url($plan->image_url)) }}"
                                                class="mx-auto d-block" style="max-width: 70%">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item d-flex">
                                                    <h5 class="font-weight-bold mb-1 flex-grow-1">{{ $plan->title }}
                                                    </h5>
                                                    @if ($project->release_status !== '掲載中' && $project->release_status
                                                    !== '承認待ち' || $role === "admin")
                                                    <div class="text-right">
                                                        <a href="{{ route($role.'.plan.edit', compact('project', 'plan')) }}"
                                                            class="btn btn-primary">編集</a>
                                                    </div>
                                                    @endif
                                                </li>
                                                <li class="list-group-item">
                                                    <h6 class="font-weight-bold mb-2">価格</h6>
                                                    {{ number_format( $plan->price) }}円(税込)
                                                </li>
                                                <li class="list-group-item">
                                                    <h6 class="font-weight-bold mb-2">
                                                        リターン内容</h6>
                                                        <p class="plan-content">{{ $plan->content }}</p>
                                                </li>
                                                <li class="list-group-item">
                                                    <h6 class="font-weight-bold mb-2">お返し予定日</h6>
                                                    {{ $plan->estimated_return_date }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--活動報告一覧--}}
                    <div class="card border-info">
                        <div class="card-header d-flex align-items" id="activityReportHeader">
                            <a class="btn btn-link" data-toggle="collapse" data-target="#activityReportBody"
                                aria-expanded="true" aria-controls="activityReportBody">
                                <h5 class="flex-grow-1">活動報告▼</h5>
                            </a>
                            <div class="text-right">
                            </div>
                        </div>
                        <div id="activityReportBody" class="collapse" aria-labelledby="activityReportHeader"
                            data-parent="#projectDetail">
                            <div class="card-body">
                                @foreach($project->reports as $report)
                                <div class="row p-1 mb-1 border-secondary border" style="border-width: thick">
                                    <div class="col-sm-4">
                                        <div class="carousel slide" data-ride="carousel" id="carouselControl">
                                            <ol class="carousel-indicators">
                                                @for($i = 0; $i < $project->reports->count(); $i++)
                                                    @if($i === 0)
                                                    <li data-target="#carouselControl" data-slide-to="{{ $i }}"
                                                        class="active"></li>
                                                    @else
                                                    <li data-target="#carouselControl" data-slide-to="{{ $i }}"></li>
                                                    @endif
                                                    @endfor
                                            </ol>
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img src="{{ asset(Storage::url($report->image_url)) }}"
                                                        style="max-width: 100%" class="d-block w-100">
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselControl" role="button"
                                                data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselControl" role="button"
                                                data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="d-flex">
                                            <h3 class="font-weight-bold mb-4 flex-grow-1">{{ $report->title }}</h3>
                                            <div class="text-right">
                                                <a href="{{ route($role.'.report.edit', ['project' => $project, 'report' => $report]) }}"
                                                    class="btn btn-primary">編集</a>
                                                <div style="display: inline-flex">
                                                    {{--FIXME 削除ボタン上手く動かないから誰か直して、あとプロジェクト詳細に戻したいからメソッド分けるかメソッド内で分岐がいる--}}
                                                    <form
                                                        action="{{ route($role.'.report.destroy', ['project' => $project, 'report' => $report]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-dell-activity-report" onclick="return confirm('本当に削除しますか？')"
                                                            type="submit">削除
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <h4>報告内容: </h4>
                                        <h5 class="mb-3">{{ $report->content }}</h5>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{--支援者一覧--}}
                    <div class="card border-info">
                        <div class="card-header flex-grow-1" id="cheeringUsersListHeader">
                            <a class="btn btn-link" data-toggle="collapse" data-target="#cheeringUsersListBody"
                                aria-expanded="true" aria-controls="cheeringUsersListBody">
                                <h5 class="flex-grow-1">支援者一覧▼</h5>
                            </a>
                        </div>
                        <div id="cheeringUsersListBody" class="collapse" aria-labelledby="cheeringUsersListHeader"
                            data-parent="#projectDetail">
                            <div class="card-body">
                                <form
                                    action="{{ route($role.'.project.mail.create_cheering_users_mail', ['project' => $project]) }}"
                                    method="get">
                                    @csrf
                                    <button type="submit" id="btn-send-cheering-users"
                                        class="btn btn-warning">メール送信</button>
                                    <div class="form-inline">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="allChecked" id="all" style="margin: 1em;">
                                            全選択
                                        </label>
                                    </div>


                                    <table class="table checkbox-judge">
                                        <tr>
                                            <th>名前</th>
                                            <th>メールアドレス</th>
                                            <th>支援リターン</th>
                                            <th>支援額</th>
                                            <th>支援日</th>
                                            <th>お返し予定日</th>
                                            <th>住所</th>
                                        </tr>
                                        {{--クソみたいな感じになってしまいました、誰か解決法を鯉沼に教えてください。宜しくお願い致します。--}}
                                        @foreach($project->plans as $plan)
                                        @foreach($plan->getSupportedUsers() as $user)
                                        <tr>
                                            <td class="form-inline">
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="user_ids[]" value="{{ $user->id }}"
                                                        style="margin-right: 1em;">
                                                    {{ $user->name }}
                                                </label>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $plan->title }}</td>
                                            <td>{{ number_format($plan->price) }}円(税込)</td>
                                            <td>{{ date_format($user->created_at, "Y-m-d") }}</td>
                                            <td>{{ $plan->formatted_delivery_date }}</td>
                                            <td>{{ $user->address->prefecture.$user->address->city.$user->address->block.$user->address->building }}
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endforeach
                                    </table>
                                </form>
                                {{-- こちらエラーになってしまうので一旦コメントアウトにしております。 --}}
                                {{-- <a href="{{ route($role.'.project.output_cheering_users_to_csv', compact('project')) }}"
                                class="btn btn-secondary" type="submit" >支援者一覧をCSV出力</a> --}}
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
