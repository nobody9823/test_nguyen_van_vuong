// プロジェクトのお気に入り登録・解除処理
$('.liked_project').on('click', function() {
    var el = $(this);
    var projectId = el.attr('id');
    
    // csrfトークンをphpファイルから受け取っている
    el.append('<meta name="csrf-token" content=' + Laravel.csrfToken + '>');

    $.ajax({
        url: '/project/'+ projectId + '/liked',
        type: 'POST',
        data: {'project_id': projectId },
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    })
    .then((response) => {
        console.log(response);
        if(response == "登録"){
            el.children('i').attr('class', 'fas fa-heart');
        } else if(response == "削除"){
            el.children('i').attr('class', 'far fa-heart');
        } else if (response == "未ログイン") {
            alert("ログインもしくは会員登録をしてください");
        } else {
            alert("エラーが起こりました。");
        }
    })
    .fail((error)=>{
        console.log("エラーが起こりました。")
    })
});