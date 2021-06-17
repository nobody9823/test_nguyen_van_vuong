@extends('company.layouts.base')

@section('title', "新規プロジェクト追加")

@section('content')

{{--エラーメッセージ--}}

{{--記事追加画面--}}
<div class="card">
    <div class="card-header">新規プロジェクト追加</div>
    <div class="card-body">
        <form action="{{ route('company.project.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <x-manage.project.form role="company" :project="null" :talents="$talents" :categories="$categories" />

        </form>
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

<script src="https://cdn.jsdelivr.net/npm/jquery-datetimepicker@2.5.20/build/jquery.datetimepicker.full.min.js">
</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-datetimepicker@2.5.20/jquery.datetimepicker.css">

<script>
    $(function () {
    $("#start_date").datetimepicker({
        format: 'Y-m-d H:i:s'
    });
    $("#end_date").datetimepicker({
        format: 'Y-m-d H:i:s'
    });
});
</script>
@endsection
@endsection
