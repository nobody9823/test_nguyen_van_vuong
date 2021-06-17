// ファイルアップロード時に発火
function uploadImage(obj) {
    // ファイル選択時に既存のアップロード画像を削除
    $('.uploadImage').remove();

    // アップロードした画像の数だけ、ブラウザに表示する。
    for (i = 0; i < obj.files.length; i++) {
        let fileReader = new FileReader();
        let preview = document.getElementById('preview');
        if (obj.files[i].type.indexOf('image') != -1) {
            fileReader.onload = (function(e) {
                preview.insertAdjacentHTML('beforeend' ,'<div class="uploadImage"><div>【プレビュー画像】</div><img src="' + e.target.result + '" style="max-width:300px; max-height:200px; margin:30px;"></div>');
            });
        } else {
            preview.insertAdjacentHTML('beforeend' ,`<div class="uploadImage"><div>【プレビュー画像】</div><object id="object_${i}" style="max-width:300px; max-height:200px; margin:30px;"></object></div>`);
            let object = document.getElementById(`object_${i}`);
            fileReader.onload = function(e) {
                object.setAttribute("data", e.target.result);
            }
        }
        fileReader.readAsDataURL(obj.files[i]);
    }
}

$(function() {
    $("#send").click(function() {
        // アップロードファイル数の取得
        let fileList = document.getElementById("numberOfFiles").files;

        // アップロードして送信出来る枚数は3枚まで
        if (fileList.length <= 3) {
            if (confirm("本当にこの内容でよろしいですか？")) {
                //そのままsubmit（送信）
            } else {
                //cancel
                return false;
            }
        } else {
            alert("アップロードするファイルは3枚までにして下さい。");
            return false;
        }
    });
});
