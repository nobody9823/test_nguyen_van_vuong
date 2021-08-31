@extends('user.layouts.base')

@section('title', 'コメント一覧')

@section('content')
<section id="supported-projects" class="section_base">

    <div class="tit_L_01 E-font">
        <h2>COMMENTS</h2>
        <div class="sub_tit_L">コメント一覧</div>
    </div>

    <div class="prof_page_base inner_item">
        <div class="prof_page_L">
            <x-user.mypage-navigation-bar/>
        </div><!--/prof_page_L-->

        <div class="prof_page_R">
            @foreach($comments as $key => $comment)
            <div class="prof_page_base inner_item">
                <div class="comment_page">
                {{-- <div class="prof_edit_row" style="{{ isset($comment->reply) ? 'border-bottom: none;' : '' }}"> --}}
                <div class="comment_wrapper" style="{{ isset($comment->reply) ? 'border-bottom: none;' : '' }}">
                  <div style="display: flex; min-width: 80%;">
                    <img src="{{ Storage::url(optional($comment->user->profile)->image_url) }}" alt="プロフィール画像" class="user_image">
                    <div class="comment_content">{{ $comment->content }}<br>
                        <div>
                        <span>{{ $comment->user->name }}&emsp;</span>
                        <span>{{ $comment->created_at->format('Y年m月d日 H:i') }}</span>
                        </div>
                    </div>
                  </div>
                    <div class="comment_icons">
                        @if(!$comment->reply)
                        <i class="fas fa-reply fa-2x fa-fw" style="cursor: pointer" id="{{ 'open_modal_'.$key }}" onclick="toggleModal(this.id)"></i>&emsp;
                        @endif
                        <form action="{{ route('user.comment.destroy', ['project' => $comment->project, 'comment' => $comment]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="far fa-trash-alt fa-2x fa-fw delete-btn" onclick="return confirm('本当に削除しますか？')"></button>
                        </form>
                    </div>
                </div>

                @if($comment->reply)
                <div class="prof_edit_row" style="{{ isset($comment->reply) ? '' : 'border-bottom: none;' }}">
                    <img src="{{ Storage::url(optional($comment->project->user)->profile->image_url) }}" alt="プロフィール画像" class="user_image reply_user">
                    <div class="comment_content reply_content">{{ $comment->reply->content }}<br>
                    <div>
                        <span>{{ $comment->project->user->name }}&emsp;</span><span>{{ $comment->reply->created_at->format('Y年m月d日 H:i') }}</span>
                    </div>
                    </div>
                    <div class="comment_icons">
                    <form action="{{ route('user.reply.destroy', ['project' => $comment->project, 'reply' => $comment->reply]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="far fa-trash-alt fa-2x fa-fw delete-btn" onclick="return confirm('本当に削除しますか？')"></button>
                    </form>
                    </div>
                </div>
                @endif
                </div>
            </div>

            <!-- モーダルウィンドウ -->
            <div id="{{ 'modal_area_'.$key }}" class="modal_area">
                <div class="modal_back_ground"></div>
                <div class="modal_wrapper">
                <form action="{{ route('user.reply.store', ['project' => $comment->project, 'comment' => $comment]) }}" method="POST">
                    @csrf
                    <div>
                    <div class="av_tit">
                        <p style="text-align: center;">返信コメント</p>
                    </div>
                    <textarea name="content" class="input_reply">{{old('content')}}</textarea>
                    </div>

                    <div class="def_btn">
                    <button class="disable-btn" type="submit">
                        <p style="font-size: 1.8rem; font-weight: bold; color: #fff;">送信</p>
                    </button>
                    </div>
                </form>

                <div id="{{ 'close_modal_'.$key }}" class="close_modal" onclick="toggleModal(this.id)">
                    <i class="fas fa-times fa-lg"></i>
                </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
{{ $comments->appends(request()->input())->onEachSide(1)->links() }}

@endsection

@section('script')
<script src="{{ asset('/js/modal-window.js') }}"></script>
@endsection

<style>
.delete-btn{
  cursor: pointer;
  color: #00AEBD;
}
/* コメント関連 */
.comment_page {
  width: 100%;
}
button{
        background-color: transparent;
        border: none;
        cursor: pointer;
        outline: none;
        padding: 0;
        appearance: none;
}
.user_image {
  border-radius: 50%;
}

.comment_content {
  width: 100%;
  line-height: 20px;
  margin-top: 15px;
  white-space: pre-line;
}

.comment_content div {
  font-size: 85%;
  display: flex;
  flex-direction: column;
}

.comment_icons {
  color: #00AEBD;
  display: flex;
  font-size: 12px;
}

.comment_content span:first-child {
  color: #00AEBD;
}

.reply_content {
  width: 70%;
  margin-top: 25px;
  white-space: pre-line;
}

.reply_user {
  margin-left: 65px;
}

@media (max-width: 767px) {
  .user_image{ margin: 30px 0 10px 0; }
	.reply_content{ width: calc(100% - 35%);}
  .reply_user{ margin-left: 0px; }
  .comment_content { width: calc(100% - 20%);)}
  .comment_content div {
    font-size: 77%;
  }
}

.comment_wrapper {
  font-size: 1.6rem;
  padding: 10px 0;
  min-height: 75px;
  border-bottom: solid 1px #00AEBD;
  display: flex;
  align-items: center;
  align-content: center;
  justify-content: space-between;
}

.comment_wrapper img{ height: 48px; width: 48px;}

/* モーダルウィンドウ */
.modal_area {
  visibility: hidden;
  opacity : 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  transition: .5s;
}

.modal_back_ground {
  width: 100%;
  height: 100%;
  background-color: rgba(30,30,30,0.9);
}

.modal_wrapper {
  position: absolute;
  top: 50%;
  left: 50%;
  transform:translate(-50%,-50%);
  height: 60%;
  width: 70%;
  max-width: 500px;
  padding: 10px 30px;
  background-color: #fff;
  border-radius: 10px;
}

.close_modal {
  position: absolute;
  top: 10px;
  right: 10px;
  cursor: pointer;
}

.is_show {
  visibility: visible;
  opacity : 1;
}

.input_reply{
  width: 100%;
  height: 65%;
  padding: 10px;
  margin: 0 0 10px 0;
  border: solid 1px #DBDBDB;
  border-radius: 4px;
  resize:none;
}
/* ここまでモーダルウィンドウ */
</style>
