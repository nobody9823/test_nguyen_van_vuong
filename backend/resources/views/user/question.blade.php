@extends('user.layouts.base')

@section('title', 'FAQ')

@section('css')
<style type="text/css">
    .question_sections{
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    .question_section{
        width: 45%;
    }
    .question{
        width: 100%;
        margin-bottom: 30px;
    }
    .question label{
        padding: 5px;
        font-weight: bold;
        cursor :pointer;
    }
    .question input {
        display: none;
    }
    .question .hidden_show {
        height: 0;
        padding: 0;
        overflow: hidden;
        opacity: 0;
        transition: 0.8s;
    }
    .question input:checked ~ .hidden_show {
        padding: 10px 0;
        height: auto;
        opacity: 1;
    }
    .sec-sub-ttl{
        font-size: 20px;
        margin-bottom: 10px;
        border-left: 5px solid #ff1493;
        padding: 0 0 0 10px;
        margin-top: 20px;
    }
</style>
@endsection

@section('content')
<div class="content">
    <div class="section">
        <div class="fixedcontainer">
            <h2 class="sec-ttl">よくある質問</h2>
            <p>質問をクリックしていただくと回答を見ることができます。</p>
            <div class="question_sections">
                <div class="question_section">
                    <h4 class="sec-sub-ttl">初めての方</h4>
                        <div class="question_lists">
                        <div class="question">
                            <label for="label1">ガーディアンとは ▼</label>
                            <input type="checkbox" id="label1"/>
                            <div class="hidden_show">
                                <p>
                                    ガーディアンとは、みんなの力でアイドルを救うためのクラウドファンディングサイトです。
                                </p>
                            </div>
                        </div>
                        <div class="question">
                            <label for="label2">応援プロジェクトとは ▼</label>
                            <input type="checkbox" id="label2"/>
                            <div class="hidden_show">
                                <p>
                                    応援プロジェクトを支援してクラウドファンディングを行うことで、<br>
                                    誹謗中傷などにより活動が困難になってしまったアイドルを救うことができます。
                                </p>
                            </div>
                        </div>
                        <div class="question">
                            <label for="label3">他のサイトとどこが違いますか ▼</label>
                            <input type="checkbox" id="label3"/>
                            <div class="hidden_show">
                                <p>
                                    アイドルを救う事に特化したサービスを扱っています。
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="question_section">
                    <h4 class="sec-sub-ttl">アカウントについて</h4>
                    <div class="question_lists">
                    <div class="question">
                            <label for="label4">どこから新規会員登録できますか ▼</label>
                            <input type="checkbox" id="label4"/>
                            <div class="hidden_show">
                                <p>
                                    ページの右上にある「会員登録」をクリックしていただけると登録画面に進みます。
                                </p>
                            </div>
                        </div>
                        <div class="question">
                            <label for="label5">会員登録すると何ができますか ▼</label>
                            <input type="checkbox" id="label5"/>
                            <div class="hidden_show">
                                <p>
                                    応援プロジェクトを支援してクラウドファンディングができるようになります。
                                </p>
                            </div>
                        </div>
                        <div class="question">
                            <label for="label6">マイページとはなんですか ▼</label>
                            <input type="checkbox" id="label6"/>
                            <div class="hidden_show">
                                <p>
                                    ユーザー情報の管理、支援した応援プロジェクト、投稿したプロジェクトの確認などができます。<br>
                                    ページの右上にある「ログイン」を押していただくとログイン画面に進みます。
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="question_section">
                    <h4 class="sec-sub-ttl">決済方法について</h4>
                    <div class="question_lists">
                        <div class="question">
                            <label for="label10">クレジットカードの引き落とし日はいつですか ▼</label>
                            <input type="checkbox" id="label10"/>
                            <div class="hidden_show">
                                <p>
                                    クレジットカードで支援して頂いた場合、基本的に即時決済完了となります。
                                    引き落とし日は、それぞれのカード会社によって異なるため、お持ちのカードの引き落とし条件をご確認いただくか、カード会社へ直接ご確認をお願い致します。
                                </p>
                            </div>
                        </div>
                        <div class="question">
                            <label for="label11">分割で支払いはできますか ▼</label>
                            <input type="checkbox" id="label11"/>
                            <div class="hidden_show">
                                <p>
                                    クレジットカードの分割払いのご指定ができかねます。ご了承ください。
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection