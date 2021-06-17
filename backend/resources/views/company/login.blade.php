<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ログイン | 企業</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body>
    @if (session('flash_message'))
    <div class="ext-center text-center" style="background-color: #38c172; color: #ffffff;">
        {{ session('flash_message') }}
    </div>
    @endif
    <div id="app">
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-md-6">
                    <ul class="nav nav-tabs">
                        <li class="nav-item nav-pills">
                            <a class="nav-link active" href="#company" data-toggle="tab">企業としてログイン</a>
                        </li>
                        <li class="nav-item nav-pills">
                            <a class="nav-link" href="#talent" data-toggle="tab">タレントとしてログイン</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="company">
                            <div class="card">
                                <div class="card-body">
                                    {{ Form::open(['route' => 'company.login']) }}
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
                                    <div>
                                        <a href="{{ route('company.pre_create') }}">新規登録はこちら</a>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="talent">
                            <div class="card">
                                <div class="card-body">
                                    {{ Form::open(['route' => 'talent.login']) }}
                                    <div class="form-group">
                                        {{ Form::label('email', 'メールアドレス') }}
                                        {{ Form::text('email', null, [
                                        'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '')
                                    ]) }}
                                        @error('name')
                                        <div class="invalid-feedback">
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
                                    <div>
                                        <a href="/talent/register">新規登録はこちら</a>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
