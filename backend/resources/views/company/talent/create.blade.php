@extends('company.layouts.base')

@section('title', 'タレント新規作成')

@section('content')

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">タレント新規作成</div>
                <div class="card-body">
                    <form action="{{ route('company.talent.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <x-manage.talent.form role="company" :talent="null" :companies="null" />

                    </form>
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
@endsection

@endsection
