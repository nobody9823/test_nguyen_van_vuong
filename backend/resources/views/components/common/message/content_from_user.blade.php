{{--
    ユーザー送信メッセージ用コンポーネント
    $messageContent
    $guard
    を注入
--}}

<div class="chat_content"
    style="border-bottom: 2px solid #EEE;padding: 0.5rem 0.5rem;margin-left: 0rem;margin-bottom: 3px;">
    <div style="font-weight: bold;display:flex;justify-content:space-between;">
        <div>
            <img class="contributor-icon" src="{{asset(Storage::url($messageContent->user->profile->image_url))}}"
                style="float:left;margin-right: 0.5rem;width: 25px;height: 25px;">
            {{-- ガードがuserなら'あなた'表記 ちょっと冗長--}}
            @if ($guard === 'user')
            あなた:
            @else
            {{$messageContent->user->name}}:
            @endif
            {{-- ガードがuserなら'あなた'表記 --}}
            <span style="font-weight: normal;color: gray;font-size: 80%;">{{$messageContent->created_at}}</span>
        </div>
        {{-- @if ($guard === 'admin')
        <div class="icons">
            <x-admin.message.change_message_content_modal :messageContent="$messageContent" />
            <x-admin.message.delete_message_content :messageContent="$messageContent" />
        </div>
        @endif --}}
    </div>

    <div style="clear:both;min-height:30px;padding-top: 0.5rem;padding-left: 0.5rem;">
        <span style="white-space: pre-wrap">{{$messageContent->content}}</span>
    </div>
    @if (isset($messageContent->file_path))
    <x-common.message.file_download_button :guard="$guard" :messageContent="$messageContent" />
    @endif
</div>

@once

<style>
    .chat_content:hover div.icons img {
        opacity: 0.5;
    }

    .contributor-icon {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 50%;
    }
</style>
@endonce
