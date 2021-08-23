<div style='min-height:85px; background: #F7FDFF;color:#00aebd;border: #00aebd; margin-bottom: 0; padding: 0.5rem'>
    <div style="font-weight: bold;">
        <p>
            @if ($guard === 'supporter')
            【{{$selectedMessage->project->user->name}}】
            @else
            【{{$selectedMessage->user->name}} 】様
            @endif
        </p>
    </div>
    <div>
        @if ($guard === 'supporter')
        <a href="{{ route('user.project.show', ['project' => $selectedMessage->project]) }}">
            {{ Str::limit($selectedMessage->project->title, 46) }}
        </a>
        @endif
    </div>

</div>
<div
    style='max-height:70vh; min-height:40vh; background-color: #fff; border: 1px solid #00aebd; margin-bottom: 1rem; padding: 0.5rem;overflow-y:scroll;'>
    <table id="scroll-inner">
        @if ($selectedMessage->messageContents->isNotEmpty())

        @foreach ($selectedMessage->messageContents as $messageContent)
        @if($messageContent->message_contributor === '支援者')
        <x-common.message.content_from_supporter :guard="$guard" :messageContent="$messageContent" />
        @elseif($messageContent->message_contributor === '実行者')
        <x-common.message.content_from_executor :guard="$guard" :messageContent="$messageContent" />
        @elseif($messageContent->message_contributor === '管理者')
        <x-common.message.content_from_admin :guard="$guard" :messageContent="$messageContent" />
        @endif
        @endforeach

        @else

        まだメッセージ履歴がありません

        @endif
    </table>
</div>

@if($guard === 'supporter')
    <form action={{route('user.message_content.store', ['payment' => $selectedMessage])}} method='post'
@elseif($guard === 'executor')
    <form action={{route('user.my_project.message_content.store', ['payment' => $selectedMessage])}} method='post'
@endif
    enctype="multipart/form-data">
    @csrf
    <x-common.add_hidden_query />
    <div style=" display: flex; justify-content: flex-end">
        <textarea name="content" cols="40" rows="4" placeholder="メッセージを送信" style="border: 1px solid #00aebd; width: 100%"
            required></textarea>
    </div>
    <div class="form-file__body">
        <input accept=".pdf, .jpg, .png" type="file" name="file_path" value="{{ old('file_path') }}">
        <br/>
        <label for="file_path">*ファイル形式は.pdf .jpg .png のいずれかになります。
        </label>
    </div>
    <div class="def_btn">
        <button type="submit" class="disable-btn">
            <p style="font-size: 1.8rem;font-weight: bold;color: #fff;">送信</p>
        </button>
    </div>

</form>


@section('css')
@stack('temporary_css')
@endsection
