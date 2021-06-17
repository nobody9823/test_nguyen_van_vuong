<!-- 1.モーダル表示のためのボタン -->
<a style="cursor: pointer;" data-toggle="modal" data-target="#modal-chat-first{{ $messageContent->id }}">
    <img src="{{ asset('image/edit_icon.png') }}" alt="">
</a>

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

            <form action={{route('admin.chat_contents.update',[
                'chat_content' => $messageContent,
            ])}} method='post'>
                @csrf
                @method('PUT')
                @if (Request::get('user'))
                <input type="hidden" name='user' value={{ Request::get('user') }}>
                @endif
                @if (Request::get('company'))
                <input type="hidden" name='company' value={{ Request::get('company') }}>
                @endif
                @if (Request::get('job_offer'))
                <input type="hidden" name='job_offer' value={{ Request::get('job_offer') }}>
                @endif
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
