@extends('user.layouts.base')

@section('title', 'コメント一覧')

@section('content')
<section class="section_base">
  <div class="tit_L_01 E-font">
      <h2>COMMENTS</h2>
      <div class="sub_tit_L">コメント一覧</div>
  </div>

  <div class="prof_page_base inner_item">
    <div class="comment_page">
      <div class="prof_edit_row" style="{{ isset($test) ? '' : 'border-bottom: none;' }}">
          <img src="/storage/sampleImage/my-page.svg" alt="" class="user_image">
          <div class="comment_content">応援しています。頑張ってください。応援しています。頑張ってください。応援しています。頑張ってください。応援しています。頑張ってください。<br>
            <div>
              <span class="comment_information">山田 太郎&emsp;</span><span>12:00</span>
            </div>

          </div>
          <div class="comment_icons">
              <i class="fas fa-reply fa-2x fa-fw" id="open_modal"></i>&emsp;
              <form action="" method="POST">
                @csrf
                @method('DELETE')
                <i class="far fa-trash-alt fa-2x fa-fw btn-dell-comment"></i>
              </form>
          </div>
      </div>
      
      <div class="prof_edit_row">
          <img src="/storage/sampleImage/my-page.svg" alt="" class="user_image reply_user">
          <div class="comment_content reply_content">応援しています。頑張ってください。応援しています。頑張ってください。応援しています。頑張ってください。応援しています。頑張ってください。<br>
            <div>
              <span class="comment_information">山田 太郎&emsp;</span><span>12:00</span>
            </div>
          </div>
          <div class="comment_icons">
              <i class="far fa-trash-alt fa-2x fa-fw btn-dell-comment"></i>
          </div>
      </div>
    </div>
  </div>
</section>

<!-- モーダルウィンドウ -->
<section id="modal_area" class="modal_area">
  <div id="modal_bg" class="modal_bg"></div>
  <div class="modal_wrapper">
    <div class="modalContents">
      <div>
          <div class="av_tit">
            <p style="text-align: center;">返信コメント</p>
          </div>
          <textarea name="" class="input_reply"></textarea>
      </div>
      <div class="def_btn">
        <a href="" class="disable-btn">
          <p style="font-size: 1.8rem; font-weight: bold; color: #fff;">送信</p>
        </a>
      </div>
    </div>
    <div id="close_modal" class="close_modal"><i class="fas fa-times fa-lg"></i></div>
  </div>
</section>

@endsection

@section('script')
<script src="{{ asset('/js/confirm.js') }}"></script>
<script>
  (function () {
  const modal_area = document.getElementById('modal_area');
  const open_modal = document.getElementById('open_modal');
  const close_modal = document.getElementById('close_modal');
  const modal_bg = document.getElementById('modal_bg');
  const toggle = [open_modal,close_modal,modal_bg];
  
  for(let i=0, len=toggle.length ; i<len ; i++){
    toggle[i].addEventListener('click',function(){
      modal_area.classList.toggle('is_show');
    },false);
  }
}());
</script>
@endsection