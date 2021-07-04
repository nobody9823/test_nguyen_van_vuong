@extends($guard.'.layouts.base')

@section('title', "支援者コメント返信")

@section('content')

{{--エラーメッセージ--}}

{{--記事追加画面--}}
<div class="card">
    <div class="card-header">支援者コメント返信</div>
    <div class="card-body">
        <form action="{{ route($guard.'.replies_to_supporter_comment.store',[
            'supporter_comment' => $supporterComment,
            ]) }}" enctype="multipart/form-data" method="POST">
            @csrf
            {{-- デメリットがないので開発速度重視でhidden使用 --}}

            <div class="form-group">
                <label>プロジェクト名</label>
                <p>{{$supporterComment->project->title}}</p>
            </div>

            <div class="form-group">
                <label>支援者名</label>
                <p>{{$supporterComment->user->name}}</p>
            </div>

            <div class="form-group">
                <label>コメント内容</label>
                <p>{{$supporterComment->content}}</p>
            </div>

            <div class="form-group">
                <label>タレント名</label>
                <p>{{$supporterComment->project->talent->name}}</p>
            </div>

            <div class="form-group">
                <label>返信内容</label>
                <input type="text" name="content" class="form-control" value="{{ old('title') }}">
            </div>

            <button type="submit" class="btn btn-primary">返信</button>
        </form>
    </div>
</div>
@endsection
