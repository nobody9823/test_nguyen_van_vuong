<!doctype html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ログイン | 管理者</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
<div id="app">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">ログイン</div>
                    <div class="card-body">
                        {{ Form::open(['route' => 'admin.login']) }}
                        <div class="form-group">
                            {{ Form::label('email', 'メールアドレス') }}
                            {{ Form::text('email', null, [
                                'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '')
                            ]) }}
                            @error('email')
                            <div class="invalid-feedback" style="color: red; display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            {{ Form::label('password', 'パスワード') }}
                            {{ Form::password('password', [
                                'class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : '')
                            ]) }}
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">ログイン</button>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
