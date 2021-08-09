// jQuery
// 対象チェックボックスが1つでもチェックされているかを判定して真偽値を返す
function check_checked(judge_element_selector, target_selector) {
    $(judge_element_selector).click(function () {
        var check_count = $(target_selector + ":checked").length;
        if (check_count == 0) {
            alert("支援者を指定してください");
            return false;
        } else {
            return true;
        }
    });
}
