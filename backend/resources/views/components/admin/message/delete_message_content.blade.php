{{-- delete用フォーム --}}

<img id='delete_icon' src="{{ asset('image/delete_icon.png') }}" alt=""
    onclick="delete_form_submit('{{ $messageContent->id }}')">

<form name='chat_content_delete_from' action="{{ url('/admin/message') }}" method="POST">
    @csrf
    @method('DELETE')
    <x-common.add_hidden_query />
</form>

@once
<script>
    //hiddenを追加
            function delete_form_submit(action) {
            if(confirm('本当に削除しますか？')){
                document.forms['chat_content_delete_from'].action += '/'+action;
                document.forms['chat_content_delete_from'].submit();
            }
        }

</script>

<style>
    #delete_icon {
        cursor: pointer;
        opacity: 0;
        height: 1rem;
        width: 1rem;
    }
</style>

@endonce
