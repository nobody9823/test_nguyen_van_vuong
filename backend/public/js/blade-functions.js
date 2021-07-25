
// 存在しない日付を選択させない関数
// チェックしたい要素のonchangeに指定
// 利用例
/* <select id="birth_month" class="form-control" name="end_month" onchange="dateValidation(this, 'end_year', 'end_month', 'end_day')"> */
function dateValidation( element, year, month, day ) {
    var year = document.getElementsByName( year )[0].value;
    var month = document.getElementsByName( month )[0].value;
    var day = document.getElementsByName( day )[0].value;
    if ( year && month && day ) {
        var date = new Date( year, month-1, day );
        if ( date.getFullYear() != year || date.getMonth() != month-1 || date.getDate() != day ) {
            return element.value = '';
        }
    }
}







// もっと見る機能
// 利用例 (JqueryのためDOMContentLoadedしたあとじゃなきゃ多分動かない)
/* 
<script src="{{ asset('/js/more-looking.js') }}"></script>
<script type="text/javascript">
    window.addEventListener('DOMContentLoaded', () => {
        moreLooking('ranked_inviter_by_amount', 5, 30, 'ranked_inviter_by_amount_more_looking_button',
            'ranked_inviter_by_amount_closed_button');
        moreLooking('ranked_inviter_of_count', 5, 30, 'ranked_inviter_of_count_more_looking_button',
            'ranked_inviter_of_count_closed_button');
    })
</script> 
*/
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
        $('.' + propsClassName).each(function(index) {
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
