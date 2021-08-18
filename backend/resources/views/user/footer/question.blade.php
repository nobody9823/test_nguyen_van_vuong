@extends('user.layouts.base')

@section('title', 'FAQ')

@section('css')
<style>

</style>
@endsection

@section('content')


<ol class="breadcrumb inner" itemscope itemtype="https://schema.org/BreadcrumbList">
    <li class="breadcrumb__list" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a class="breadcrumb__text" itemprop="item" href="ホームのURL">
            <span itemprop="name">FanReturn ヘルプ</span>
        </a>
        <meta itemprop="position" content="1" />
    </li><!-- /.breadcrumb__list -->

    <li class="breadcrumb__list" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a class="breadcrumb__text" itemprop="item" href="カテゴリー1のURL">
            <span itemprop="name">FanReturnとは</span>
        </a>
        <meta itemprop="position" content="2" />
    </li><!-- /.breadcrumb__list -->
</ol><!-- /.breadcrumb -->

<div class="content inner">

    <aside class="question-sidebar">
        {{-- SPのとき --}}
        <div class="question-sidebar__inner is-sp">
            <h3 class="question-sidebar__title js-question-sidebar__title">このセクションの記事<span class="question-sidebar__title-angle is-sp"><i class="fas fa-chevron-down"></i></span></h3>
            <ul class="question-sidebar__list js-question-sidebar__list">
                <li class="question-sidebar__list__item"><a href="#">システム利用料について</a><span>＞</span></li>
                <li class="question-sidebar__list__item"><a href="#">対応している決済方法について</a><span>＞</span></li>
                <li class="question-sidebar__list__item"><a href="#">海外からの支援について</a><span>＞</span></li>
                <li class="question-sidebar__list__item"><a href="#">寄付型クラウドファンディングについて</a><span>＞</span></li>
            </ul><!-- /.question-sidebar__list -->
        </div><!-- /.question-sidebar__inner -->
        {{-- PCのとき --}}
        <div class="question-sidebar__inner is-pc">
            <h3 class="question-sidebar__title">このセクションの記事<span class="question-sidebar__title-angle is-sp"><i class="fas fa-chevron-down"></i></span></h3>
            <ul class="question-sidebar__list">
                <li class="question-sidebar__list__item"><a href="#">システム利用料について</a><span>＞</span></li>
                <li class="question-sidebar__list__item"><a href="#">対応している決済方法について</a><span>＞</span></li>
                <li class="question-sidebar__list__item"><a href="#">海外からの支援について</a><span>＞</span></li>
                <li class="question-sidebar__list__item"><a href="#">寄付型クラウドファンディングについて</a><span>＞</span></li>
            </ul><!-- /.question-sidebar__list -->

        </div><!-- /.question-sidebar__inner -->

    </aside><!-- /.question-sidebar -->

    <main class="question-main">

        <section class="about">
            <h2 class="about__title">FanReturnとは</h2>
            <time class="about__date" datetime="2021-06-08">2021.6.8</time>
            <p class="about__img-wrapper"><img src="{{ asset('image/logo-color.svg') }}" alt="FanReturn"></p>
            <p class="about__text sp-text-center">イベントを開きたい…<br class="is-sp">オリジナルグッズを作りたい…<br>そんなインフルエンサーの“やりたい”を叶える<br class="is-sp">クラウドファンディングサービスです。</p>
            <ul class="about-fanreturn__list">
                <li class="about-fanreturn__item">
                    <p class="about-fanreturn__item__text">オリジナルTシャツを<br>作りたい！</p>
                    <img class="about-fanreturn__img" src="{{ asset('image/about-shirt.svg') }}" alt="オリジナルTシャツを作りたい！">
                </li><!-- /.about-fanreturn__item -->
                <li class="about-fanreturn__item">
                    <p class="about-fanreturn__item__text">ファンイベントを<br>開きたい！</p>
                    <img class="about-fanreturn__img" src="{{ asset('image/about-event.svg') }}" alt="ファンイベントを開きたい！">
                </li><!-- /.about-fanreturn__item -->
                <li class="about-fanreturn__item">
                    <p class="about-fanreturn__item__text">写真集を<br>だしたい！</p>
                    <img class="about-fanreturn__img is-pc" src="{{ asset('image/about-book.svg') }}" alt="写真集をだしたい！">
                    <img class="about-fanreturn__img is-sp" src="{{ asset('image/about-book-sp.svg') }}" alt="写真集をだしたい！">
                </li><!-- /.about-fanreturn__item -->
                <li class="about-fanreturn__item">
                    <p class="about-fanreturn__item__text">コンサートを<br>開きたい！</p>
                    <img class="about-fanreturn__img is-pc" src="{{ asset('image/about-mike.svg') }}" alt="コンサートを開きたい！">
                    <img class="about-fanreturn__img is-sp" src="{{ asset('image/about-mike-sp.svg') }}" alt="コンサートを開きたい！">
                </li><!-- /.about-fanreturn__item -->
                <li class="about-fanreturn__item">
                    <p class="about-fanreturn__item__text">楽曲やMVの<br>制作をしたい！</p>
                    <img class="about-fanreturn__img is-pc" src="{{ asset('image/about-music.svg') }}" alt="楽曲やMVの制作をしたい！">
                    <img class="about-fanreturn__img is-sp" src="{{ asset('image/about-music-sp.svg') }}" alt="楽曲やMVの制作をしたい！">
                </li><!-- /.about-fanreturn__item -->
                <li class="about-fanreturn__item">
                    <p class="about-fanreturn__item__text">マグカップを<br>作りたい！</p>
                    <img class="about-fanreturn__img is-pc" src="{{ asset('image/about-teacup.svg') }}" alt="マグカップを作りたい！">
                    <img class="about-fanreturn__img is-sp" src="{{ asset('image/about-teacup-sp.svg') }}" alt="マグカップを作りたい！">
                </li><!-- /.about-fanreturn__item -->
                <li class="about-fanreturn__item">
                    <p class="about-fanreturn__item__text">オンライン教室<br>を開きたい！</p>
                    <img class="about-fanreturn__img" src="{{ asset('image/about-smartPhone.svg') }}" alt="オンライン教室を開きたい！">
                </li><!-- /.about-fanreturn__item -->
                <li class="about-fanreturn__item">
                    <p class="about-fanreturn__item__text">オリジナルブランド<br>を作りたい！</p>
                    <img class="about-fanreturn__img" src="{{ asset('image/about-highHeels.svg') }}" alt="オリジナルブランドを作りたい！">
                </li><!-- /.about-fanreturn__item -->
            </ul><!-- /.about-fanreturn__list -->
            <h3 class="about__sub-title">事前予約制のため、<br class="is-sp">リスクなく実施することが可能です。</h3>
            <p class="about__text">また、FanReturnという名の通り、インフルエンサーがもっとも大事にするファンへの特別なリターンの仕組みを用意しています。それが「プロジェクトサポーター（PS）」です。</p>
            <p class="about__text">インフルエンサーのプロジェクトをファンが拡散すればするほど、ファンはインフルエンサーから特別なリターンがもらえるというサービスです。</p>
            <p class="about__text">インフルエンサーにとってもファンにとってもメリットのあるPSの仕組みは、より強固なWIN-WINの関係を築くことができます。PSは他のクラウドファンディングにはありません。<br>インフルエンサーに特化したFanReturnだからこそできるサービスです。</p>
            <p class="about__text about__text--url">詳しくは「プロジェクトサポーター（PS）とは」をご覧ください。<br><a href="#">URL：</a></p>
            <p class="about__text">「イベントを開きたい」「オリジナルグッズを作りたい」、でもどのくらい人が集まるか不安、金銭面が不安と悩んでいるインフルエンサーの皆さま、ぜひFanReturnをご活用ください。</p>
            <p class="about__text about-with-fanreturn__title">FanReturnを使えば…</p>
            <ul class="about-with-fanreturn__list">
                <li class="about-with-fanreturn__item">
                    <p class="about-with-fanreturn__text">夢への加速度UP！</p>
                </li><!--/.about-with-fanreturn__item -->
                <li class="about-with-fanreturn__item">
                    <p class="about-with-fanreturn__text">ファンの満足度UP！</p>
                </li><!--/.about-with-fanreturn__item -->
                <li class="about-with-fanreturn__item">
                    <p class="about-with-fanreturn__text">新規ファン獲得！</p>
                </li><!--/.about-with-fanreturn__item -->
                <li class="about-with-fanreturn__item">
                    <p class="about-with-fanreturn__text">ファンと共にやりたいことを形にできる！</p>
                </li><!--/.about-with-fanreturn__item -->
                <li class="about-with-fanreturn__item">
                    <p class="about-with-fanreturn__text">安定したインフルエンサー活動ができる！</p>
                </li><!--/.about-with-fanreturn__item -->
            </ul><!-- /.about-with-fanreturn__list -->
        </section>

        <section class="about-project">
            <h2 class="about-project__title">PROJECT</h2><!-- /.about-project__title -->
            <h3 class="about-project__sub-title">プロジェクト実施の流れ</h3>
            <p class="about-project__txt"><span>01</span>プロジェクト内容の打ち合わせ</p>
            <span class="about-project__down-arrow"><i class="fas fa-caret-down"></i></span>
            <p class="about-project__txt"><span>02</span>プロジェクト内容&リターン内容の入力</p>
            <span class="about-project__down-arrow"><i class="fas fa-caret-down"></i></span>
            <p class="about-project__txt"><span>03</span>目標金額を設定</p>
            <span class="about-project__down-arrow"><i class="fas fa-caret-down"></i></span>
            <p class="about-project__txt"><span>04</span>プロジェクトをスタート</p>
            <span class="about-project__down-arrow"><i class="fas fa-caret-down"></i></span>
            <p class="about-project__txt"><span>05</span>プロジェクトリターンの実施</p>
        </section><!-- /.about-project -->


    </main>
</div><!-- /.content -->


@endsection


@section('script')
<script>
$(function(){
    $(".js-question-sidebar__title").on("click", function() {
        $(".js-question-sidebar__list").slideToggle();
    });
});
</script>
@endsection