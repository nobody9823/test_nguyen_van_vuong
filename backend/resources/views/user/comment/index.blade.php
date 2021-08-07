@extends('user.layouts.base')

@section('title', 'コメント一覧')

@section('content')
<section class="section_base">
  <div class="tit_L_01 E-font">
      <h2>COMMENTS</h2>
      <div class="sub_tit_L">コメント一覧</div>
  </div>

<!-- ------------------------------------------------------------------------------------------ -->
  <div class="prof_page_base inner_item">
    <div class="comment_page">
      <div class="prof_edit_row" style="{{ isset($test) ? '' : 'border-bottom: none;' }}">
          <img src="/storage/sampleImage/my-page.svg" alt="" class="test_img">
          <div class="test">応援しています。頑張ってください。応援しています。頑張ってください。応援しています。頑張ってください。応援しています。頑張ってください。<br>
            <div>
              <span class="message-user-name">山田 太郎&emsp;</span><span>コメント時刻 : 12:00</span>
            </div>
          </div>
          <div class="icons">
              <a href=""><i class="fas fa-reply fa-2x fa-fw"></i></a>&emsp;
              <a href=""><i class="far fa-trash-alt fa-2x fa-fw"></i></a>
          </div>
      </div>
      
      <div class="prof_edit_row">
          <img src="/storage/sampleImage/my-page.svg" alt="" class="test_img reply-user">
          <div class="test reply">応援しています。頑張ってください。応援しています。頑張ってください。応援しています。頑張ってください。応援しています。頑張ってください。<br>
            <div>
              <span class="message-user-name">山田 太郎&emsp;</span><span>コメント時刻 : 12:00</span>
            </div>
          </div>
          <div class="icons">
              <a href=""><i class="far fa-trash-alt fa-2x fa-fw"></i></a>
          </div>
      </div>
    </div>
  </div>

  <!-- ------------------------------------------------------------------------------------------ -->

</section>
@endsection

<style>
.comment_page{ 
  width: 100%;
}

.test_img{
  border-radius: 50%;
}

.test{
  width: 80%;
  line-height: 35px;
}

.test div{
  font-size: 85%;
}

.icons{
  color: #00AEBD;
}

.message-user-name{
  color: #00AEBD;
}

.reply{
  width: 790px;
}

.reply-user{
  margin-left: 65px;
}
</style>