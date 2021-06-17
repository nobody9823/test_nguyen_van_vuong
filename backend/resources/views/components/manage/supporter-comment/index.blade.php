@extends($guard.'.layouts.base')

@section('title', '支援者コメント一覧')

@section('content')
<div class="card-header d-flex align-items-center">
    <div class="flex-grow-1">支援者コメント一覧</div>
    <form action={{route($guard.'.supporter_comment.search')}} class="form-inline pr-3" method="get" style="position: relative;">
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
                    <div class="form-check flex-column">
                        <label>
                            投稿日
                        </label>
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{ Request::get('from_date') }}" name="from_date" id="from_date">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">日から</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{ Request::get('to_date') }}" name="to_date" id="to_date">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">日まで</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input name="word" type="search" class="form-control" aria-lavel="Search" placeholder="キーワードで検索" value="{{ Request::get('word') }}">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">検索</button>
    </form>
</div>
@if(Request::get('word'))
<div class="card-header d-flex align-items-center">
    <div class="flex-grow-1">検索キーワード : {{ Request::get('word') }}</div>
</div>
@endif
<div class="card-body">
    @if($supporterComments->count() <= 0) <p>表示する投稿はありません。</p>
        @else
        <table class="table">
            <tr>
                <th style="width:10%">投稿日</th>
                <th style="width:20%">内容</th>
                <th style="width:10%">ユーザ名</th>
                <th style="width:10%">プロジェクト名</th>
                <th style="width:10%">タレント名</th>
                <th style="width:20%">タレントの返信</th>
                <th style="width:10%">返信を編集</th>
                <th style="width:10%">返信を削除</th>
            </tr>
            @foreach($supporterComments as $supporter_comment)
            <tr>
                <td>
                    {{ $supporter_comment->created_at }}
                </td>
                <td>
                    <p>{{ Str::limit($supporter_comment->content, 200) }}</p>
                </td>
                <td>
                    {{ $supporter_comment->user->name }}
                </td>
                <td>
                    {{ $supporter_comment->project->title }}
                </td>
                <td>
                    {{ $supporter_comment->project->talent->name }}
                </td>
                <td>
                    {{-- 返信あり→それを表示
                    返信なし→返信ボタン追加、編集ボタンdisabled --}}
                    @if ($supporter_comment->repliesToSupporterComment)
                    <p>{{$supporter_comment->repliesToSupporterComment->content}}</p>
                </td>
                <td>
                    <a href=" {{ route($guard.'.replies_to_supporter_comment.edit', [
                        'replies_to_supporter_comment' => $supporter_comment->repliesToSupporterComment,
                        ]) }} " class="btn btn-success">編集</a>
                </td>
                <td>
                    <form action="{{ route($guard.'.replies_to_supporter_comment.destroy', [
                            'replies_to_supporter_comment' => $supporter_comment->repliesToSupporterComment,]) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-dell" type="submit">削除</button>
                    </form>
                </td>


                @else
                <p>未返信</p>
                <a href=" {{ route($guard.'.replies_to_supporter_comment.create', [
                        'supporter_comment' => $supporter_comment,
                        ]) }} " class="btn btn-primary btn-sm">返信する
                </a>
                </td>
                <td>
                    <a href="#" class="btn btn-success disabled">編集</a>
                </td>
                <td>
                    <a href="#" class="btn btn-danger disabled">削除</a>
                </td>

                @endif

            </tr>
            @endforeach
        </table>
        <div class="d-flex justify-content-center">
            {{ $supporterComments->appends(request()->input())->links() }}
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
<script src="https://cdn.jsdelivr.net/npm/jquery-datetimepicker@2.5.20/build/jquery.datetimepicker.full.min.js">
</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-datetimepicker@2.5.20/jquery.datetimepicker.css">
<script>
    $(function () {
        $('#from_date').datetimepicker({
            format: 'Y-m-d H:i'
        });
        $('#to_date').datetimepicker({
            format: 'Y-m-d H:i'
        });
    });
</script>
@endsection

@endsection
