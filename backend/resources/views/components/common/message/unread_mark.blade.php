{{-- 既読していないときに親要素の右上に赤点が配置される
    親要素には、classで unread_mark_parent とつけること --}}
@if($guard === 'admin')
    @if ($message->adminMessageContents()->checkRead($guard) && $message->admin_message_contents_count !== 0)
        <span class="chat_unread_count">
            {{ $message->admin_message_contents_count }}
        </span>
    @endif
@else
    @if ($message->messageContents()->checkRead($guard) && $message->message_contents_count !== 0)
        <span class="chat_unread_count">
            {{ $message->message_contents_count }}
        </span>
    @endif
@endif

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
