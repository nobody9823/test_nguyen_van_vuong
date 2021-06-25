@if($requestType() === 'name')
    <a href="{{ route('user.profile') }}">戻る</a>
    <h3>ユーザー名</h3>
    <form action="{{ route('user.update_profile', ['user' => Auth::user()]) }}" method="POST">
        @method('PATCH')
        @csrf
        <label>ユーザー名</label>
        <input name="name" type="text" placeholder="UserId"/>
        <button type="submit">変更する</button>
    </form>
@elseif($requestType() === 'email')
    <a href="{{ route('user.profile') }}">戻る</a>
    <h3>メールアドレス</h3>
    <form action="{{ route('user.update_profile', ['user' => Auth::user()]) }}" method="POST">
        @method('PATCH')
        @csrf
        <p>現在のメールアドレス</p>
        <p>{{ Auth::user()->email }}</p>
        <label>新しいメールアドレス※半角英数字のみ</label>
        <input name="email" type="email"/>
        <label>新しいメールアドレス（確認用）※コピー＆ペースト不可</label>
        <input name="email_confirmation" type="email"/>
        <button type="submit">変更する</button>
    </form>
@elseif($requestType() === 'password')
    <a href="{{ route('user.profile') }}">戻る</a>
    <h3>パスワード</h3>
    <form action="{{ route('user.update_profile', ['user' => Auth::user()]) }}" method="POST">
        @method('PATCH')
        @csrf
        <a href="{{ route('user.profile', ['input_type' => 'forgot_password']) }}">
            パスワードを忘れた方はこちら
        </a>
        <label>現在のパスワード</label>
        <input name="current_password" type="password"/>
        <label>新しいパスワード※6文字以上の半角英数字記号</label>
        <input name="new_password" type="password"/>
        <label>新しいパスワード（確認用）※コピー＆ペースト不可</label>
        <input name="new_password_confirmation" type="password"/>
        <button type="submit">変更する</button>
    </form>
@elseif($requestType() === 'forgot_password')
    <a href="{{ route('user.profile') }}">戻る</a>
    <h3>パスワード再設定</h3>
    <form action="{{ route('user.send_reset_password_mail') }}" method="POST">
        @csrf
        <label>メールアドレスを入力</label>
        <input name="email" type="email" placeholder="メールアドレス"/>
        <button type="submit">再設定メールを送信</button>
        <p>会員登録時にご登録して頂いたメールアドレスを入力してください。パスワード再発行手続きのメールを送信します。</p>
    </form>
@elseif($requestType() === 'birthday')
    <a href="{{ route('user.profile') }}">戻る</a>
    <h3>生年月日</h3>
    <form action="{{ route('user.update_profile', ['user' => Auth::user()]) }}" method="POST">
        @method('PATCH')
        @csrf
        <label>年</label>
        <select>
            <option></option>
        </select>
        <label>月</label>
        <select>
            <option></option>
        </select>
        <label>日</label>
        <select>
            <option></option>
        </select>
        <label>公開設定</label>
        <select>
            <option></option>
        </select>
        <button type="submit">変更する</button>
    </form>
@elseif($requestType() === 'gender')
    <a href="{{ route('user.profile') }}">戻る</a>
    <h3>性別</h3>
    <form action="{{ route('user.update_profile', ['user' => Auth::user()]) }}" method="POST">
        @method('PATCH')
        @csrf
        <label>性別</label>
        <select name="gender">
            <option value="男性">男性</option>
            <option value="女性">女性</option>
            <option value="その他">その他</option>
        </select>
        <label>公開設定</label>
        <select name="gender_is_published">
            <option value="">公開する</option>
            <option value="">公開しない</option>
        </select>
        <button type="submit">変更する</button>
    </form>
@elseif($requestType() === 'introduction')
    <a href="{{ route('user.profile') }}">戻る</a>
    <h3>自己紹介</h3>
    <form action="{{ route('user.update_profile', ['user' => Auth::user()]) }}" method="POST">
        @method('PATCH')
        @csrf
        <label>自己紹介</label>
        <textarea name="introduction"></textarea>
        <button type="submit">変更する</button>
    </form>
@else
    <form action="{{ route('user.update_profile', ['user' => Auth::user()]) }}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <input type="file" name="image_url"/>
        <button type="submit">プロフィール画像を編集する</button>
    </form>
    <a href="{{ route('user.profile', ['input_type' => 'name']) }}">ユーザー名</a>
    <a href="{{ route('user.profile', ['input_type' => 'email']) }}">メールアドレス</a>
    <a href="{{ route('user.profile', ['input_type' => 'password']) }}">パスワード</a>
    <a href="{{ route('user.profile', ['input_type' => 'birthday']) }}">生年月日</a>
    <a href="{{ route('user.profile', ['input_type' => 'gender']) }}">性別</a>
    <a href="{{ route('user.profile', ['input_type' => 'introduction']) }}">自己紹介</a>
@endif
