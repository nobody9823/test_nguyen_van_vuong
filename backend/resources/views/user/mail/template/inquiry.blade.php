@extends('user.layouts.mail_template')

@section('content')
    <p style="white-space: pre-line;">
        {{ $inquiry->inquiry_content }}
    </p>

    <br>
    <h2>- - - - - - - - - - < お客様情報 > - - - - - - - - - -</h2>
    <ul>
        <li>氏名 &emsp;&emsp;&emsp;&emsp;&ensp; : &emsp; {{ $inquiry->name }}</li>
        <li>メールアドレス : &emsp; {{ $inquiry->email }}</li>
        <li>電話番号 &emsp;&emsp;&ensp;&thinsp;&thinsp;: &emsp; {{ $inquiry->tel }}</li>
    </ul>
    <h2>- - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</h2>
@endsection
