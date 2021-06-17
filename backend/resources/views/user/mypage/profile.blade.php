@extends('user.layouts.base')

@section('title', 'Dashboard')

@section('content')
    <div class="content">
        <div class="section">

            <x-user.mypage-navigation-bar/>

            <!--
            <div class="fixedcontainer mypage_contents my-page_header">
                <ul id="my-page_header-menu_sample" class="sm sm-clean">
                  <li><a href="#">サンプルメニュー(多層)</a>
                    <ul>
                      <li><a href="#">サンプルアイテム</a></li>
                      <li><a href="#">サンプルアイテム</a></li>
                      <li><a href="#">サンプルアイテム</a>
                        <ul class="sub-menu">
                          <li><a href="#">サンプルサブアイテム</a></li>
                          <li><a href="#">サンプルサブアイテム</a></li>
                          <li><a href="#">サンプルサブアイテム</a></li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li><a href="#">サンプルメニュー/a></li>
                  <li><a href="#">サンプルメニュー</a></li>
                  <li><a href="#">サンプルメニュー</a></li>
                  <li><a href="#">サンプルメニュー(多層)</a>
                    <ul>
                      <li><a href="#">サンプルアイテム</a></li>
                      <li><a href="#">サンプルアイテム</a></li>
                      <li><a href="#">サンプルアイテム</a>
                        <ul class="sub-menu">
                          <li><a href="#">サンプルサブアイテム</a></li>
                          <li><a href="#">サンプルサブアイテム</a></li>
                          <li><a href="#">サンプルサブアイテム</a></li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                </ul>
            </div>
            -->



            <div class="fixedcontainer mypage_contents profile_box">
                <h2><i class="fas fa-address-card"></i>プロフィール編集</h2>
                <form action="{{ route('user.update_profile', ['user' => $user]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group user_password">
                        <label class="control-label" for="user_name">ユーザー名
                        </label>
                        <input class="form-control" placeholder="ユーザー名" type="text" name="name" id="user_name" value="{{ old('name', $user->name) }}">
                    </div>
                    @error('name')
                    <div class="invalid-feedback" style="color: red;">
                        {{ $message }}
                    </div>
                    @enderror

                    <div class="form-group user_password">
                        <label class="control-label" for="user_icon">ユーザーアイコン
                        </label>

                        <div class="user_profile_img">
                            <img src="{{ Storage::url($user->image_url) }}" id="currentImage_icon" style="height: 200px;">
                            <label class="btn-image-upload" style="cursor: pointer;"><i class="far fa-image"></i>
                              <input type="file" style="display: none;" class="image_file" id="imageUploader_icon" name="image_url">
                               画像をアップロードする<br>縦横比200px*200px以上の画像推奨</label>
                        </div>
                    </div>

                    @error('image_url')
                    <div class="invalid-feedback" style="color: red;">
                        {{ $message }}
                    </div>
                    @enderror

                    <div class="submit-box">
                        <button type="submit" class="my-page_btn">更新</button>
                    </div>
                </form>

                <div class="Withdrawal"><a href="{{ route('user.withdraw') }}">退会の方はこちら</a></div>                
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
$(function() {
      $('#imageUploader_icon').after('<div id="uploadedImage_icon"></div>');

      $('#imageUploader_icon').change(function() {
        $("#currentImage_icon").remove();
        var file = $(this).prop('files')[0];
        if (! file.type.match('image.*')) {
          $(this).val('');
          $('#uploadedImage_icon').html('');
          return;
        }
        var reader = new FileReader();
        reader.onload = function() {
          var img_src = $('<img>').attr('src', reader.result).attr('style','height:200px;');
          $('#uploadedImage_icon').html(img_src);
          $('.fa-image').remove();
        }
        reader.readAsDataURL(file);
      });
});
</script>
@endsection
