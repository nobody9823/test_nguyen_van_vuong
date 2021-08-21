<div style='min-height:85px; background: #ddd;border: black; margin-bottom: 0; padding: 0.5rem'>
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
        {{$selectedMessage->project->title}}
        @else
        <a href="{{ route('user.project.show', ['project' => $selectedMessage->project]) }}">
            {{$selectedMessage->project->title}}</a>
        @endif
    </div>

</div>
<div
    style='max-height:70vh; min-height:40vh; background-color: #f8f9fa; border: #6c757d; margin-bottom: 1rem; padding: 0.5rem;overflow-y:scroll;'>
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
@endif
    enctype="multipart/form-data">
    @csrf
    <x-common.add_hidden_query />
    <div style=" display: flex; justify-content: flex-end">
        <textarea name="content" cols="40" rows="4" placeholder="メッセージを送信" style='width:100%;height:100px'
            required></textarea>
        <input class="btn btn-info" type="submit" value='送信'>
    </div>
    <div class="form-file__body">
        <input accept=".pdf, .jpg, .png" type="file" name="file_path" value="{{ old('file_path') }}">
        <label for="file_path">*ファイル形式は.pdf .jpg .png のいずれかになります。
        </label>
    </div>

</form>


@section('css')
@stack('temporary_css')
@endsection
