$(function(){
    $(".btn-approval-request").click(function(){
        if (confirm("認証申請を行うと編集、削除が一切できなくなります。よろしいですか？")){

        }else{
            return false;
        }
    });
});
$(function(){
    $(".btn-approved").click(function(){
        if (confirm("掲載しますか？")){

        }else{
            return false;
        }
    });
});
$(function(){
    $(".btn-send-back").click(function(){
        if (confirm("差し戻ししますか？")){

        }else{
            return false;
        }
    });
});
$(function(){
    $(".btn-under-suspension").click(function(){
        if (confirm("掲載停止しますか？")){

        } else {
            return false;
        }
    });
});
$(function () {
    $(".btn-dell-project").click(function () {
        if (confirm("本当に削除しますか？")) {
            //そのままsubmit（削除）
        } else {
            //cancel
            return false;
        }
    });
});
$(function () {
    $(".btn-dell-activity-report").click(function () {
        if (confirm("本当に削除しますか？")) {
            //そのままsubmit（削除）
        } else {
            //cancel
            return false;
        }
    });
});
$(function () {
    $(".btn-dell-comment").click(function () {
        if (confirm("本当に削除しますか？")) {
            //そのままsubmit（削除）
        } else {
            //cancel
            return false;
        }
    });
});
$(function () {
    $("#btn-send-cheering-users").click(function () {
    var check_count = $('.checkbox-judge :checked').length;
        if (check_count == 0 ){
            alert("支援者を指定してください");
            return false;
        } else {
            return true;
        }
    });

    // 「全選択」する
    $('#all').on('click', function() {
        $("input[name='user_ids[]']").prop('checked', this.checked);
    });
})