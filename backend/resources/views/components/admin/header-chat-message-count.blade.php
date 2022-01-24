@if($adminMessageContentsCount() !== 0)
    <span class="chat_unread_count">
        {{ $adminMessageContentsCount() }}
    </span>
@endif
