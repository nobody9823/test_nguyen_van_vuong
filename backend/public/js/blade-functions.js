// 存在しない日付を選択させない関数
// チェックしたい要素のonchangeに指定
// 利用例
/* <select id="birth_month" class="form-control" name="end_month" onchange="dateValidation(this, 'end_year', 'end_month', 'end_day')"> */
// function dateValidation(element, year, month, day) {
//     var year = document.getElementsByName(year)[0].value;
//     var month = document.getElementsByName(month)[0].value;
//     var day = document.getElementsByName(day)[0].value;
//     if (year && month && day) {
//         var date = new Date(year, month - 1, day);
//         if (
//             date.getFullYear() != year ||
//             date.getMonth() != month - 1 ||
//             date.getDate() != day
//         ) {
//             return (element.value = "");
//         }
//     }
// }
// 「年」「月」が選択されてない時に呼び出すalert
const emptyYearAndMonth = () => {
    alert('「年」または「月」が選択されていません。');
}
let startDayHtml;
let endDayHtml;

function setStartDay() {
    // 年の値を取得
    const startYearVal = document.getElementById('start_year').value;

    // 月の値を取得
    const startMonthVal = document.getElementById('start_month').value;

    // 日のセレクトボックスを取得
    const startDaySelectBox = document.getElementById('start_day');

    // 年月が有効な値の場合のみ日付の選択肢を加える
    if (startYearVal !== '' && startMonthVal !== '') {

        startDaySelectBox.removeEventListener('click', emptyYearAndMonth);

        // 特定の年月の最後の日付を取得する
        const startLastDay = (new Date(startYearVal, startMonthVal, 0)).getDate();

        // optionを組み立てる
        startDayHtml = '<option value="">日</option>';
        for (let startDay = 1; startDay <= startLastDay; startDay++) {
            startDayHtml += '<option value="' + startDay + '">' + startDay + '</option>';
        }
    } else {
        startDaySelectBox.addEventListener('click', emptyYearAndMonth)
    }
    startDaySelectBox.innerHTML = startDayHtml;
};

function setEndDay() {
    // 年の値を取得
    const endYearVal = document.getElementById('end_year').value;

    // 月の値を取得
    const endMonthVal = document.getElementById('end_month').value;

    // 日のセレクトボックスを取得
    const endDaySelectBox = document.getElementById('end_day');

    // 年月が有効な値の場合のみ日付の選択肢を加える
    if (endYearVal !== '' && endMonthVal !== '') {

        endDaySelectBox.removeEventListener('click', emptyYearAndMonth);
        // 特定の年月の最後の日付を取得する
        const endLastDay = (new Date(endYearVal, endMonthVal, 0)).getDate();
        // optionを組み立てる
        endDayHtml += '<option value="">日</option>';
        for (let endDay = 1; endDay <= endLastDay; endDay++) {
            endDayHtml += '<option value="' + endDay + '">' + endDay + '</option>';
        }
    } else {
        endDaySelectBox.addEventListener('click', emptyYearAndMonth)
    }
    endDaySelectBox.innerHTML = endDayHtml;
};

window.onload = function () {
    setStartDay();
    setEndDay();
    document.getElementById('start_year').addEventListener('change', setStartDay);
    document.getElementById('start_month').addEventListener('change', setStartDay);

    document.getElementById('end_year').addEventListener('change', setEndDay);
    document.getElementById('end_month').addEventListener('change', setEndDay);

    // リダイレクトした場合に元の入力値を復元する
    const startDayElem = document.getElementById('start_day');
    startDayElem.value = startDayElem.getAttribute('data-old-value');

    const endDayElem = document.getElementById('end_day');
    endDayElem.value = endDayElem.getAttribute('data-old-value');
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
function moreLooking(
    propsClassName,
    defaultNum,
    addNum,
    moreButtonName = "more_looking_button",
    CloseButtonName = "closed_btn"
) {
    // メッセージグループの数を取得
    var $propsLength = $("." + propsClassName).length;

    // 現在のメッセージグループの表示数
    var $currentNum = 0;

    // $currentNumに初期値を代入
    $currentNum = defaultNum;

    // 取得したメッセージグループ数が$currentNumより多い時
    if ($currentNum < $propsLength) {
        // メッセージグループを8コまで表示してそれ以外はhideしておく
        $("." + propsClassName).each(function (index) {
            if (index >= defaultNum) {
                $(this).hide();
            }
        });

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
    $("#" + moreButtonName).click(function () {
        console.log("hello");
        // $currentNum変数を更新
        $currentNum += addNum;
        // 現在表示しているメッセージグループに12コ追加で表示
        $("." + propsClassName + "_list")
            .find("." + propsClassName + ":lt(" + $currentNum + ")")
            .slideDown();

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
            $("#" + CloseButtonName).click(function () {
                // インデックスが$indexNumより大きい要素は非表示
                $("." + propsClassName + "_list")
                    .find("." + propsClassName + ":gt(" + $indexNum + ")")
                    .slideUp();
                // 閉じるボタンはhide、もっと見るボタンは表示
                $("#" + CloseButtonName).hide();
                $("#" + moreButtonName).show();
            });
        }
    });
}

// もっと見る機能(文言等ver)
// テキスト等をもっと見るを押すと全文表示するscript
function omit(targetClassName, maxLength = 20) {
    text = [];
    more_looking_button = [];
    child = [];
    // 最大値の設定(デフォルトは20)
    const MAX_LENGTH = maxLength;
    let contents = document.querySelectorAll("." + targetClassName);

    // contentsをforEachで一つずつ取得、引数が一つの場合は()を省略できる。(content) => {}の()を省略している。
    contents.forEach((content, index) => {
        text[index] = content.textContent;
        if (checkTextLengthOver(content.textContent, MAX_LENGTH)) {
            more_looking_button[index] = document.createElement("div");
            more_looking_button[index].classList.add("su_pr_more_btn");
            more_looking_button[index].textContent = "もっと見る";
            more_looking_button[index].style.cursor = "pointer";

            child[index] = document.createElement("i");
            child[index].classList.add("fas", "fa-chevron-down");

            // 制限文字数以降の文の末尾を...にして返却
            content.textContent =
                content.textContent.substring(0, MAX_LENGTH) + "...";
            content.after(more_looking_button[index]);
            more_looking_button[index].appendChild(child[index]);

            // クリックイベントリスナーを追加
            more_looking_button[index].addEventListener("click", () => {
                content.textContent = text[index];
                more_looking_button[index].remove();
            });
        }
    });
}

// 引数でcontent.textContentをstringという変数名で受け取る。
function checkTextLengthOver(text, maxLength = 20) {
    // 最大値の設定(デフォルトは20)
    const MAX_LENGTH = maxLength;
    // もしstringの文字数がMAX_LENGTH（今回は20）より大きかったらTrue
    //　文字数がオーバーしていなければfalseを返す
    if (text.length > MAX_LENGTH) {
        return true;
    } else {
        return false;
    }
}
