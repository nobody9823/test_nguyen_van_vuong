// 存在しない日付を選択させない関数
// チェックしたい要素のonchangeに指定
// 利用例
/* <select id="birth_month" class="form-control" name="end_month" onchange="dateValidation(this, 'end_year', 'end_month', 'end_day')"> */
function dateValidation(element, year, month, day) {
    var year = document.getElementsByName(year)[0].value;
    var month = document.getElementsByName(month)[0].value;
    var day = document.getElementsByName(day)[0].value;
    if (year && month && day) {
        var date = new Date(year, month - 1, day);
        if (
            date.getFullYear() != year ||
            date.getMonth() != month - 1 ||
            date.getDate() != day
        ) {
            return (element.value = "");
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

function omit2(targetClassName) {
    $("." + targetClassName).each(function (e) {
        let $comment = $(this);
        // 元の文章を変数に格納
        let comment = $comment.html();
        let length = comment.length;
        let commentShow;
        let commentText;
        if ($comment.height() > 30) {
            // 文章の要素の高さが100を超えていたら隠す用のisHiddenクラスを付与
            $comment.addClass("isHidden");

            // ウィンドウ幅が768px以上の時の処理（PC表示）
            if (window.matchMedia("(min-width: 768px)").matches) {
                commentShow = comment
                    .replace(/<br>/g, "\u00a0")
                    .substring(0, 86);
                commentText = commentShow +=
                    '<span class="' +
                    targetClassName +
                    '">' +
                    "...続きを読む" +
                    "</span>";
                $comment.html(commentText);
            } else {
                // ウィンドウ幅が768px以下の時の処理（スマホ表示）
                commentShow = comment
                    .replace(/<br>/g, "\u00a0")
                    .substring(0, 68);
                commentText = commentShow +=
                    '<span class="' +
                    targetClassName +
                    '">' +
                    "...続きを読む" +
                    "</span>";
                $comment.html(commentText);
            }
            // 続きを読むをクリックで元の文章を表示
            $comment.on("click", "." + targetClassName, function (e) {
                let $anchor = $(e.currentTarget);
                let $anchorParent = $anchor.parent();
                $anchorParent.removeClass("isHidden");
                $anchorParent.html(""); // 一旦空にする
                $anchorParent
                    .html(comment)
                    .append(
                        '<span class="' +
                            targetClassName +
                            '">' +
                            "閉じる" +
                            "</span>"
                    );
                // 閉じるをクリックで元に戻す
                $("." + targetClassName).on("click", function (e) {
                    let $anchorHide = $(e.currentTarget).parent();
                    $anchorHide.addClass("isHidden");
                    $anchorHide.html("");
                    $anchorHide.html(commentText);
                });
            });
        }
    });
}
