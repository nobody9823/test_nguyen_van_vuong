function required_check(selector) {
    $(function () {
        //始めにjQueryで送信ボタンを無効化する
        $(selector).prop("disabled", true);

        //入力欄の操作時
        $("form input:required,form textarea:required").change(function (el) {
            //必須項目が空かどうかフラグ
            let flag = true;
            //必須項目をひとつずつチェック
            $("form input:required,form textarea:required").each(function (
                index,
                el
            ) {
                //もし必須項目が空なら
                if (el.value == "") {
                    flag = false;
                }
            });
            $("form input[type='checkbox']").each(function (index, el) {
                if (el.checked == false) {
                    flag = false;
                }
            });
            //全て埋まっていたら
            if (flag) {
                //送信ボタンを復活
                $(selector).prop("disabled", false);
            } else {
                //送信ボタンを閉じる
                $(selector).prop("disabled", true);
            }
            // console.log(flag);
        });
    });
}
