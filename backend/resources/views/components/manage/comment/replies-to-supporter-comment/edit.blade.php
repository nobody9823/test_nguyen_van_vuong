@extends($guard.'.layouts.base')

@section('title', "支援者コメント返信内容編集")

@section('content')

{{--記事追加画面--}}
<div class="card">
    <div class="card-header">支援者コメント返信内容編集</div>
    <div class="card-body">
        <form action="{{ route($guard.'.replies_to_supporter_comment.update', [
            'replies_to_supporter_comment' => $repliesToSupporterComment]) }}" enctype="multipart/form-data"
            method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>プロジェクト名</label>
                <p>{{$repliesToSupporterComment->supporterComment->project->title}}</p>
            </div>

            <div class="form-group">
                <label>支援者コメント内容</label>
                <p>{{$repliesToSupporterComment->supporterComment->content}}</p>
            </div>
            <div class="form-group">
                <label>返信内容</label>
                <input type="text" name="content" class="form-control"
                    value="{{ old('title',$repliesToSupporterComment->content) }}">
            </div>
            <button type="submit" class="btn btn-primary">更新</button>
        </form>
    </div>
</div>
@endsection
