// クリアボタンを押すと検索項目がクリアされる処理 
$("#clear_btn").click(function(){
    $("#keyword_search").val("");
    $("#category").val("");
    $("#sort").val("");
    $("input").prop('checked', false);
});