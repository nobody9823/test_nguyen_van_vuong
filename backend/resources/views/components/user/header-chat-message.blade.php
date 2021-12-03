@auth('web')
<a href="{{ route('user.message.index') }}" class="header_message_icon">
    <i class="far fa-envelope"></i>
    @if($messageContentsCount() !== 0)
    <span class="chat_unread_count">
        {{ $messageContentsCount() }}
    </span>
    @endif
</a>
@endauth
