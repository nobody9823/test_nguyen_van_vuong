@extends($guard.'.layouts.base')

@section('title', '送信内容確認')

@section('content')
<div class="card">
    <div class="card-header">送信内容の確認</div>
    <div class="card-body">
        <form action="{{ route($guard.'.project.mail.send_cheering_users_mail') }}" method="post">
            @csrf
            <p>送信先</p>
            <ul>
              @foreach($users as $user)
                <li>{{ $user->name }} 様</li>
                <input type="hidden" name="user_ids[]" value="{{ $user->id }}">
              @endforeach
            </ul>
            <h4>件名:</h4>
            <p style="padding-left: 10px;">
              {{ $subject }}
              <input type="hidden" name="subject" value="{{ $subject }}">
            </p>
            <h4>本文</h4>
            <p style="padding-left: 10px; white-space: pre-line;">
              {{ $description }}
              <input type="hidden" name="description" value="{{ $description }}">
            </p>
            <button id="btn-send-mail" type="submit" class="btn btn-primary">送信</button>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function () {
        $("#btn-send-mail").click(function () {
            if (confirm("本当に送信しますか？")) {
                //そのままsubmit（送信）
            } else {
                //cancel
                return false;
            }
        });
    });
</script>
@endsection
