@extends('talent.layouts.base')

@section('title', 'プラン新規作成')

@section('content')

<div class="card">
    <div class="card-header">プラン新規作成</div>
    <div class="card-body">
        <form action="{{ route('talent.plan.store', ['project' => $project]) }}" enctype="multipart/form-data"
            method="POST">
            @csrf
            
            <x-manage.plan.form guard="talent" :project="$project" :plan="null" :contribution="$contribution" />

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

<!-- datetimepicker -->
<script src="https://cdn.jsdelivr.net/npm/jquery-datetimepicker@2.5.20/build/jquery.datetimepicker.full.min.js">
</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-datetimepicker@2.5.20/jquery.datetimepicker.css">
<script>
    $(function () {
        $('#estimated_return_date').datetimepicker({
            format: 'Y-m-d'
        });
    });
</script>
@endsection
