<div class="a_comment">
    <div class="comment_row" style="{{ isset($comment->reply) ? 'border-bottom: none;' : '' }}">
        @if(isset($comment->user->profile))
        <img src="{{ Storage::url(optional($comment->user->profile)->image_url) }}" alt="プロフィール画像" class="user_image">
        @else
        <img src="{{ asset('sampleImage/my-page.svg') }} alt="プロフィール画像" class="user_image">
        @endif
        <div class="comment_content">
            <div class="comment_content_user">
                <span>{{ $comment->user->name }}&emsp;</span>
                <span>{{ $comment->created_at->format('Y年m月d日 H:m') }}</span>
            </div>
            <div class="comment_content_text">
                {{ $comment->content }}
            </div>
        </div>
    </div>

    @if ($comment->reply)
        <div class="comment_row">
            <img src="{{ Storage::url(optional($comment->project->user)->profile->image_url) }}" alt="プロフィール画像"
                class="user_image reply_user">
            <div class="comment_content reply_content">
                <div class="comment_content_user">
                    <span>{{ $comment->project->user->name }}&emsp;</span>
                    <span>{{ $comment->reply->created_at->format('Y年m月d日 H:m') }}</span>
                </div>
                <div class="comment_content_text">
                {{ $comment->reply->content }}
                </div>
            </div>
        </div>
    @endif

</div>
