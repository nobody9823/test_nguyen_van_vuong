<!-- 1.モーダル表示のためのボタン -->
<img id='change_icon' src="{{ asset('image/edit_icon.png') }}" alt="" data-toggle="modal"
    data-target="#modal-chat-first{{ $messageContent->id }}">

<!-- 2.モーダルの配置 -->
<div class="modal" id="modal-chat-first{{ $messageContent->id }}" tabindex="-1">
    <div class="modal-dialog">

        <!-- 3.モーダルのコンテンツ -->
        <div class="modal-content">

            <!-- 4.モーダルのヘッダ -->
            <div class="modal-header">
                <p class="modal-title" id="modal-label">メッセージを編集
                </p>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action={{route('admin.message_content.update',[
                'message_content' => $messageContent,
            ])}} method='post'>
                @csrf
                @method('PUT')
                <x-common.add_hidden_query />
                <!-- 5.モーダルのボディ -->
                <div class="modal-body">
                    <p>編集後、下の編集ボタンを押してください。</p>
                    <textarea name='content' style='width:100%;height:300px;'
                        required>{{ $messageContent->content }}</textarea>
                </div>

                <!-- 6.モーダルのフッタ -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                    <button type="submit" class="btn btn-primary">編集</button>
                </div>
            </form>
        </div>
    </div>
</div>

@once
<style>
    #change_icon {
        cursor: pointer;
        opacity: 0;
        height: 1rem;
        width: 1rem;
    }
</style>
@endonce
