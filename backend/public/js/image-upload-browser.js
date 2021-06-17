// 画像をアップロードした際、ブラウザにリアルタイムで画像を表示させる
$('#imageUploader').after('<div id="uploadedImage"></div>');

// アップロードするファイルを選択
$('#imageUploader').change(function() {
  var file = $(this).prop('files')[0];

  //  画像表示
  var reader = new FileReader();
  reader.onload = function() {
      var img_src = $('<img>').attr('src', reader.result).attr('style','max-width:300px; max-height:200px;');
      $('#uploadedImage').html(img_src);
    }
  reader.readAsDataURL(file);
});