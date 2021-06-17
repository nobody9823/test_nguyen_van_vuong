<div id='hovering-grey' class="chat_group" onclick="form_submit(this)"
    style='cursor: pointer;min-height:90px;border: 0;border-bottom: 1px solid #aaa;padding: 0.5rem;background-color:{{ $message->id === optional($selectedMessage)->id ? "rgb(230, 230, 230)":'#f8f9fa' }};'
    data-href={{route("$guard.message.show",['message' => $message])}}>
    <div class="unread_mark_parent">
        <x-common.message.unread_mark :guard="$guard" :message="$message" />
        {{$message->updated_at->format('Y/m/d H:i:s')}}<br>
        【{{Str::limit($message->plan->title,40)}}】
    </div>
    <div>
        【{{$message->plan->project->talent->name}}】
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
        background-color: rgb(201, 201, 201) !important;
    }
</style>
@endonce
