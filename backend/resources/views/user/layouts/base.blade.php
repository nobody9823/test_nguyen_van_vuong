<!DOCTYPE HTML>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <title></title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/slick-theme.css') }}" />
    <link href="{{ asset('css/normalize.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/sm-core-css.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/sm-clean.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/mypage.css') }}" type="text/css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <!--★-->
    <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c" rel="stylesheet">
    <!--★-->
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    @yield('css')
</head>

<body id="pagetop">

    <!--▼★header-->
    <header>
        <div class="header_in">
            <div class="fixedcontainer">
                <div class="logo"><a href="/"><img src="/image/g_logo-01.svg"></a><br><span
                        class="logo_txt">みんなのチカラでアイドルを救え</span></div>
                <div class="header_right">
                    @auth


                    <a href="{{ route('user.plan') }}" id="mypage-js" class="main_menu">マイページ</a>
                    <ul class="main_menu-body">
                        <li><a href="{{ route('user.plan') }}">支援プラン一覧</a></li>
                        <li><a href="{{ route('user.comment') }}">支援コメント一覧</a></li>
                        <li><a href="{{ route('user.project') }}">お気に入り<br>プロジェクト一覧</a></li>
                    </ul>


                    <a href="logout" class="main_menu" onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                        ログアウト</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                    @else
                    <a href="/login" class="main_menu">ログイン</a>
                    <a href="{{ route('user.pre_create') }}" class="main_menu">会員登録</a>
                    @endauth
                </div>
                <div class="header_left" id="header_left">
                    <a href="/search" id="search" class="main_menu">応援プロジェクト <i class="fas fa-caret-down fc_i_01"></i><i
                            class="fas fa-caret-up fc_i_02" style="display: none;"></i></a>
                    <x-user.sub-menu />
                    <x-user.word-search route="user.search" />
                </div>
            </div>
        </div>
    </header>
    <!--▲★header-->

    @if (session('flash_message'))
    <div class="text-center" style="background-color: #38c172; color: #ffffff; font-size: 200%;">
        {{ session('flash_message') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="error-message text-center">
        <ul class="error-message-list">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @yield('content')
    <a href="#pagetop" class="fixed_bottom"><img src="/image/gotop.png"></a>
    <footer>
        <div class="fixedcontainer">
            <div class="footer_in1">
                <div>
                    <p><a href="{{ route('user.search') }}">応援プロジェクト</a></p>
                    <ul>
                        <li><a href="{{ route('user.question') }}">応援プロジェクトとは</a></li>
                        <li><a href="{{ route('user.search') }}">プロジェクト検索</a></li>
                    </ul>
                    <p><a href="{{ route('user.question') }}">初めての方</a></p>
                    <ul>
                        <li><a href="{{ route('user.question') }}">初めての応援</a></li>
                    </ul>
                </div>
                <div>
                    <p><a href="https://plus-p.jp/">ガーディアン運営</a></p>
                    <ul>
                        <li><a href="https://plus-p.jp/company/">企業情報</a></li>
                        <li><a href="{{ route('user.terms') }}">利用規約</a></li>
                        <li><a href="{{ route('user.privacy_policy') }}">プライバシーポリシー</a></li>
                        <li><a href="{{ route('user.tradelaw') }}">特定商取引法に基づく表示</a></li>
                    </ul>
                </div>
                <div>
                    <p><a href="https://plus-p.jp/contact/">カスタマーサービス</a></p>
                    <ul>
                        <!-- TODO:今後の仕様次第ですが、メルマガ機能を搭載する事になれば、コメントアウトを解除します。 -->
                        <!-- <li><a href="{{ route('register') }}">メールマガジン</a></li> -->
                        <li><a href="{{ route('user.question') }}">FAQ</a></li>
                        <li><a href="{{ route('user.inquiry.create') }}">お問い合わせ</a></li>
                    </ul>
                </div>
                <div>
                    <p><a href="https://plus-p.jp/contact/">掲載希望者の方へ</a></p>
                    {{--                <p><a href="">オンラインストア</a></p>--}}
                    {{--                <ul>--}}
                    {{--                    <li><a href="">ガーディアンストア</a></li>--}}
                    {{--                </ul>--}}
                </div>
            </div>
            <div class="footer_in2">
                <div class="hidden-sp">
                    <a
                        href="https://m.facebook.com/pages/category/Local-Business/%E6%A0%AA%E5%BC%8F%E4%BC%9A%E7%A4%BE%E3%83%97%E3%83%AA%E3%83%A5-1429949117018781/"><img
                            src="/image/facebook.svg"></a>
                    <a href="https://twitter.com/plus_prstaff"><img src="/image/twitter.svg"></a>
                    <a href="https://line.me/R/ti/p/%40fvm7035p"><img src="/image/line.svg"></a>
                    <a href="https://www.instagram.com/plus_staff/"><img src="/image/instagram.svg"></a>
                </div>
                <div class="visible-sp">
                    <a
                        href="https://m.facebook.com/pages/category/Local-Business/%E6%A0%AA%E5%BC%8F%E4%BC%9A%E7%A4%BE%E3%83%97%E3%83%AA%E3%83%A5-1429949117018781/"><img
                            src="/image/facebook.png"></a>
                    <a href="https://twitter.com/plus_prstaff"><img src="/image/twitter.png"></a>
                    <a href="https://line.me/R/ti/p/%40fvm7035p"><img src="/image/line.png"></a>
                    <a href="https://www.instagram.com/plus_staff/"><img src="/image/instagram.png"></a>
                </div>
            </div>
            <div class="footer_in3">
                <p><a href="">サイトマップ</a>　<a href="https://recruit-41e63.web.app/policy">プライバシーポリシー</a>　<a
                        href="{{ route('user.inquiry.create') }}">お問い合わせ</a>　<a
                        href="https://recruit-41e63.web.app/terms">サイトご利用規約</a></p>
                <p>Copyright © plus-p.work Co., Ltd. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!--▼★-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/slick.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.smartmenus.min.js') }}"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-smooth-scroll/2.2.0/jquery.smooth-scroll.min.js"></script>
    @yield('script')
    <script>
        $(document).ready(function () {
        $('a').smoothScroll();
        $(window).scroll(function () {

            var $height = $(window).scrollTop();

            if ($height > 50) {
                $('.fixed_bottom').show();
            } else {
                $('.fixed_bottom').hide();
            }
        });

        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav-in'
        });
        $('.slider-nav-in').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: false,
            centerMode: true,
            centerPadding: '0',
            focusOnSelect: true,
            arrows: false,
        });
        $('.project-banner-slider').slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            arrows: true,
            responsive: [
                {
                    breakpoint: 999,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }
            ]
        });

        // ヘッダーのマイページにホバーした際にメニューを表示する
        $("#mypage-js").hover(
            function () {
                $(".main_menu-body").addClass("main_menu-body-display");
            },
            function () {
                $(".main_menu-body").removeClass("main_menu-body-display");
            }
        );
        $(".main_menu-body").hover(
            function () {
                $(".main_menu-body").addClass("main_menu-body-display");
            },
            function () {
                $(".main_menu-body").removeClass("main_menu-body-display");
            }
        );


        //detail.html用
        $('.detail-slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            fade: true,
            asNavFor: '.detail-slider-nav',
        });
        $('.detail-slider-nav').slick({
            slidesToShow: 7,
            slidesToScroll: 1,
            asNavFor: '.detail-slider-for',
            dots: false,
            focusOnSelect: true,
            centerPadding: '0',
            arrows: false,
        });

        //detail.html用　タブ用slick修正
        var tab_2_slider_01_01 = $('.news-imgs-for1').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            centerMode: true,
            centerPadding: '50px',
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        centerMode: false
                    }
                }
            ]
        });
        var tab_2_slider_01_02 = $('.news-imgs-nav1').slick({
            slidesToShow: 7,
            slidesToScroll: 1,
            dots: false,
            centerPadding: '0',
            focusOnSelect: true,
            arrows: false,
        });
        var tab_2_slider_02_01 = $('.news-imgs-for2').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            centerMode: true,
            centerPadding: '50px',
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        centerMode: false
                    }
                }
            ]
        });
        var tab_2_slider_02_02 = $('.news-imgs-nav2').slick({
            slidesToShow: 7,
            slidesToScroll: 1,
            dots: false,
            centerPadding: '0',
            focusOnSelect: true,
            arrows: false
        });
        $('input[name="detail_tab_item"]').change(function () {
            tab_2_slider_01_01.slick('setPosition');
            tab_2_slider_01_02.slick('setPosition');
            tab_2_slider_02_01.slick('setPosition');
            tab_2_slider_02_02.slick('setPosition');
        });


        //ヘッダーボタン（応援プロジェクト用）
        $.fn.clickToggle = function (a, b) {
            return this.each(function () {
                var clicked = false;
                $(this).on('click', function () {
                    clicked = !clicked;
                    if (clicked) {
                        return a.apply(this, arguments);
                    }
                    return b.apply(this, arguments);
                });
            });
        };

        $('#search').clickToggle(function () {
            $(this).next('.header_submenu').slideDown(300);
            $(this).css({'color': '#ff1493', 'border-bottom': '3px solid #ff1493'});
            $('.fc_i_01').css('display', 'none');
            $('.fc_i_02').css('display', 'inline-block');
        }, function () {
            $(this).next('.header_submenu').slideUp(300);
            $(this).css({'color': 'inherit', 'border-bottom': '3px solid #fff'});
            $('.fc_i_01').css('display', 'inline-block');
            $('.fc_i_02').css('display', 'none');
        });
        $("#search,.header_submenu")
            .mouseover(function () {
                $(".header_submenu").show();
            })
        $("#header_left,.header_submenu")
            .mouseleave(function () {
                $(".header_submenu").hide();
            });
        $(function() {
            $('#my-page_header-menu').smartmenus();
            $('#my-page_header-menu_sample').smartmenus();

        });

    });
    </script>
    <!--▲★-->

</body>

</html>
