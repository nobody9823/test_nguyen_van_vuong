{{-- {{ dd($selectedPlan) }} --}}
<div style='min-height:85px; background: #0f103f; color: white;border: black; margin-bottom: 0; padding: 0.5rem'>
    <div style="font-weight: bold;">
        <p style="color: white;">
            【{{$selectedPlan->plan->project->talent->name}} 】</p>
    </div>
    <div>
        <a style="color: white;"
            href="{{ route('user.plan.show', ['project' => $selectedPlan->plan->project,'plan' => $selectedPlan->plan]) }}">
            {{$selectedPlan->plan->title}}</a>
    </div>
</div>
<div
    style='height:600px; background: #f8f9fa; border: #6c757d; margin-bottom: 1rem; padding: 0.5rem;overflow-y:scroll;'>
    <table id="scroll-inner">
        @if ($selectedPlan->messageContents->isNotEmpty())

        @foreach ($selectedPlan->messageContents as $messageContent)
        @if($messageContent->message_contributor === '支援者')
        <x-common.message.content_from_user guard="user" :messageContent="$messageContent" />
        @elseif($messageContent->message_contributor === 'タレント')
        <x-common.message.content_from_talent guard="user" :messageContent="$messageContent" />
        @elseif($messageContent->message_contributor === '管理者')
        <x-common.message.content_from_admin guard="user" :messageContent="$messageContent" />
        @endif
        @endforeach

        @else
        まだダイレクトメッセージがありません
        @endif


    </table>
</div>
<form action={{route('user.message_content.store',['user_plan_cheering' => $selectedPlan])}} method='post'
    enctype="multipart/form-data">
    @csrf
    @if (Request::get('word'))
    <input type="hidden" name='word' value={{ Request::get('word') }}>
    @endif
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

<script type="text/javascript">
    let target = document.getElementById('scroll-inner');
    target.scrollIntoView(false);
</script>

@section('mypage_css')
@stack('temporary_css')
@endsection
