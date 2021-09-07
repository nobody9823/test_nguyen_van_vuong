// toastを表示するjs;
// type(必須) => success,info,warning,errorのどれかを入力(色変わるだけ)
// title => タイトルがあれば入力(普通はなくて良い)
// text(必須)　=> 本文を入力

function displayToast(type, title = null, text) {
    toastr[type](title, text);
}
