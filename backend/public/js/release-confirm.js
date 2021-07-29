function releaseConfirm(){
    var checked = confirm("申請しますか？");
    if (checked == true) {
        return true;
    } else {
        return false;
    }
}