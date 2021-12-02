<div id='hovering-grey' class="chat_group" onclick="form_submit(this)"
    style='font-size: 1.4rem;font-weight: bold;cursor: pointer;min-height:90px;border: 0;border-bottom: 1px solid #00aebd;color:#707070;padding: 0.5rem; }};'
    data-href={{ route('user.my_project.message.index', ['project' => $project]) }}
>
    <div class="unread_mark_parent">
        {{-- <x-common.message.unread_mark :guard="$guard" :message="$message" /> --}}
        {{$project->payments()->latest()->first()->updated_at->format('Y/m/d H:i:s')}}<br>
        【{{Str::limit($project->title,40)}}】
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
