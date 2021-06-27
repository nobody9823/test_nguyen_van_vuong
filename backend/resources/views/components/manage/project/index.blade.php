@extends($role.'.layouts.base')

@section('title', 'プロジェクト一覧')

<!-- 公開非公開ボタン -->
@section('css')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/bootstrap-multiselect.min.css') }}">
<script src="{{ asset('js/bootstrap-multiselect.min.js') }}"></script>
@endsection

@section('content')
<!-- エラーや操作完了のメッセージ -->
<div class="card-header d-flex align-items-center">
    <div class="flex-grow-1">プロジェクト一覧</div>
        <form action="{{ route($role.'.project.search') }}" class="form-inline pr-3" method="get" style="position: relative">
            @csrf
            <p>
                <a class="btn btn-secondary mt-3 mr-3" data-toggle="collapse" href="#collapseExample" role="button"
                    aria-expanded="false" aria-controls="collapseExample">
                    詳細条件 ▼
                </a>
            </p>
            <div class="collapse" id="collapseExample" style="position: absolute; top: 55px; left: -10px;">
                <div class="card card-body">
                    <div class="form-group mb-2 flex-column">
                        @foreach(ProjectReleaseStatus::getValues() as $release_status)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $release_status }}" name="release_statuses[]" id="flexCheckDefault" {{ Request::get('release_statuses') !== null && in_array($release_status, Request::get('release_statuses')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexCheckDefault">
                                {{ $release_status }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <input name="word" type="search" class="form-control" aria-lavel="Search" placeholder="キーワードで検索" value="{{ Request::get('word') }}">
            <button class="btn btn-primary my-2 my-sm-0" type="submit">検索</button>
        </form>
    <div class="text-right">
        <a href="{{ route($role.'.project.create') }}" class="btn btn-outline-success">新規作成</a>
    </div>
</div>
@if(Request::get('word'))
<div class="card-header d-flex align-items-center">
    <div class="flex-grow-1">{{Request::get('word')}} の検索結果(全{{count($projects)}}件)</div>
</div>
@endif
<div class="card-body">
    @if($projects->count() <= 0) <p>表示する投稿はありません。</p>
        @else
        <table class="table">
            <tr>
                <th style="width:10%">タイトル</th>
                <th style="width:10%">ユーザー名</th>
                <th style="width:10%">プロジェクト詳細</th>
                <th style="width:10%">プレビュー</th>
                <th style="width: 20%">その他一覧</th>
                <th style="width:10%">編集/削除</th>
                @if($role === "admin")
                <th style="width:10%; text-align:center;">いいね数</th>
                @endif
                <th style="width: 10%">掲載状態</th>
            </tr>
            @foreach($projects as $project)
            <tr>
                <td>
                    {{ $project->title }}
                </td>
                <td>{{ $project->user->name }}</td>
                <td>
                    <a href="{{ route($role.'.project.show', ['project' => $project]) }}" class="btn btn-primary">確認</a>
                </td>
                <td>
                    <a href="{{ route($role.'.project.preview', ['project' => $project] )}}"
                        class="btn btn-success">表示</a>
                </td>
                <td>
                    <a href="{{ route($role.'.plan.search', ['project' => $project]) }}" class="btn btn-success mb-2">プラン一覧</a>

                    <a href="{{ route($role.'.report.search', ['project' => $project] )}}"
                        class="btn btn-primary mb-2">活動報告一覧</a>

                    <a href="{{ route($role.'.supporter_comment.search', ['project_id' => $project->id] )}}"
                        class="btn btn-primary">コメント一覧</a>
                </td>

                <td>
                    @if ($project->release_status !== '掲載中' && $project->release_status !== '承認待ち' || $role === "admin")
                    <a href="{{ route($role.'.project.edit', ['project' => $project]) }}"
                        class="btn btn-primary mb-2">編集</a>
                    <form action="{{ route($role.'.project.destroy', ['project' => $project]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-dell" type="submit">削除</button>
                    @endif
                </td>
                </form>
                <td>
                    <div class="d-flex flex-column justify-content-center">
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-sm btn-danger" type="button" onClick="decrementLikes({{$project->id}}, 1)">- 1</button>
                            <button class="btn btn-sm btn-primary" type="button" onClick="incrementLikes({{$project->id}}, 1)">+ 1</button>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-sm btn-danger" type="button" onClick="decrementLikes({{$project->id}}, 10)">- 10</button>
                            <button class="btn btn-sm btn-primary" type="button" onClick="incrementLikes({{$project->id}}, 10)">+ 10</button>
                        </div>
                        <div class="d-flex justify-content-center">
                            <p>
                                <img src="/image/liked-icon.png">
                            </p>
                            <p id="total_likes_{{ $project->id }}">
                                {{ $project->total_likes }}
                            </p>
                        </div>
                    </div>
                </td>
                <td>
                    @if ($project->release_status === "---")
                        <div class="card border-primary mb-3 text-center">
                            <div class="card-header bg-transparent border-primary">---</div>
                        </div>
                    @elseif ($project->release_status === "差し戻し")
                        <div class="card border-warning mb-3 text-center">
                            <div class="card-header bg-transparent border-warning">差し戻し</div>
                        </div>
                    @elseif ($project->release_status === "承認待ち")
                        <div class="card border-info mb-3 text-center">
                            <div class="card-header bg-transparent border-info">承認待ち</div>
                        </div>
                    @elseif ($project->release_status === "掲載中")
                        <div class="card border-success mb-3 text-center">
                            <div class="card-header bg-transparent border-success">掲載中</div>
                        </div>
                    @elseif ($project->release_status === "掲載停止中")
                        <div class="card border-secondary mb-3 text-center">
                            <div class="card-header bg-transparent border-secondary">掲載停止中</div>
                        </div>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
        <div class="d-flex justify-content-center">
            {{ $projects->appends(request()->input())->links() }}
        </div>
        @endif
</div>
@section('script')
<script>
    $(function(){
    $(".btn-dell").click(function(){
    if(confirm("本当に削除しますか？")){
    //そのままsubmit（削除）
    }else{
    //cancel
    return false;
    }
    });
    });
</script>
<script>
    function incrementLikes(projectId, incrementPoints){
        $.ajax({
            url: '/admin/project/' + projectId + '/increment_likes/',
            type: 'PATCH',
            data: {'project': projectId, 'add_point': incrementPoints},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        })
        .done(function(res) {
            document.getElementById('total_likes_' + projectId).innerText = res.total_likes;
        })
        .fail(function(res) {
            if (res.responseJSON.errors) {
                alert(
                    res.responseJSON.status
                    + "\n" +
                    res.responseJSON.errors.add_point
                );
            } else {
                alert("エラーが発生しました。");
            }
            location.reload();
        });
    }
    function decrementLikes(projectId, decrementPoints){
        $.ajax({
            url: '/admin/project/' + projectId + '/decrement_likes/',
            type: 'PATCH',
            data: {'project': projectId, 'sub_point': decrementPoints},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        })
        .done(function(res) {
            document.getElementById('total_likes_' + projectId).innerText = res.total_likes;
        })
        .fail(function(res) {
            if (res.responseJSON.errors) {
                alert(
                    res.responseJSON.status
                    + "\n" +
                    res.responseJSON.errors.sub_point
                );
            } else {
                alert("エラーが発生しました。");
            }
            location.reload();
        });
    }
</script>
@endsection
@endsection
