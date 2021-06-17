@extends($guard.'.layouts.base')

@section('title', 'メール作成')

@section('content')

<div class="card">
    <div class="card-header">メール送信</div>
    <div class="card-body">
        <form action="{{ route($guard.'.project.mail.preview_cheering_users_mail') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>送信する支援者</label>
                <ul>
                  @foreach($users as $user)
                    <li>{{ $user->name }} 様</li>
                    <input type="hidden" name="user_ids[]" value="{{ $user->id }}">
                  @endforeach
                </ul>
            </div>

            <div class="form-group">
                <label>件名</label>
                <input type="text" name="subject" class="form-control"
                  value="{{ old('subject') }}">
            </div>

            <div class="form-group">
                <label>本文</label>
                <textarea type="text" name="description" class="form-control"
                  value="{{ old('description') }}" style="height: 20rem"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">確認</button>
        </form>
    </div>
</div>
@endsection
