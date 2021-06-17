@extends('talent.layouts.base')

@section('title', '活動報告新規作成')

@section('content')
<div class="card">
    <div class="card-header">活動報告新規作成</div>
    <div class="card-body">
        <form action="{{ route('talent.activity_report.store', ['project' => $project]) }}" 
        enctype="multipart/form-data" method="POST">
            @csrf
            <x-manage.activity_report.form role="talent" :project="$project" :activityReport="null" />
        </form>
    </div>
</div>
@endsection
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