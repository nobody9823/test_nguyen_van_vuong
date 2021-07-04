@php
use Carbon\Carbon;
@endphp

@extends('user.layouts.base')

@section('content')
{{--エラーメッセージ--}}
@if ($errors->any())
<div class="error_message text-center">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<x-user.project.show :project="$project" :inviterCode="$inviter_code" />
@endsection

@section('script')
<script>
$(function() {
    // 支援者コメントのいいね登録・解除処理
    $('.liked').click(function() {
        var el = $(this);
        var commentId = el.attr('id');

        el.append('<meta name="csrf-token" content="{{ csrf_token() }}">');

        $.ajax({
            url: '/supporter_comment/' + commentId + '/liked',
            type: 'POST',
            data: {'id': commentId },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(msg) {
                if (msg === 'success') {
                        var likedCount = Number(el.next('div').text());
                        likedCount += 1;
                        el.next('div').text(likedCount);
                        console.log(el.children('img').attr('src', '/image/liked-icon.png'));
                    } else if(msg === 'canceled') {
                        var likedCount = Number(el.next('div').text());
                        likedCount -= 1;
                        el.next('div').text(likedCount);
                        console.log(el.children('img').attr('src', '/image/like-icon.png'));
                    } else if(msg === 'myself') {
                        alert("自身のコメントにはいいね出来ません。");
                    } else {
                        alert("エラーが起こりました。");
                    }
            }
        })
        .fail(function() {
            alert("エラーが起こりました。");
        });
    });

    // プロジェクトのお気に入り登録・解除処理
    $('.liked_project').on('click', function() {
        var el = $(this);
        var projectId = el.attr('id');

        el.append('<meta name="csrf-token" content="{{ csrf_token() }}">');

        $.ajax({
            url: '/project/'+ projectId + '/liked',
            type: 'POST',
            data: {'project_id': projectId },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        })
        .then((res) => {
            console.log(res);
            if(res == "登録"){
                el.children('img').attr('src', '/image/liked-project-button.png');
            } else if(res == "削除"){
                el.children('img').attr('src', '/image/like-project-button.png');
            } else if (res == "未ログイン") {
                alert("ログインしてください");
            } else {
                alert("エラーが起こりました。");
            }
        })
        .fail((error)=>{
            console.log("エラーが起こりました。")
        })
    });
});
</script>
@endsection
