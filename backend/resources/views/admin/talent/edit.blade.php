@extends('admin.layouts.base')

@section('title', "タレント編集")

@section('content')

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">タレント編集画面</div>
                <div class="card-body">
                    <form action="{{ route('admin.talent.update', ['talent' => $talent]) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <x-manage.talent.form role="admin" :talent="$talent" :companies="$companies" />
                    </form>
                    <a href="{{ route('admin.talent.password_reset', ['talent' => $talent]) }}" id="reset">
                                パスワードリセットメールを送信する
                        </a>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script')
<script>
    $(function() {
  $('#imageUploader').after('<span id="uploadedImage"></span>');

  // アップロードするファイルを選択
  $('#imageUploader').change(function() {
    var file = $(this).prop('files')[0];

    // 画像以外は処理を停止
    if (! file.type.match('image.*')) {
      // クリア
      $(this).val('');
      $('#uploadedImage').html('');
      return;
    }

    // 画像表示
    var reader = new FileReader();
    reader.onload = function() {
      var img_src = $('<img>').attr('src', reader.result).attr('style','height:200px;');
      $('#uploadedImage').html(img_src);
    }
    reader.readAsDataURL(file);
  });
});
</script>
<script>
$(function() {
    $(".del-btn").click(function() {
        var deleteConfirm = confirm("削除してもよろしいですか?");

        if (deleteConfirm === true) {
            var el = $(this);

            var ImageId = el.attr('id');

            el.append('<meta name="csrf-token" content="{{ csrf_token() }}">');

            $.ajax({
                url: '/admin/talent/image/' + ImageId,
                type: 'POST',
                data: {'id': ImageId, '_method': 'DELETE'},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                success: function(msg) {
                    if (msg === 'success') {
                        alert( "削除が成功しました。");
                        el.parents('div.image-card').remove();
                    } else {
                        alert("エラーが起こりました。");
                    }
                }
            })
            .fail(function() {
                        alert('エラーが起こりました。');
            });
        }
    })
})
</script>
@endsection
@endsection
