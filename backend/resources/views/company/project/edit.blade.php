@extends('company.layouts.base')

@section('title', "プロジェクト編集")

@section('content')

{{--エラーメッセージ--}}

{{--記事追加画面--}}
<div class="card">
    <div class="card-header">プロジェクト編集</div>
    <div class="card-body">
        <form action="{{ route('company.project.update', ['project' => $project]) }}" enctype="multipart/form-data"
            method="POST">
            @csrf
            @method('PUT')

            <x-manage.project.form role="company" :project="$project" :talents="$talents" :categories="$categories" />

        </form>
        <div class="row">
            @foreach($project->projectImages as $project_image)
            <div class="col-sm-4 p-2 image-card">
                <span class="card" style="width: 18rem;">
                    <div class="card-body">
                        <img src="{{asset(Storage::url($project_image->image_url))}}" id='previousImage'
                            style='height:200px; object-fit: cover;' alt="image" class="col-12">
                        <button type="button" class="btn btn-danger del-btn" id="{{ $project_image->id }}">削除</button>
                    </div>
                </span>
            </div>
            @endforeach
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

<script>
    // 画像の削除処理
$(function () {
    // 削除ボタンを押した時
    $(".del-btn").click(function() {
        var deleteConfirm = confirm('削除してもよろしいですか？');

        if (deleteConfirm === true) {
            // 対象の要素を取得
            var el = $(this);
            // 画像のIDを取得
            var ImageId = el.attr('id');
            // トークンの挿入
            el.append('<meta name="csrf-token" content="{{ csrf_token() }}">');
            // ajaxについての記述
            $.ajax({
                url: '/company/project/image/' + ImageId,
                type: 'POST',
                data: {'project_id': ImageId, '_method': 'DELETE'},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                // 成功した時
                success: function(msg){
                    if (msg === 'success') {
                        alert( "削除が成功しました。");
                        el.parents('div.image-card').remove();
                    } else {
                        alert("エラーが起こりました。");
                    }
                }
            })
            // 失敗した時
            .fail(function() {
                alert('エラーが起こりました。');
            });
        }
    });
});
</script>
@endsection
@endsection
