{{-- 既読していないときに親要素の右上に赤点が配置される
    親要素には、classで unread_mark_parent とつけること --}}
@switch($guard)
@case('executor')
@if ($message->messageContents()->checkReadByExecutor())
<span class="chat_unread_count">
    {{ $message->message_contents_count }}
</span>
@endif
@break
@case('supporter')
@if ($message->messageContents()->checkReadBySupporter())
<span class="chat_unread_count">
    {{ $message->message_contents_count }}
</span>
@endif
@break
@default
@endswitch

<style>
    .unread_mark_parent {
        position: relative;
    }

    .unread_mark_parent span {
        position: absolute;
        right: 0;
        top: 5%;
    }
</style>
