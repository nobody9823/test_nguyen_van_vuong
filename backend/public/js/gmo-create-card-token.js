// カード番号フォームの生成
var cardno = document.getElementById("number-form");

// 有効期限フォームの生成
var expiremonth = document.getElementById("expiry-month");
var expireyear = document.getElementById("expiry-year");

// セキュリティコードフォームの生成
var securitycode = document.getElementById("cvc-form");

function execPurchase(response) {
    if (response.resultCode != "000") {
        // カード情報は念のため値を除去
        cardno.value = "";
        expiremonth.value = "";
        expireyear.value = "";
        securitycode.value = "";
        console.log(response.resultCode);
        alert("購入処理中にエラーが発生しました。カードの入力が正しいかもう一度ご確認ください。");
    } else {
        // カード情報は念のため値を除去
        cardno.value = "";
        expiremonth.value = "";
        expireyear.value = "";
        securitycode.value = "";
        // 予め購入フォームに用意した token フィールドに、値を設定
        //発行されたトークンは、有効期限が経過するか、一度 API で利用されると、無効となります。
        document.getElementById("payment_method_id").value = response.tokenObject.token;
        document.getElementById("purchaseForm").submit();
    }
}

function doPurchase() {
    if (document.getElementById("tab1").checked) {
        Multipayment.getToken({
            cardno: cardno.value,
            expire: `${expireyear.value}${expiremonth.value}`,
            securitycode: securitycode.value,
        }, execPurchase);
    } else {
        document.getElementById("payment_method_id").value = "";
        document.getElementById("purchaseForm").submit();
    }
}
