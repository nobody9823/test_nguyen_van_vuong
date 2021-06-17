<!DOCTYPE html>
<html lang="ja">

<body>
    <p>
        この度はガーディアンに仮登録いただき誠にありがとうございます。<br>
        以下のURLからログインして、本登録申請をお願い致します。有効期限は1時間です。<br>
        <a href="{{route('talent.create',['token' => $token])}}">本登録申請画面へ移動する</a>
    </p>
</body>

</html>
