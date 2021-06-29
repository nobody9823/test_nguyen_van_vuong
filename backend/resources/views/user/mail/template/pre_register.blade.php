<!DOCTYPE html>
<html lang="ja">

<body>
    <p>
        この度はFanReturnに仮登録いただき誠にありがとうございます。<br>
        以下のURLからログインして、本登録を完了させてください。有効期限は1時間です。<br>
        <a href="{{route('user.create',['token' => $token])}}">本登録画面へ移動する</a>
    </p>
</body>

</html>
