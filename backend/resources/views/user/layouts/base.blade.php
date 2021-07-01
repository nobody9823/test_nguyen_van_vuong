<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
<title></title>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
<link href="{{ asset('css/reset.css') }}" type="text/css" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" type="text/css" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&display=swap" rel="stylesheet">

</head>

<body>
<div id="wrapper" class="hfeed">


<div id="header_wrap" style="">
<header id="header">

<div id="branding">
	<div id="header_01">
		<div id="site-title">
			<a href="★" title="★" rel="home">
				<img class="h_logo_css" src="image/logo-color.svg">
			</a>
		</div>
	</div>
	<div id="header_03">


		<div id="wm_btn">
			<div class="menuset_03 wm_login_btn">
				<a href="★" class="">
					ログイン
				</a>
			</div>
			<div class="menuset_03 wm_signup_btn">
				<a href="★" class="">
					新規登録
				</a>
			</div>
		</div>

		<input type="checkbox" id="nav-tgl_clone" name="nav-tgl_clone" style="display: none;">
		<label for="nav-tgl" class="open nav-tgl-btn"><span></span></label>
		<label for="nav-tgl" class="close nav-tgl-btn"></label>

	</div>
</div>

<div id="menu">
<div class="global-navi">
<input type="checkbox" id="nav-tgl" name="nav-tgl">
<div class="drower-menu">
<div class="drower-menu-list">
    <nav id="js-header__nav " class="l-header__nav navgation_inner">
		<a href="★" title="★" rel="home" class="h_logo_css_sp">
			<img src="image/logo-white.svg">
		</a>

	    <div class="other_site_header"></div>
		<ul id="js-global-nav" class="p-global-nav main-menu menu_base taso_menu">

			<li class="menu-item nav_btn taso_li menuset_01">
				<a href="★" class="top_menu-1 nav_btn_link">
					<p class="nav_btn_tit_L">はじめる</p>
				</a>
			</li>
			<li class="menu-item nav_btn taso_li menuset_01">
				<a href="★" class="top_menu-1 nav_btn_link">
					<p class="nav_btn_tit_L">さがす</p>
				</a>
			</li>
			<li class="menu-item nav_btn taso_li menuset_01">
				<a href="★" class="top_menu-1 nav_btn_link">
					<p class="nav_btn_tit_L">ファンリターンとは</p>
				</a>
			</li>


			<li id="menu-item-2" class="menu-item menu-item-2 nav_btn menu-item-has-children taso_li menuset_02">
					<a href="#" id="top_menu-2" data-megamenu="js-megamenu2" class=" nav_btn_link taso_li_a">
						<label for="item_c_2" class="item_c">
							<div>
							<p class="nav_btn_tit_L">人気のタグ</p>
							</div>
						</label>
					</a>
				<input type="checkbox" id="item_c_2" style="display:none;">
				<input type="checkbox" id="ta_menu-2"><label for="ta_menu-2" class="taso_li_a_label"><span class="pd"><i class="fas fa-chevron-down"></i></span></label>
					<ul class="taso_ul pri_W_b taso_ul_ko" style="background: #fff; padding: 10px;">
						<li class="taso_li taso_li_ko ninki_tag_li">
							<div><a href="★"># テキスト</a></div>
							<div><a href="★"># テキスト</a></div>
							<div><a href="★"># テキスト</a></div>
							<div><a href="★"># テキスト</a></div>
							<div><a href="★"># テキスト</a></div>
						</li>
					</ul>
			</li>
			<li class="menu-item nav_btn taso_li menuset_02">
				<a href="★" class="top_menu-1 nav_btn_link">
					<p class="nav_btn_tit_L">全てのタグ</p>
				</a>
			</li>
			<li class="menu-item nav_btn taso_li menuset_02">
				<a href="★" class="top_menu-1 nav_btn_link">
					<p class="nav_btn_tit_L">応援したプロジェクト</p>
				</a>
			</li>
			<li class="menu-item nav_btn taso_li menuset_02">
				<a href="★" class="top_menu-1 nav_btn_link">
					<p class="nav_btn_tit_L">購入履歴</p>
				</a>
			</li>
			<li class="menu-item nav_btn taso_li menuset_02">
				<a href="★" class="top_menu-1 nav_btn_link">
					<p class="nav_btn_tit_L">お気に入り</p>
				</a>
			</li>
			<li class="menu-item nav_btn taso_li menuset_02">
				<a href="★" class="top_menu-1 nav_btn_link">
					<p class="nav_btn_tit_L">お問い合わせ</p>
				</a>
			</li>
			<li class="menu-item nav_btn taso_li menuset_02">
				<a href="★" class="top_menu-1 nav_btn_link">
					<p class="nav_btn_tit_L">よくあるご質問・ヘルプ</p>
				</a>
			</li>


			<li class="menu-item nav_btn taso_li menuset_03 login_btn">
				<a href="★" class="top_menu-1 nav_btn_link">
					<p class="nav_btn_tit_L">ログイン</p>
				</a>
			</li>
			<li class="menu-item nav_btn taso_li menuset_03 signup_btn">
				<a href="★" class="top_menu-1 nav_btn_link">
					<p>新規登録</p>
				</a>
			</li>

			<li class="menu-item nav_btn taso_li menuset_04 header_serch_box">
				<i class="fas fa-search"></i><input type="text" name="search_word" placeholder="キーワードを検索">
			</li>

		</ul>
	</nav>

</div><!--/drower-menu-list-->
</div><!--/drower-menu-->

</div>
</div><!--/#menu-->

<style>
.pc-details-screen_header{ display: flex; flex-wrap: wrap; align-items: center; align-content: center; width: 100%; font-size: 1.3rem; color:#00AEBD ;}
.pc-details-screen_header div{ width: 120px; padding: 15px 0; text-align: center;}
.pdsh_item{ position: relative;}
.pdsh_current{ border-bottom: solid 2px #00AEBD;}
</style>

<div class="pc-details-screen_header">
	<div class="pdsh_item pdsh_current">プロジェクト<a href="★" class="cover_link"></a></div>
	<div class="pdsh_item">活動レポート<a href="★" class="cover_link"></a></div>
	<div class="pdsh_item">応援コメント<a href="★" class="cover_link"></a></div>
</div>

</header>
</div>

<style>
/**他ページヘッダー**/
.pc-details-screen_header{ display: none;}
</style>


    @yield('content')



    <footer>
        <div class="footer_main">
            <div class="footer_main_inner">
                <div class="footer_main_01">
                    <div class="footer_tit">プロジェクトをさがす</div>
                    <div class="footer_item"><a href="★">カテゴリ</a></div>
                    <div class="footer_item"><a href="★">テキストテキスト</a></div>
                    <div class="footer_item"><a href="★">テキストテキストテキストテキスト</a></div>
                    <div class="footer_item"><a href="★">テキストテキスト</a></div>
                    <div class="footer_item"><a href="★">テキストテキストテキストテキストテキストテキスト</a></div>
                    <div class="footer_item"><a href="★">テキストテキスト</a></div>
                    <div class="footer_item"><a href="★">テキストテキストテキストテキスト</a></div>
                </div>

                <div class="footer_main_02">
                    <div class="footer_tit">プロジェクトをはじめる</div>
                    <div class="footer_item"><a href="★">プロジェクト掲載</a></div>
                    <div class="footer_item"><a href="★">プロジェクトを作る</a></div>
                </div>

                <div class="footer_main_03">
                    <div class="footer_tit">fanreturnについて</div>
                    <div class="footer_item"><a href="★">fanreturnとは</a></div>
                    <div class="footer_item"><a href="★">クラウドファンティングとは</a></div>
                    <div class="footer_item"><a href="★">ヘルプ</a></div>
                    <div class="footer_item"><a href="★">お問い合わせ</a></div>
                    <div class="footer_item"><a href="★">利用規約</a></div>
                    <div class="footer_item"><a href="★">細則</a></div>
                    <div class="footer_item"><a href="★">プライバシーポリシー</a></div>
                    <div class="footer_item"><a href="★">特定商取引法に基づく表記</a></div>
                    <div class="footer_item"><a href="★">情報セキュリティ方針</a></div>
                    <div class="footer_item"><a href="★">反社基本方針</a></div>
                    <div class="footer_sns_icon dis_f_wra_alc">
                        <a href="★"><img class="" src="image/sns_01.svg"></a>
                        <a href="★"><img class="" src="image/sns_02.svg"></a>
                        <a href="★"><img class="" src="image/sns_03.svg"></a>
                    </div>
                </div>
            </div><!--/.footer_inner-->
        </div><!--/.footer_main-->

        <div class="footer_under">
            <div class="footer_under_inner">
                <div class="footer_logo"><img class="h_logo_css" src="image/logo-color.svg"></div>
                <ul>
                    <li><a href="★">はじめる</a></li>
                    <li><a href="★">さがす</a></li>
                    <li><a href="★">ファンリターンとは</a></li>
                    <li><a href="★">ログイン</a></li>
                    <li><a href="★">新規登録</a></li>
                </ul>
            </div><!--/.footer_inner-->
        </div><!--/.footer_under-->

    </footer>

</div><!--/wrapper-->


<script>
$(window).on('load', function(){
    var winW = $(window).width();
    var winH = $(window).height();
    var devW = 767;
    if (winW <= devW) {
    //767px以下の時の処理
    } else {
    //768pxより大きい時の処理
    }
});

/**nav**/
$(function() {
    var headNav = $("#header_wrap");
    var headNav_img_01 = $(".view_01");
    var headNav_img_02 = $(".view_02");

    //scrollだけだと読み込み時困るのでloadも追加
    $(window).on('load scroll', function () {
        //現在の位置が200px以上かつ、クラスfixedが付与されていない時
        if($(this).scrollTop() > 150 && headNav.hasClass('fixed') == false) {
            //headerの高さ分上に設定
            headNav.css({"top": '-100px'});
            //クラスfixedを付与
            headNav.addClass('fixed');

            headNav_img_02.removeClass('view_no');
            headNav_img_02.addClass('view_yes');

            headNav_img_01.removeClass('view_yes');
            headNav_img_01.addClass('view_no');

            $("#container").addClass('container_margin-top');

            //位置を0に設定し、アニメーションのスピードを指定
            headNav.animate({"top": 0},400);

        }
        //現在の位置が199px以下かつ、クラスfixedが付与されている時にfixedを外す
        else if($(this).scrollTop() < 149 && headNav.hasClass('fixed') == true){
            headNav.removeClass('fixed');

            headNav_img_02.removeClass('view_yes');
            headNav_img_02.addClass('view_no');

            headNav_img_01.removeClass('view_no');
            headNav_img_01.addClass('view_yes');

            $("#container").removeClass('container_margin-top');
        }
    });
});

//チェックボックス操作時
$(function(){
    $('input[name="nav-tgl"]').change(function() {
    if($(this).prop('checked')) {
        $('input[name="nav-tgl_clone"]').prop('checked',true);
    } else {
        $('input[name="nav-tgl_clone"]').prop('checked',false);
    }
    });

    $('#nav-tgl').on('change', function(){
    var st = $(window).scrollTop();
    if($(this).prop("checked") == true) {
        $('html').addClass('scroll-prevent');
        $('html').css('top', -(st) + 'px');
        $('#nav-tgl').on('change', function(){
        if($(this).prop("checked") !== true) {
            $('html').removeClass('scroll-prevent');
            $(window).scrollTop(st);
        }
        });
    }
    });
});

//ハンバーガー　メガナビ
jQuery(document).ready(function($) {
    $('#js-global-nav li').each(function(i) {

        $(this).hover(function() {
            var attr = this.getAttribute("id");
            //console.log(attr);
            var h_mega_nav = "#" + attr + "-js";
            //console.log(h_mega_nav);
            $(h_mega_nav).addClass("is-active");

        }, function() {
            var attr = this.getAttribute("id");
            //console.log(attr);
            var h_mega_nav = "#" + attr + "-js";
            $(h_mega_nav).removeClass("is-active");
        });
    });
});



//【さらに条件を追加】ボタン
//全選択ボタンを取得する
const uncheckBtn = document.getElementById("ac_list_uncheck-btn");
//チェックボックスを取得する
const el = document.getElementsByClassName("ac_list_checks");

//全てのチェックボックスのチェックを外す
const uncheckAll = () => {
    for (let i = 0; i < el.length; i++) {
        el[i].checked = false;
    }
};
//全選択ボタンをクリックした時「uncheckAll」を実行
uncheckBtn.addEventListener("click", uncheckAll, false);



//【slick】
$(function(){
    var mainSlider = "#slider"; //メインスライダーid
    var thumbnailSlider = "#thumbnail_slider"; //サムネイルスライダーid

    $(mainSlider).slick({
    autoplay: true,
    speed: 2000,
    arrows: true,
    asNavFor: thumbnailSlider,
    dots: false,
    });
    $(thumbnailSlider).slick({
    slidesToShow: 5,
    speed: 2000,
    asNavFor: mainSlider,
    arrows: false,
    dots: false,
    });
    //#thumbnail_sliderでクリックしたスライドをカレントにする
    $(thumbnailSlider+" .slick-slide").on('click',function(){
    var index = $(this).attr("data-slick-index");
    $(thumbnailSlider).slick("slickGoTo",index,false);
    });
});




</script>
</body>
</html>
