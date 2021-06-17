<!DOCTYPE html>
<html lang="ja">
    <body>
        <p>
            {{ $user->name }}様
        </p>
        <p>パスワードの変更をお願いいたします。</p>
        <p>
            <a href="{{ $url }}">パスワード変更フォームはこちら</a>
        </p>
    </body>
</html>