<?php
global $dp_options, $tcd_megamenu;
if ( ! $dp_options ) $dp_options = get_design_plus_option();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head <?php if ( $dp_options['use_ogp'] ) { echo 'prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#"'; } ?>>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="description" content="<?php seo_description(); ?>">
<meta name="viewport" content="width=<?php echo is_no_responsive() ? '1280' : 'device-width'; ?>">
<?php if ( $dp_options['use_ogp'] ) { ogp(); } ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if ( $dp_options['use_load_icon'] ) : ?>
<div id="site_loader_overlay">
	<div id="site_loader_animation" class="c-load--<?php echo esc_attr( $dp_options['load_icon'] ); ?>">
		<?php if ( 'type3' === $dp_options['load_icon'] ) : ?>
		<i></i><i></i><i></i><i></i>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>
<div id="site_wrap">


	<header id="js-header" class="l-header<?php if ( $dp_options['show_header_search'] && get_query_var('s') ) echo ' is-header-search-active'; ?>" >

<?php
if( is_front_page() || is_home() || is_archive() ){ $thisTag = 'h1'; }else{ $thisTag = 'div'; }
if ( ! is_no_responsive() ) :
	if ( 'yes' == $dp_options['use_logo_image'] && $image = wp_get_attachment_image_src( $dp_options['header_logo_image_mobile'], 'full' ) ) :
?>
		<div class="p-header__logo--mobile l-header__bar--mobile" style="display: none;">
			<div class="p-logo p-logo__header--mobile<?php if ( $dp_options['header_logo_image_mobile_retina'] ) echo ' p-logo__header--retina'; ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_attr( $image[0] ); ?>" alt="<?php bloginfo( 'name' ); ?>"<?php if ( $dp_options['header_logo_image_mobile_retina'] ) echo ' width="' . floor( $image[1] / 2 ) . '"'; ?>></a>
			</div>
			<a href="#" id="js-menu-button" class="p-menu-button c-menu-button"></a>
		</div>
<?php
	else :
?>
		<div class="p-header__logo--mobile l-header__bar--mobile" style="display: none;">
			<div class="p-logo p-logo__header--mobile p-logo__header--text">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
			</div>
			<a href="#" id="js-menu-button" class="p-menu-button c-menu-button"></a>
		</div>
<?php
	endif;
endif;

// ヘッダーソーシャルボタン
$sns_html = '';
foreach ( array( 'facebook', 'twitter', 'youtube', 'instagram', 'pinterest', 'contact' ) as $value ) :
	if ( !empty( $dp_options[$value . '_url'] ) && !empty( $dp_options['show_' . $value . '_header'] ) ) :
		$sns_html .= '<li class="p-social-nav__item p-social-nav__item--' . $value . '"><a href="' . esc_attr( $dp_options[$value . '_url'] ) . '" target="_blank"></a></li>';
	endif;
endforeach;
if ( $dp_options['show_rss_header'] ) :
	$sns_html .= '<li class="p-social-nav__item p-social-nav__item--rss"><a href="' . get_bloginfo( 'rss2_url' ) . '" target="_blank"></a></li>';
endif;

if ( ( 'type1' == $dp_options['header_top'] && has_nav_menu( 'header' ) ) || ( 'type2' == $dp_options['header_top'] && get_bloginfo( 'description' ) ) || $sns_html || $dp_options['show_header_search'] ) :
?>
		<div class="p-header__top u-clearfix" style="display: none;">
			<div class="l-inner">
<?php
	if ( 'type1' == $dp_options['header_top'] && has_nav_menu( 'header' ) ) :
		wp_nav_menu( array(
			'container' => 'nav',
			'menu_class' => 'p-header-nav',
			'theme_location' => 'header',
			'link_after' => '<span></span>',
			'depth' => 1
		) );
		echo "\n";
	elseif ( 'type2' == $dp_options['header_top'] && get_bloginfo( 'description' ) ) :
		echo "\t\t\t\t" . '<div class="p-header-description">' . get_bloginfo( 'description' ) . '</div>' . "\n";
	endif;

	if ( $dp_options['show_header_search'] || $sns_html ) :
?>
				<div class="u-right">
<?php
		if ( $sns_html ) :
?>
					<ul class="p-social-nav"><?php echo $sns_html; ?></ul>
<?php
		endif;

		if ( $dp_options['show_header_search'] ) :
?>
					<div class="p-header-search">
						<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
							<input type="text" name="s" value="<?php echo esc_attr( get_query_var( 's' ) ); ?>" class="p-header-search__input" placeholder="SEARCH">
						</form>
						<a href="#" id="js-search-button" class="p-search-button c-search-button"></a>
					</div>
<?php
		endif;
?>
				</div>
<?php
	endif;
?>
			</div>
		</div>
<?php
endif;

// ヘッダー広告
$header_ad_html = '';
if ( $dp_options['header_ad_code1'] || ( $dp_options['header_ad_image1'] && $header_ad_image1 = wp_get_attachment_image_src( $dp_options['header_ad_image1'], 'full' ) ) ) :
	if ( $dp_options['header_ad_code1'] ) :
		$header_ad_html .= "\t\t\t\t" . '<div class="p-header__ad">' . $dp_options['header_ad_code1'] . '</div>' . "\n";
	elseif ( $header_ad_image1 ) :
		$header_ad_html .= "\t\t\t\t" . '<div class="p-header__ad"><a href="' . esc_url( $dp_options['header_ad_url1'] ) . '" target="_blank"><img src="' . esc_attr( $header_ad_image1[0] ) . '" alt=""></a></div>' . "\n";
	endif;
endif;
if ( $dp_options['header_ad_code2'] || ( $dp_options['header_ad_image2'] && $header_ad_image2 = wp_get_attachment_image_src( $dp_options['header_ad_image2'], 'full' ) ) ) :
	if ( $dp_options['header_ad_code2'] ) :
		$header_ad_html .= "\t\t\t\t" . '<div class="p-header__ad">' . $dp_options['header_ad_code2'] . '</div>' . "\n";
	elseif ( $header_ad_image2 ) :
		$header_ad_html .= "\t\t\t\t" . '<div class="p-header__ad"><a href="' . esc_url( $dp_options['header_ad_url2'] ) . '" target="_blank"><img src="' . esc_attr( $header_ad_image2[0] ) . '" alt=""></a></div>' . "\n";
	endif;
endif;
?>
		<div class="p-header__logo<?php if ( $header_ad_html ) echo ' has-ad'; ?>" style="display: none;">
			<div class="l-inner">
<?php
if ( 'yes' == $dp_options['use_logo_image'] && $image = wp_get_attachment_image_src( $dp_options['header_logo_image'], 'full' ) ) :
?>
				<<?php echo $thisTag; ?> class="p-logo p-logo__header<?php if ( $dp_options['header_logo_image_retina'] ) { echo ' p-logo__header--retina'; } ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_attr( $image[0] ); ?>" alt="<?php bloginfo( 'name' ); ?>"<?php if ( $dp_options['header_logo_image_retina'] ) echo ' width="' . floor( $image[1] / 2 ) . '"'; ?>></a>
				</<?php echo $thisTag; ?>>
<?php
else :
?>
				<<?php echo $thisTag; ?> class="p-logo p-logo__header p-logo__header--text">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
				</<?php echo $thisTag; ?>>
<?php
endif;

if ( $header_ad_html ) :
	echo $header_ad_html;
endif;
?>
			</div>
		</div>













<nav class="p-header__gnav l-header__bar">

<div id="header_top_banner">
    <div class="header_banner_text">
        エントリーに興味がある方は、まずご相談
    </div>
    <div class="header_banner_link_wrapper">
        <a class="header_banner_link" href="https://lin.ee/JTL9trf">
            <img border="0" src="https://scdn.line-apps.com/n/line_add_friends/btn/ja.png">
        </a>
    </div>
</div>


<div id="gb_header" class="l-inner">

<div id="gb_branding">
	<div id="gb_header_01">
		<div id="gb_site-title">
		<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/img/logo-color.svg" alt="" /></a></h1>
		</div>

		<div id="gb_site-description">
			<p class="" style="-webkit-text-size-adjust: 100%;-webkit-font-smoothing: antialiased;box-sizing: border-box;-webkit-tap-highlight-color: transparent;outline: 0;border: 0;font: inherit;vertical-align: baseline;margin: 10px 0 0 0;padding: 0;line-height: 1.8em;color: #00AEBD;font-size: 14px;font-weight: bold;">〜エンタメ業界の人脈をあなたのものに〜</p>
		</div>
	</div>
	<div id="gb_header_03">
		<input type="checkbox" id="gb_nav-tgl_clone" name="gb_nav-tgl_clone" style="display: none;">
		<label for="gb_nav-tgl" class="open gb_nav-tgl-btn"><span></span></label>
		<label for="gb_nav-tgl" class="close gb_nav-tgl-btn"></label>
	</div>
</div>
<div id="gb_menu">
<div class="gb_global-navi">

<input type="checkbox" id="gb_nav-tgl" name="gb_nav-tgl">
<div class="drower-gb_menu">

<div class="drower-gb_menu-list">
    <nav id="js-gb_header__nav " class="l-gb_header__nav navgation_inner">
		<ul id="js-global-nav" class="p-gb_global-nav main-gb_menu gb_menu_base">
					
					<li id="gb_menu-item-1" class="gb_menu-item gb_menu-item-1 nav_btn m_t_1 under_arrow_no">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>%e3%83%97%e3%83%ad%e3%82%b8%e3%82%a7%e3%82%af%e3%83%88%e4%b8%80%e8%a6%a7/" id="top_gb_menu1" data-megamenu="js-megagb_menu1" class="nav_btn_link current_h_btn">
								<div>
									<p class="nav_btn_tit_L">エントリー一覧</p>
								</div>
							</a>
					</li>
					<!--
					<li id="gb_menu-item-1" class="gb_menu-item gb_menu-item-1 nav_btn m_t_1 under_arrow_no">
						
							<a href="" id="top_gb_menu1" data-megamenu="js-megagb_menu1" class="nav_btn_link current_h_btn">
								<label for="item_c_1" class="item_c">
									<div>
									<p class="nav_btn_tit_L">エントリー一覧</p>
					
									</div>
									<div class="under_arrow">▼</div>
								</label>
							</a>
						<input type="checkbox" id="item_c_1" style="display:none;">
						<ul class="sub-gb_menu sub-gb_menu_01" style="display:none;">	
							<li id="gb_menu-item-2_ko_01" class="gb_menu-item_normal">
								<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
									<div class=" header_serch_box">
										<img src="<?php //echo get_template_directory_uri(); ?>/img/search_icon.svg" alt="" />
										<label class="screen-reader-text" for="s"><?php //_x( 'Search for:', 'label' ); ?></label>
										<input type="text" value="<?php //echo get_search_query(); ?>" name="s" id="s" class="hsinp" />
										<input type="submit" id="searchsubmit" class="serch_btn01" value="<?php //echo esc_attr_x( 'Search', 'submit button' ); ?>" />
									</div>
								</form>
							</li>
						</ul>
					</li>
					-->				
					
					
					<li id="gb_menu-item-2" class="gb_menu-item gb_menu-item-2 nav_btn m_t_2 under_arrow_yes">
							<a href="https://fanreturn.com/" id="top_gb_menu2" data-megamenu="js-megagb_menu2" class="nav_btn_link">
								<div>
									<p class="nav_btn_tit_L">プロジェクト一覧</p>
								</div>
							</a>
					</li>
					<!--
					<li id="gb_menu-item-2" class="gb_menu-item gb_menu-item-2 nav_btn m_t_2 under_arrow_yes">
						
							<a href="" id="top_gb_menu2" data-megamenu="js-megagb_menu2" class="nav_btn_link">
								<label for="item_c_2" class="item_c">
									<div>
										<p class="nav_btn_tit_L">開催中のプロジェクト</p>
									</div>
									<div class="under_arrow">▼</div>
								</label>
							</a>
						<input type="checkbox" id="item_c_2" style="display:none;">
						<ul class="sub-gb_menu sub-gb_menu_02" style="display:none;">	
							<li id="gb_menu-item-2_ko_01" class="gb_menu-item_normal header_serch_box">
								<img src="<?php //echo get_template_directory_uri(); ?>/img/search_icon.svg" alt="" /><input type="search" class="hsinp" name="s" placeholder="クラファンを検索" value="">
								<button type="submit" class="wp-block-search__button serch_btn01">検索</button>
							</li>
						</ul>
					</li>
					-->
					
					
					<li id="gb_menu-item-3" class="gb_menu-item gb_menu-item-3 nav_btn m_t_3 under_arrow_no">
						
						<a href="https://fanreturn.com/question" id="top_gb_menu3" data-megamenu="js-megagb_menu3" class="nav_btn_link">
							<div><p class="nav_btn_tit_L">ファンリターンとは</p></div>
						</a>
					</li>

					<!--
					<li id="gb_menu-item-4" class="gb_menu-item gb_menu-item-4 nav_btn m_t_4 under_arrow_no">
						
						<a href="http://fanreturn.valleyin.co.jp/%e6%8e%b2%e8%bc%89%e7%9b%b8%e8%ab%87/" id="top_gb_menu4" data-megamenu="js-megagb_menu4" class="nav_btn_link">
							<label for="item_c_4" class="item_c">
								<div><p class="nav_btn_tit_L">掲載相談</p></div>
								<div class="under_arrow">▼</div>
							</label>
						</a>
						<input type="checkbox" id="item_c_3" style="display:none;">
					</li>
					-->
					
					<!--
					<li id="gb_menu-item-4" class="menu-item nav_btn taso_li menuset_05 login_btn mobile_hide">
						<a href="https://fanreturn.com/login" class="top_menu-1 nav_btn_link">
							<p class="nav_btn_tit_L">ログイン</p>
						</a>
					</li>
					
					<li id="gb_menu-item-5" class="menu-item nav_btn taso_li menuset_06 signup_btn mobile_hide">
						<a href="https://fanreturn.com/pre_create" class="top_menu-1 nav_btn_link">
							<p style="color: #fff;">新規登録</p>
						</a>
					</li>				
					-->


					<li id="media_menu">
						<?php wp_nav_menu(
						  array(
							'menu'  => 'ヘッダーメニュー', //メニュー管理画面で登録したメニュー名
							'container' => '',
							'container_id' => '',
							'container_class' => '',
							'menu_id' => '',
							'menu_class' => 'nav navbar-nav',
						  )
						); ?>
					</li>
					
					<li id="gb_menu-item-6">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="FanReturn" rel="home" class="h_logo_css_sp">
							<img src="<?php echo get_template_directory_uri(); ?>/img/logo-white.svg" alt="" />
						</a>
					</li>


					</ul>
				</nav>
</div><!--/drower-gb_menu-->
</div><!--/drower-gb_menu-list-->	
	
</div>
</div><!--/#gb_menu-->

</div>

<style>
#sp_btn_nemu_base{display: none;}
@media screen and (max-width: 991px){
	#sp_btn_nemu_base{ display: flex; flex-wrap: wrap; align-items: center; align-content: center; justify-content: center; border-top: solid 1px #ddd; border-bottom: solid 1px #ddd;}
	#sp_btn_nemu_01{ width: 50%; border-right: solid 1px #ddd;}
	#sp_btn_nemu_02{ width: 50%;}
	.sp_btn_nemu_tit{ font-size: 13px; font-weight: bold; color: #00AEBD; text-align: center; padding: 14px 0; max-height: 50px; }
}

</style>
<div id="sp_btn_nemu_base">
	<div id="sp_btn_nemu_01">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>%e3%83%97%e3%83%ad%e3%82%b8%e3%82%a7%e3%82%af%e3%83%88%e4%b8%80%e8%a6%a7/">
			<p class="sp_btn_nemu_tit">エントリー一覧</p>
		</a>
	</div>
	<div id="sp_btn_nemu_02">
		<a href="https://fanreturn.com/">
			<p class="sp_btn_nemu_tit">プロジェクト一覧</p>
		</a>
	</div>
</div>


<style>
#header_top_banner{ width: 100%; text-align: center; background: #00AEBD;min-height: 80px; padding: 10px; font-family: YuGothic; font-size: 14px; font-weight: bold;  font-stretch: normal;  font-style: normal;  line-height: 1.57; letter-spacing: normal; text-align: center; color: #fff;}
#header_top_banner img{ border-radius: 4px; width: 102px; height: 36px;}
.pri_b{background-color:#222222;}
.pri_W_b{background-color:#878787;}
.pri_c{color:#222222;}
.gb_global-navi{width:100%;}
.navgation_inner{width:100%;margin:0 auto;}
a:link,a:visited,a:hover,a:active{color:#000000;}
@media screen and (max-width: 991px){
	.navgation_inner{width:100%;}
}
*{box-sizing:border-box;-webkit-tap-highlight-color:transparent;}
a{text-decoration:none;}
img{-webkit-backface-visibility:hidden;}
#gb_site-title img { width: 224px;}
.gb_menu-item-has-children{position:relative;flex-grow:1;display:flex;flex-wrap:wrap;align-items:center;justify-content:center;}
@media screen and (max-width: 991px){
	.gb_menu-item-has-children{width:100%; /*border-bottom:solid 1px #666;*/}
}
.p-gb_global-nav .sub-gb_menu{display:block;line-height:1.2;text-align:left;opacity:0;position:absolute;top:0;left:0%;transition:0.2s;visibility:hidden;z-index:2;transition:all 600ms 0s ease;}
.p-gb_global-nav .sub-gb_menu a{padding:17px 25px 17px 25px;transition:padding-left 0.2s ease;}
.p-gb_global-nav .sub-gb_menu a{display:block;}
.p-gb_global-nav .gb_menu-item-has-children:hover > .sub-gb_menu{opacity:1;visibility:visible;}
.p-gb_global-nav > li.gb_menu-item-has-children:hover > .sub-gb_menu{left:0;}
@media screen and (max-width: 991px){
	.p-gb_global-nav .sub-gb_menu a{padding:12px 12px 12px 12px;}
}
.under_arrow_yes .under_arrow{font-size:70%;opacity:0.3;margin:0 0 0 5px;display:block;}
.under_arrow_no .under_arrow{display:none;}
@media screen and (max-width: 991px){
	.under_arrow_yes .under_arrow{font-size:60%;opacity:0.3;position:absolute;right:10px;display:block;}
}
.p-gb_global-nav .sub-gb_menu a{color:#ffffff;}
.p-gb_global-nav .sub-gb_menu a:hover{opacity:0.85;}
.item_c{width:100%;display:flex;flex-wrap:wrap;align-items:center;justify-content:center;}
@media screen and (max-width: 991px){
	.item_c{justify-content:flex-start;padding:0 0 0 0px;}
}
#gb_nav-tgl{display:none;}
ul li{list-style:none;}
#gb_header{width:100%;z-index:50; display: flex; flex-wrap: wrap; align-items: center; align-content: center; justify-content:space-between;}
img{-webkit-backface-visibility:hidden;}
#gb_branding{display:flex;flex-wrap:wrap;justify-content:space-between; height:65px;padding:0 15px;line-height:1;}
@media screen and (max-width: 991px){
	#gb_branding{width:100%;height:50px;padding:0 5px;}
}
#gb_header_01{display:flex;flex-wrap:wrap;align-items:center;}
#gb_site-description{font-size:1.3rem;margin:0 0 0 15px;}
#gb_header_03{display:flex;flex-wrap:wrap;align-items:center;}
.h_logo_css{width:420px;}
@media screen and (max-width: 991px){
.h_logo_css{width:230px;}
}
.drower_disc{display:none;}
@media screen and (max-width: 991px){
.drower_disc{display:block;}
.drower_disc_01{width:90%;margin:20px auto;border:solid 2px #ddd;border-radius:5px;padding:10px;text-align:center;}
}
.drower_disc_02{display:none;}
@media screen and (max-width: 991px){
.drower_disc_02{display:flex;flex-wrap:wrap;align-items:center;color:#fff;padding:20px 20px;width:90%;margin:20px auto;border-radius:5px;}
}
@media screen and (max-width: 991px){
#gb_site-description{display:none;}
}
#gb_menu{}
.gb_menu_base{display:flex;flex-wrap:wrap;justify-content:space-between;}
.nav_btn_link{display:flex;flex-wrap:wrap;align-items:center;justify-content:center;text-align:center;width:100%;height:45px; color:#00AEBD !important; padding: 0 10px; }
.nav_btn_link:hover{opacity:0.7;}
.p-gb_global-nav .sub-gb_menu{width:100%;top:45px;}
.nav_btn_tit_L{color:#00AEBD; font-size: 14px; font-weight: bold;}
@media screen and (max-width: 991px){
.p-gb_global-nav .sub-gb_menu{top:0;}
}
.current_h_btn{}
@media screen and (max-width: 991px){
	#gb_nav-tgl{display:none;}
	.gb_nav-tgl-btn{cursor:pointer;position:relative;top:0;right:0;margin:0;}
	.open{z-index:2;width:40px;height:40px;transition:background .6s, transform .6s cubic-bezier(0.215, 0.61, 0.355, 1);}
	.open::before,.open::after{content:"";}
	.open span,.open::before,.open::after{content:"";position:absolute;top:calc(50% - 1px);right:30%;width:80%;border-bottom:2px solid #00AEBD;transition:transform .6s cubic-bezier(0.215, 0.61, 0.355, 1);}
	.open::before{transform:translateY(-8px); width: 60%;}
	.open::after{transform:translateY(8px);}
	#gb_nav-tgl_clone:checked + .open{background:transparent;transform:translateX(0px);}
	#gb_nav-tgl_clone:checked + .open span{transform:scaleX(0);}
	#gb_nav-tgl_clone:checked + .open::before{transform:rotate(45deg); width: 80%;}
	#gb_nav-tgl_clone:checked + .open::after{transform:rotate(-45deg);}
	.drower-gb_menu{z-index:999;position:fixed;overflow:auto;-webkit-overflow-scrolling:touch;overflow-scrolling:touch;top:0;left:0;width:250px;height:100%;margin:0;padding:0 0 10px;box-sizing:border-box;transform:translateX(-100%);transition:transform .6s cubic-bezier(0.215, 0.61, 0.355, 1);background:#fff;}
	#gb_nav-tgl:checked ~ .drower-gb_menu{transform:none;}
	.p-gb_global-nav .sub-gb_menu{display:block;opacity:1;position:relative;top:0;visibility:visible;}
	.nav_btn_link:hover{opacity:1;}
	.p-gb_global-nav .gb_menu-item .sub-gb_menu a{display:none;opacity:0;}
	.p-gb_global-nav .gb_menu-item input[type=checkbox]:checked + .sub-gb_menu a{display:block;opacity:1;}
	.close{z-index:1;width:100%;height:100%;pointer-events:none;transition:background .6s;position:fixed;top:0;left:0;}
	#gb_nav-tgl_clone:checked ~ .close{pointer-events:auto;background:rgba(0,0,0,.3);}
}

.sub-gb_menu_01{ width: 250px !important;}
.sub-gb_menu_02{ width: 250px !important;}
.header_serch_box {
    display: flex;
    align-items: center;
    border-bottom: solid 2px #00AEBD;
    margin: 0 16px 0 0;
    height: 33px;
	font-size: 13px;
}
.header_serch_box input {
    border: none;
    padding: 0 0 0 5px;
    height: 100%;
	width: 160px;
}
.header_serch_box img { width: 17px;}
.header_serch_box img{ fill: #00aebd;}
.serch_btn01 {
    height: 33px;
    border-radius: 5px;
    padding: 0 10px !important;
	background: #00AEBD !important;
    display: flex !important;
    flex-wrap: wrap;
    align-items: center;
    text-align: center;
	justify-content: center;
    width: 100%;
	color: #fff;
	border: none;
	font-size: 12px;
}
.serch_btn01 p{ width: 35px; color: #fff; }
.hsinp::placeholder {
  color: #ccc;
  font-size: 12px;
}

#gb_menu-item-1{order: 2;}
#media_menu{display: none; order: 3;}
#gb_menu-item-2{order: 4;}
#gb_menu-item-3{order: 5;}
#gb_menu-item-4{order: 6;}
#gb_menu-item-5{order: 7;}
#gb_menu-item-6{order: 1; display: none;}
#gb_menu-item-6 img{ width: 124px; margin-bottom: 17px;}
.media_menu_tit{ margin: 50px 10px 10px 10px; padding: 0 0 7px 0px; border-bottom: dotted 1px #aaa; color: #aaa; font-weight: bold;}
.menuset_05{ border: solid 1px #00AEBD; margin: 0 15px; border-radius: 7px;}
.menuset_05 .nav_btn_link{ background-color: transparent;}
.menuset_06{ border: solid 1px #00AEBD; border-radius: 7px;}
.menuset_06 .nav_btn_link{ font-weight: bold; background-color: #00AEBD; border-radius: 6px;}


@media screen and (max-width: 991px){

	.drower-gb_menu{ background:#00AEBD; padding: 15px;}
	.drower-gb_menu ul li { width: 100%; text-align: left;}
	.nav_btn_link {justify-content: flex-start;}
	.nav_btn_tit_L{ color: #fff;}
	.header_serch_box{ margin-left: 12px;}
	
	#gb_menu-item-1{}
	#gb_menu-item-2{ border-bottom: solid 1px #fff; border-top: solid 1px #fff; margin-top: 20px;}
	#gb_menu-item-3{ border-bottom: solid 1px #fff;}
	#gb_menu-item-4{ border-bottom: solid 1px #fff;}
	#gb_menu-item-5{ border-bottom: solid 1px #fff;}
	#gb_menu-item-6{ display: block;}

	.menuset_05, .menuset_06 {
		margin: 0;
		border-radius: 0px;
	}

	#media_menu{display: block; width: 100%;}
	#media_menu a{ color: #fff;}
	#media_menu ul{ margin-top: 0px; padding-left: 10px;}
	#media_menu ul li { padding: 8px 10px;}
	
	.l-main{ margin-top: 120px;}
}

#js-global-nav{ margin-bottom: ;}
.p-global-nav > li {
    line-height: 35px;
}
.p-cb__item-header__has-button .p-cb__item-archive-link__button {
    color: #fff;
}
#cb_1 .p-ad{ margin-top: 0px;}
.p-index-carousel { margin-bottom: 70px;}


</style>

<script>
jQuery(function(){
	//チェックボックス操作時
	jQuery('input[name="gb_nav-tgl"]').change(function() {
		if(jQuery(this).prop('checked')) {
			jQuery('input[name="gb_nav-tgl_clone"]').prop('checked',true);
		} else {
			jQuery('input[name="gb_nav-tgl_clone"]').prop('checked',false);
		}
	});
});
</script>






<?php
if ( has_nav_menu( 'global' ) ) :
	$nav = wp_nav_menu( array(
		//'container' => 'nav',
		//'container_class' => 'p-header__gnav l-header__bar',
		'menu_class' => 'l-inner p-global-nav u-clearfix',
		'menu_id' => 'js-global-nav',
		'theme_location' => 'global',
		'link_after' => '<span></span>',
		'echo' => 0
	) );
	if ( $dp_options['show_header_search'] ) :
		$nav_replace = "$0\n";
		$nav_replace .= '<li class="p-header-search--mobile">';
		$nav_replace .= '<form action="' . esc_url( home_url( '/' ) ) . '" method="get">';
		$nav_replace .= '<input type="text" name="s" value="' . esc_attr( get_query_var( 's' ) ) . '" class="p-header-search__input" placeholder="SEARCH">';
		$nav_replace .= '<input type="submit" value="&#xe915;" class="p-header-search__submit">';
		$nav_replace .= '</form>';
		$nav_replace .= "</li>\n";
		$nav = preg_replace('/<ul.*?js-global-nav.*?>/', $nav_replace, $nav);
	endif;
	echo $nav . "\n";
endif;

if ( $tcd_megamenu ) :
	foreach ( $tcd_megamenu as $menu_id => $value ) :
		if ( empty( $value['categories'] ) ) continue;
?>
		<div id="p-megamenu--<?php echo esc_attr( $menu_id ) ?>" class="p-megamenu p-megamenu--<?php echo esc_attr( $value['type'] ); ?><?php
			if ( ! empty( $value['item']->object_id ) && 'taxonomy' === $value['item']->type && 'category' === $value['item']->object ) :
				echo ' p-megamenu-parent-category p-megamenu-term-id-' . esc_attr( $value['item']->object_id );
			endif;
		?>">
			<ul class="l-inner p-megamenu__bg">
<?php
		$cnt = 0;
		foreach ( $value['categories'] as $menu ) :
			$category = get_term_by( 'id', $menu->object_id, 'category' );
			if ( empty( $category->term_id ) ) continue;

			if ( 'type2' === $value['type'] ) :
				$term_meta = get_option( 'taxonomy_' . $category->term_id );
				$image_src = null;
				$li_class = array();
				if ( ! empty( $term_meta['image_megamenu'] ) ) :
					$image_src = wp_get_attachment_image_src( $term_meta['image_megamenu'], 'size3' );
				endif;
				if ( ! $image_src && ! empty( $term_meta['image'] ) ) :
					$image_src = wp_get_attachment_image_src( $term_meta['image'], 'size3' );
				endif;
				if ( ! empty( $image_src[0] ) ) :
					$image_src = $image_src[0];
				else :
					$image_src = get_template_directory_uri() . '/img/no-image-600x420.gif';
				endif;
				if ( is_category( $category->slug ) ) :
					$li_class[] = 'p-megamenu__current';
				endif;
				if (count($value['categories']) - $cnt <= count($value['categories']) % 5 ) :
					$li_class[] = 'p-megamenu__last-row';
				endif;
				if ( $li_class ) :
					$li_class = ' class="' . implode( ' ', $li_class ) . '"';
				else :
					$li_class = '';
				endif;
?>
				<li<?php echo $li_class; ?>><a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php echo get_category_link( $category->term_id ); ?>"><div class="p-megamenu__image p-hover-effect__image js-object-fit-cover"><img src="<?php echo esc_attr( $image_src ); ?>" alt=""></div><?php echo esc_html( $category->name ); ?></a></li>
<?php
			elseif ( 'type3' === $value['type'] ) :
				// ネイティブ広告
				if ( ! empty( $dp_options['megamenu']['show_native_ad'] ) && in_array( $menu_id, $dp_options['megamenu']['show_native_ad'] ) ) :
					$native_ad = get_native_ad();
				else :
					$native_ad = false;
				endif;

				$megamenu_posts = get_posts( array(
					'cat' => $category->term_id,
					'post_type' => 'post',
					'post_status' => 'publish',
					'posts_per_page' => $native_ad ? 3 : 4
				) );
?>
				<li<?php if ( ! $cnt ) echo ' class="is-active"'; ?>>
					<a href="<?php echo get_category_link( $category->term_id ); ?>"><?php echo esc_html( $category->name ); ?></a>
<?php
				if ( $megamenu_posts || $native_ad ) :
?>
					<ul class="sub-menu p-megamenu__bg">
<?php
					if ( $megamenu_posts ) :
						foreach ( $megamenu_posts as $megamenu_post ) :
							if ( has_post_thumbnail( $megamenu_post->ID ) ) :
								$image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $megamenu_post->ID ), 'size3' );
							else :
								$image_src = null;
							endif;
							if ( ! empty( $image_src[0] ) ) :
								$image_src = $image_src[0];
							else :
								$image_src = get_template_directory_uri() . '/img/no-image-600x420.gif';
							endif;
?>
						<li><a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php echo get_permalink( $megamenu_post ); ?>"><div class="p-megamenu__image p-hover-effect__image js-object-fit-cover"><img src="<?php echo esc_attr( $image_src ); ?>" alt=""></div><?php echo mb_strimwidth( strip_tags( get_the_title( $megamenu_post ) ), 0, 50, '...' ); ?></a></li>
<?php
						endforeach;
					endif;

					// ネイティブ広告
					if ( $native_ad ) :
						if ( ! empty( $native_ad['native_ad_image'] ) ) :
							$image_src = wp_get_attachment_image_src( $native_ad['native_ad_image'], 'size2' );
						else :
							$image_src = null;
						endif;
						if ( ! empty( $image_src[0] ) ) :
							$image_src = $image_src[0];
						else :
							$image_src = get_template_directory_uri() . '/img/no-image-600x420.gif';
						endif;
?>
						<li><a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php echo esc_attr( $native_ad['native_ad_url'] ); ?>" targer="_blank"><div class="p-megamenu__image p-hover-effect__image"><img src="<?php echo esc_attr( $image_src ); ?>" alt=""><?php if ( $native_ad['native_ad_label'] ) : ?><div class="p-float-native-ad-label__small"><?php echo esc_html( $native_ad['native_ad_label'] ); ?></div><?php endif; ?></div>
						<?php echo esc_html( mb_strimwidth( $native_ad['native_ad_title'], 0, 50, '...' ) ); ?></a></li>
<?php
					endif;
?>
					</ul>
<?php
				endif;
?>
				</li>
<?php
			elseif ( 'type4' === $value['type'] ) :
?>
				<li<?php if ( is_category( $category->slug ) ) echo ' class="p-megamenu__current"'; ?>><a class="p-megamenu__hover" href="<?php echo get_category_link( $category->term_id ); ?>"><span><?php echo esc_html( $category->name ); ?></span></a></li>
<?php
			endif;
			$cnt++;
		endforeach;
?>
			</ul>
		</div>
</nav>
<?php
	endforeach;
endif;
?>
	</header>
