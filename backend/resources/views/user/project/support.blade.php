@extends('user.layouts.base')

@section('content')
<section id="Project-supporter-description" class="section_base">
    <div class=" def_inner inner_item">
        <div class="ps_desc_base">
        <div class="tit_L_01 E-font"><h2>SUPPORT</h2><div class="sub_tit_L">プロジェクトサポーター</div></div>

        <div class="ps_desc_L">
            <div class="ps_desc_row">
                <div class="ps_desc_L_tit">プロジェクトサポーターの方はこちら<div>プロジェクトを支援したい人</div></div>
                <div class="ps_desc_img"><img src="/image/fan_psd_L_01.svg"></div>
                <div class="ps_desc_img ps_desc_img_a"><img src="/image/fan_psd_arrow.svg"></div>
                <div class="ps_desc_txt">一緒に支援してくれる方を紹介 <br><span>※下記にある招待リンクから支援された場合にのみカウントされます</span></div>
                <div class="ps_desc_img"><img src="/image/fan_psd_L_02.svg"></div>
                <div class="ps_desc_img ps_desc_img_a"><img src="/image/fan_psd_arrow.svg"></div>
                <div class="ps_desc_txt">プロジェクトサポーターは支援総額と<br>件数によってランキングが表示される</div>
                <div class="ps_desc_img"><img src="/image/fan_psd_L_03.svg"></div>
                <div class="ps_desc_img ps_desc_img_a"><img src="/image/fan_psd_arrow.svg"></div>
                <div class="ps_desc_txt">プロジェクトサポーターとして<br>特別リターンをGET</div>
                <div class="ps_desc_img"><img src="/image/fan_psd_L_04.svg"></div>
            </div>
            <div class="ps_desc_arrow"></div>
        </div><!--/ps_desc_L-->

        <div class="ps_desc_R m_b_4030">
            <div class="ps_desc_row">
                <div class="ps_desc_R_tit">紹介された方はこちら<div>プロジェクトサポーターに紹介された人</div></div>
                <div class="ps_desc_img"><img src="/image/fan_psd_R_01.svg"></div>
                <div class="ps_desc_img ps_desc_img_a"><img src="/image/fan_psd_arrow.svg"></div>
                <div class="ps_desc_txt">プロジェクトサポーターに紹介されて<br>プロジェクトを一緒に支援する</div>
                <div class="ps_desc_img"><img src="/image/fan_psd_R_02.svg"></div>
                <div class="ps_desc_img ps_desc_img_a"><img src="/image/fan_psd_arrow.svg"></div>
                <div class="ps_desc_txt">プロジェクト実行者に支援する</div>
                <div class="ps_desc_img"><img src="/image/fan_psd_R_03.svg"></div>
                <div class="ps_desc_img ps_desc_img_a"><img src="/image/fan_psd_arrow.svg"></div>
                <div class="ps_desc_txt">支援することで<br>リターンGET</div>
                <div class="ps_desc_img"><img src="/image/fan_psd_R_04.svg"></div>
            </div>
            <div class="ps_desc_arrow"></div>
        </div><!--/ps_desc_R-->

        </div><!--/ps_desc_base-->

        <x-user.invitation-url :project="$project" />
        <x-user.supporter-ranking :project="$project" />

        {{-- <div class="other_kiji_box m_b_3020">
            <div class="other_kiji_tit_L">最近表示した記事</div>
            <div class="other_kiji_tit"><a href="">支援したプロジェクトが成立した後の流れ</a></div>
            <div class="other_kiji_tit"><a href="">領収書を発行してほしい</a></div>
            <div class="other_kiji_tit"><a href="">支援後に退会（アカウント削除）した場合どうなりますか？</a></div>
        </div><!--/other_kiji_box-->

        <div class="other_kiji_box m_b_3020">
            <div class="other_kiji_tit_L">関連記事</div>
            <div class="other_kiji_tit"><a href="">システム利用料について</a></div>
            <div class="other_kiji_tit"><a href="">対応している決済方法について</a></div>
            <div class="other_kiji_tit"><a href="">海外からの支援について</a></div>
            <div class="other_kiji_tit"><a href="">棋譜型クラウドファンディングについて</a></div>
        </div><!--/other_kiji_box--> --}}
    </div><!--/.inner_item-->
</section><!--/.section_base-->
@endsection

@section('script')
<script>
$(function() {
  $('#js-copybtn').on('click', function(){
    // コピーする文章の取得
    let text = $('#js-copytext').text();
    // テキストエリアの作成
    let $textarea = $('<textarea></textarea>');
    // テキストエリアに文章を挿入
    $textarea.text(text);
    //　テキストエリアを挿入
    $(this).append($textarea);
    //　テキストエリアを選択
    $textarea.select();
    // コピー
    document.execCommand('copy');
    // テキストエリアの削除
    $textarea.remove();
    // アラート文の表示
    $('#js-copyalert').show().delay(2000).fadeOut(400);
  });
});
</script>
@endsection
