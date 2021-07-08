@extends($guard.'.layouts.base')

@section('title', 'コメント管理')

@section('content')
<div class="card-header d-flex align-items-center">
    <div class="flex-grow-1">コメント管理</div>
    <form action={{route($guard.'.comment.index')}} class="form-inline pr-3" method="get" style="position: relative;">
        @csrf
        <x-common.add_hidden_query />
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
                            <input type="text" class="form-control" value="{{ Request::get('from_date') }}"
                                name="from_date" id="from_date">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">日から</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{ Request::get('to_date') }}" name="to_date"
                                id="to_date">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">日まで</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input name="word" type="search" class="form-control" aria-lavel="Search" placeholder="キーワードで検索"
            value="{{ Request::get('word') }}">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">検索</button>
    </form>
</div>
@if(Request::get('word'))
<div class="card-header d-flex align-items-center">
    <div class="flex-grow-1">検索キーワード : {{ Request::get('word') }}</div>
</div>
@endif
<div class="card-body">
    @if($comments->count() <= 0) <p>表示する投稿はありません。</p>
        @else
        <table class="table">
            <tr>
                <th style="width:10%">投稿日</th>
                <th style="width:20%">内容</th>
                <th style="width:10%">ユーザ名</th>
                <th style="width:10%">プロジェクトID</th>
                <th style="width:10%">タレント名</th>
                <th style="width:20%">タレントの返信</th>
                <th style="width:10%">返信/編集/削除</th>
            </tr>
            @foreach($comments as $comment)
            <tr>
                <td>
                    {{ $comment->created_at }}
                </td>
                <td>
                    <p>{{ Str::limit($comment->content, 200) }}</p>
                </td>
                <td>
                    {{ $comment->payment->user->name }}
                </td>
                <td>
                    {{ $comment->project->display_id }}
                </td>
                <td>
                    {{ $comment->project->user->name }}
                </td>
                <td>
                    {{-- 返信あり→それを表示
                    返信なし→返信ボタン追加、編集ボタンdisabled --}}
                    @if ($comment->reply)
                    <p>{{$comment->reply->content}}</p>
                    @else
                    <p style='color:red'>未返信</p>
                    @endif
                </td>
                <td>
                    <button class="btn btn-secondary" type="button" data-toggle="collapse"
                        data-target="#collapseExample{{ $comment->id }}" aria-expanded="true"
                        aria-controls="collapseExample">
                        操作 ▼
                    </button>
                    <div class="collapse {{ $loop->index === 0?'show':null }}" id="collapseExample{{$comment->id}}">
                        <div class="card" style="border: none; background-color: #f8f9fa;">
                            @if(!$comment->reply)
                            <a class="btn btn-sm btn-success mt-1" data-toggle="modal"
                                data-target="#comment_create{{ $comment->id }}">
                                返信する
                            </a>
                            <div class="modal fade" id="comment_create{{ $comment->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="reply_create_modal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="reply_create_modal">
                                                {{ $comment->payment->user->name }}様への返信編集
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route($guard.'.reply.store',['comment' => $comment]) }}"
                                                method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1">内容</label>
                                                    <input type="text" name="content" class="form-control"
                                                        id="exampleFormControlInput1" value="{{ old('content') }}"
                                                        required>
                                                    <button type="submit"
                                                        class="btn btn-sm btn-primary mt-1">送信</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @else
                            <a class="btn btn-sm btn-primary mt-1" data-toggle="modal"
                                data-target="#comment_edit{{ $comment->id }}">編集</a>
                            <form action="{{ route($guard.'.reply.destroy', ['reply' => $comment->reply]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger mt-1 w-100 btn-dell" type="submit">削除</button>
                            </form>
                            <div class="modal fade" id="comment_edit{{ $comment->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="comment_edit_modal" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="comment_edit_modal">
                                                {{ $comment->payment->user->name }}様への返信編集
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form
                                                action="{{ route($guard.'.reply.update',['reply' => $comment->reply]) }}"
                                                method="POST">
                                                @csrf
                                                @method('put')
                                                <div class="form-group">
                                                    <label for="exampleFormControlInput1">内容</label>
                                                    <input type="text" name="content" class="form-control"
                                                        id="exampleFormControlInput1"
                                                        value="{{ old('content', $comment->reply->content) }}" required>
                                                    <button type="submit"
                                                        class="btn btn-sm btn-primary mt-1">更新</button>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                </td>

            </tr>
            @endforeach
        </table>
        <div class="d-flex justify-content-center">
            {{ $comments->appends(request()->input())->links() }}
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
