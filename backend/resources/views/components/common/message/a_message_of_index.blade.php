<div id='hovering-grey' class="chat_group" onclick="form_submit(this)"
    style='font-size: 1.4rem;font-weight: bold;cursor: pointer;min-height:90px;border: 0;border-bottom: 1px solid #00aebd;color:#707070;padding: 0.5rem;background-color:{{ $message->id === optional($selectedMessage)->id ? "#F7FDFF":'#fff' }};'
    @if($guard === 'supporter')
        data-href={{route('user.message.show', ['payment' => $message])}}
    @elseif($guard === 'executor')
        data-href={{route('user.my_project.message.show', ['payment' => $message])}}
    @endif
    >
    <div class="unread_mark_parent">
        <x-common.message.unread_mark :guard="$guard" :message="$message" />
        {{$message->updated_at->format('Y/m/d H:i:s')}}<br>
        【{{Str::limit($message->project->title,40)}}】
    </div>
    <div>
        【{{$message->project->user->name}}】
        【{{$message->user->name}}】
    </div>
</div>

@once
<script>
    function form_submit(target) {
        window.document.forms['form_to_keep_request'].action = target.getAttribute('data-href');
        window.document.forms['form_to_keep_request'].submit();
    }
</script>

<style type="text/css">
    #hovering-grey:hover {
        background-color: #F7FDFF !important;
    }
</style>
@endonce
