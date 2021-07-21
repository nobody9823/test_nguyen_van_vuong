function moreLooking(propsClassName,defaultNum,addNum,moreButtonName = 'more_looking_button',CloseButtonName = 'closed_btn'){
    // メッセージグループの数を取得
    var $propsLength = $('.' + propsClassName).length;

    // 現在のメッセージグループの表示数
    var $currentNum = 0;

    // $currentNumに初期値を代入
    $currentNum = defaultNum;

    // 取得したメッセージグループ数が$currentNumより多い時
    if ($currentNum < $propsLength) {
        // メッセージグループを8コまで表示してそれ以外はhideしておく
        $('.' + propsClassName).each(function(index, element) {
            if (index >= defaultNum) {
                $(this).hide();
            }
        })

        // もっと見るボタンは表示して、閉じるボタンはhideする
        $("#" + moreButtonName).show();
        $("#" + CloseButtonName).hide();
        // 取得したメッセージグループ数が$currentNumより少ない時
    } else if ($currentNum >= $propsLength) {
        // もっと見るボタンと閉じるボタンをhideする
        $("#" + moreButtonName).hide();
        $("#" + CloseButtonName).hide();
    }

    // もっと見るボタンを押した時
    $("#" + moreButtonName).click(function() {
        console.log('hello');
        // $currentNum変数を更新
        $currentNum += addNum;
        // 現在表示しているメッセージグループに12コ追加で表示
        $("." + propsClassName + '_list').find("." + propsClassName + ":lt("+ $currentNum +")").slideDown();

        // $currentNumより取得したメッセージグループが少ない場合
        if ($currentNum >= $propsLength) {
            // $currentNumをデフォルト値を代入
            $currentNum = defaultNum;
            // インデックス用の値をセット
            var $indexNum = $currentNum - 1;
            // もっと見るボタンをhideして、閉じるボタンを表示
            $("#" + moreButtonName).hide();
            $("#" + CloseButtonName).show();

            // 閉じるボタンを押した時
            $("#" + CloseButtonName).click(function() {
                // インデックスが$indexNumより大きい要素は非表示
                $("." + propsClassName + '_list').find("." + propsClassName + ":gt("+ $indexNum +")").slideUp();
                // 閉じるボタンはhide、もっと見るボタンは表示
                $("#" + CloseButtonName).hide();
                $("#" + moreButtonName).show();
            })
        }
    })
}
