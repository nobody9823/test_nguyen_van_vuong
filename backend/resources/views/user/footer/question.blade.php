@extends('user.layouts.base')

@section('title', 'FAQ')

@section('css')
<style>

</style>
@endsection

@section('content')


<ol class="breadcrumb inner" itemscope itemtype="https://schema.org/BreadcrumbList">
    <li class="breadcrumb__list" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a class="breadcrumb__text" itemprop="item" href="#">
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

<div class="question-content inner">

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
            <h2 class="about-project__title">ABOUT</h2><!-- /.about-project__title -->
            <h3 class="about-project__sub-title">FanReturnとは</h3>
            <div class="about-item__wrapper">
                <div class="about-description__wrapper">
                    <div class="about-description__img-wrapper">
                        <img src="{{ asset('image/description_2_1.png') }}" alt="芸能人やインフルエンサーと企業・メディア・クリエイターをマッチング">
                    </div>
                    <div class="ps_description_title">
                        <p>芸能人やインフルエンサーと<br/>企業・メディア・クリエイターをマッチング</p>
                    </div>
                </div>
                <span class="about-project__down-arrow"><i class="fas fa-caret-down"></i></span>
                <div class="about-description__wrapper">
                    <div class="about-description__img-wrapper">
                        <img src="{{ asset('image/description_2_2.png') }}" alt="クラウドファンディングによってファンと共に夢を叶える">
                    </div>
                    <div class="ps_description_title">
                        <p>クラウドファンディングによってファンと共に夢を叶える</p>
                    </div>
                </div>
            </div>
            <!-- /.about-fanreturn__list -->
            <h3 class="about__sub-title">継続的かつ発展的な芸能活動を実現！</h3>
            <div class="about-expenses__wrapper">
                <div class="about-expenses__img-wrapper">
                    <img src="{{ asset('image/description_3_1.png') }}" alt="マッチング費用無料">
                </div>
                <div class="about-expenses__img-wrapper">
                    <img src="{{ asset('image/description_3_2.png') }}" alt="マッチング費用無料">
                </div>
                <div class="about-expenses__img-wrapper">
                    <img src="{{ asset('image/description_3_3.png') }}" alt="マッチング費用無料">
                </div>
            </div>
            <!-- /.about-with-fanreturn__list -->
        </section>

        <section class="about-project">
            <h2 class="about-project__title">PROJECT FLOW</h2><!-- /.about-project__title -->
            <h3 class="about-project__sub-title">プロジェクト実施の流れ</h3>
            <div class="about-publication__wrapper">
                <div class="about-publication__img-wrapper">
                    <img src="{{ asset('image/description_10_1.png') }}" alt="企業・メディア・クリエイターのエントリーページを作成">
                </div>
                <div class="about-publication__img-wrapper">
                    <img src="{{ asset('image/description_10_2.png') }}" alt="芸能人・インフルエンサーがエントリー">
                </div>
                <div class="about-publication__img-wrapper">
                    <img src="{{ asset('image/description_10_3.png') }}" alt="インフルエンサー選定後、FanReturn担当者を含めて打ち合わせクラウドファンディングを立ち上げる">
                </div>
                <div class="about-publication__img-wrapper">
                    <img src="{{ asset('image/description_10_4.png') }}" alt="目標達成後、プロジェクトとファンへのリターン実施">
                </div>
            </div>
        </section><!-- /.about-project -->

        <section class="abount-moneyflow">
            <div class="about-moneyflow__wrapper">
                <h2 class="about-project__title">AMOUNT FLOW</h2><!-- /.about-project__title -->
                <h3 class="about-project__sub-title">お金の流れ</h3>
                <img id="aboutMoneyFlowImage" src="" alt="">
            </div>
        </section><!-- /.about-moneyflow -->

        <section class="abount-lastmessage">
            <div class="about-moneyflow__wrapper">
                <h2 class="about-project__title">LAST MESSAGE</h2><!-- /.about-project__title -->
                <h3 class="about-project__sub-title">最後に</h3>
                <div>
                    <p class="about__text">
                        人気になる前の過程の段階で、現実的な経済面の厳しさや、継続する環境がつくれない、発展的な活動が見い出せないという理由で、夢を諦めていくタレントを五万と見てきました。
                    </p>
                    <p class="about__text">
                        売れるに正解はありません。しかし、売れないに正解はあります。それは途中で諦めてしまうことです。
                    </p>
                    <p class="about__text">
                        FanReturnは、より多くの方に継続的かつ発展的な芸能活動の支援ができるよう精進してまいります。
                    </p>
                    <p class="about__text abount-lastmessage__signature">FanReturnスタッフ一同</p>
                </div>
            </div>
        </section><!-- /.about-lastmessage -->

        <section id="ps_supporter_description" class="about-project-supporter">
            <h2 class="about-project-supporter__title">PROJECT SUPPORTER</h2><!-- /.about-project-supporter__title -->
            <h3 class="about-project-supporter__sub-title">プロジェクトサポーター(PS)とは</h3>
            <x-user.project.ps-description />
        </section>
    </main>
</div><!-- /.question-content -->


@endsection


@section('script')
<script>
let wideAboutMoneyImage = "{{ asset('image/description_18_1.png') }}";
let narrowAboutMoneyImage = "{{ asset('image/description_18_2.png') }}";
let aboutMoneyFlowImage = document.getElementById('aboutMoneyFlowImage');
if (window.innerWidth < 768) {
    aboutMoneyFlowImage.src = narrowAboutMoneyImage;
} else {
    aboutMoneyFlowImage.src = wideAboutMoneyImage;
}
$(function(){
    $(".js-question-sidebar__title").on("click", function() {
        $(".js-question-sidebar__list").slideToggle();
    });
});
</script>
@endsection
