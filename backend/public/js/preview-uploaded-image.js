function previewUploadedImage(input, columnName) {
    console.log(columnName);
    const file = input.files[0];
    if (
        file.type != "image/jpeg" &&
        file.type != "image/gif" &&
        file.type != "image/png" &&
        file.type != "application/pdf"
    ) {
        alert(".jpg、.gif、.png、.pdfのいずれかのファイルのみ許可されています");
        return;
    }
    const preview = document.getElementById(columnName);
    const reader = new FileReader();
    reader.onload = function (e) {
        const imageUrl = e.target.result; // URLはevent.target.resultで呼び出せる
        const img = document.createElement("img"); // img要素を作成
        img.src = imageUrl; // URLをimg要素にセット
        preview.removeChild(preview.firstElementChild);
        preview.appendChild(img); // #previewの中に追加
    };
    reader.readAsDataURL(file);
}
