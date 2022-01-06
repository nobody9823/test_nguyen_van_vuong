<?php
global $dp_options;
if ( ! $dp_options ) $dp_options = get_design_plus_option();
?>
	<footer class="l-footer">
<?php
// フッターブログスライダー
if ( ( is_front_page() && $dp_options['show_footer_blog_top'] ) || ( ! is_front_page() && $dp_options['show_footer_blog'] ) ) :
	$args = array(
		'post_status' => 'publish',
		'post_type' => 'post',
		'posts_per_page' => $dp_options['footer_blog_num']
	);
	$footer_blog_category = null;
	if ( 'type2' == $dp_options['footer_blog_list_type'] ) :
		$args['meta_key'] = 'recommend_post';
		$args['meta_value'] = 'on';
	elseif ( 'type3' == $dp_options['footer_blog_list_type'] ) :
		$args['meta_key'] = 'recommend_post2';
		$args['meta_value'] = 'on';
	elseif ( 'type4' == $dp_options['footer_blog_list_type'] ) :
		$args['meta_key'] = 'pickup_post';
		$args['meta_value'] = 'on';
	elseif ( 'type5' == $dp_options['footer_blog_list_type'] ) :
	elseif ( $dp_options['footer_blog_category'] ) :
		$footer_blog_category = get_category( $dp_options['footer_blog_category'] );
		if ( ! empty( $footer_blog_category ) && ! is_wp_error( $footer_blog_category ) ) :
			$args['cat'] = $footer_blog_category->term_id;
		else :
			$footer_blog_category = null;
		endif;
	endif;
	if ( 'rand' == $dp_options['footer_blog_post_order'] ) :
		$args['orderby'] = 'rand';
	elseif ( 'date2' == $dp_options['footer_blog_post_order'] ) :
		$args['orderby'] = 'date';
		$args['order'] = 'ASC';
	else :
		$args['orderby'] = 'date';
		$args['order'] = 'DESC';
	endif;
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) :
?>
		<div id="js-footer-slider" class="p-footer-blog p-footer-slider p-article-slider" data-slide-time="<?php echo esc_attr( $dp_options['footer_blog_slide_time'] ); ?>">
<?php
		$post_count = 0;
		$post_count_with_ad = 0;

		while ( $the_query->have_posts() ) :
			$the_query->the_post();
			$post_count++;
			$post_count_with_ad++;

			$catlist_float = array();
			if ( $dp_options['show_footer_blog_category'] ) :
				// 選択カテゴリーあり
				if ( $footer_blog_category ) :
					$catlist_float[] = '<span class="p-category-item--' . esc_attr( $footer_blog_category->term_id ) . '" data-url="' . get_category_link( $footer_blog_category ) . '">' . esc_html( $footer_blog_category->name ) . '</span>';
				else :
					$categories = get_the_category();
					if ( $categories && ! is_wp_error( $categories ) ) :
						foreach ( $categories as $category ) :
							$catlist_float[] = '<span class="p-category-item--' . esc_attr( $category->term_id ) . '" data-url="' . get_category_link( $category ) . '">' . esc_html( $category->name ) . '</span>';
							break;
						endforeach;
					endif;
				endif;
			endif;
?>
			<article class="p-footer-blog__item p-article-slider__item">
				<a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php the_permalink(); ?>" href="<?php the_permalink(); ?>">
<?php
			echo "\t\t\t\t\t";
			echo '<div class="p-article-slider__item-thumbnail p-hover-effect__image js-object-fit-cover">';
			if ( has_post_thumbnail() ) :
				the_post_thumbnail( 'size2' );
			else :
				echo '<img src="' . get_template_directory_uri() . '/img/no-image-600x420.gif" alt="">';
			endif;
			echo "</div>\n";

			if ( $catlist_float ) :
				echo "\t\t\t\t\t";
				echo '<div class="p-float-category">' . implode( ', ', $catlist_float ) . '</div>';
				echo "\n";
			endif;
?>
					<div class="p-footer-blog__item-info p-article-slider__item-info">
						<h3 class="p-footer-blog__item-title p-article-slider__item-title p-article__title"><?php echo mb_strimwidth( strip_tags( get_the_title() ), 0, is_mobile() ? 34 : 64, '...' ); ?></h3>
					</div>
				</a>
			</article>
<?php
			// ネイティブ広告
			if ( $dp_options['show_footer_blog_native_ad'] && 0 === $post_count % $dp_options['footer_blog_native_ad_position'] ) :
				$native_ad = get_native_ad();
				if ( $native_ad ) :
					$post_count_with_ad++;
?>
			<article class="p-footer-blog__item p-article-slider__item">
				<a href="<?php echo esc_attr( $native_ad['native_ad_url'] ); ?>"<?php if ( ! empty( $native_ad['native_ad_target'] ) ) echo ' target="_blank"'; ?>>
<?php
					echo "\t\t\t\t\t";
					echo '<div class="p-article-slider__item-thumbnail js-object-fit-cover">';
					if ( $native_ad['native_ad_image'] ) :
						$image_src = wp_get_attachment_image_src( $native_ad['native_ad_image'], 'size2' );
					else :
						$image_src = null;
					endif;
					if ( ! empty( $image_src[0] ) ) :
						echo '<img src="' . esc_attr( $image_src[0] ) . '" alt="">';

					else :
						echo '<img src="' . get_template_directory_uri() . '/img/no-image-600x420.gif" alt="">';
					endif;
					echo "</div>\n";

					if ( $native_ad['native_ad_label'] ) :
						echo "\t\t\t\t\t";
						echo '<div class="p-float-native-ad-label">' .  esc_html( $native_ad['native_ad_label'] ) . '</div>' . "\n";
					endif;
?>
					<div class="p-footer-blog__item-info p-article-slider__item-info">
						<h3 class="p-footer-blog__item-title p-article-slider__item-title p-article__title"><?php echo esc_html( mb_strimwidth( $native_ad['native_ad_title'], 0, is_mobile() ? 40 : 60, '...' ) ); ?></h3>
					</div>
				</a>
			</article>
<?php
				endif;
			endif;

			if ( $post_count_with_ad >= $dp_options['footer_blog_num'] ) :
				break;
			endif;
		endwhile;
		wp_reset_postdata();
?>
		</div>

<style>
	#js-footer-widget{display: none;}
</style>

<?php
	endif;
endif;

// フッターウィジェット
if ( is_mobile() ) :
	$footer_widget = 'footer_widget_mobile';
else :
	$footer_widget = 'footer_widget';
endif;
if ( is_active_sidebar( $footer_widget ) ) :
?>
		<div id="js-footer-widget" class="p-footer-widget-area" style="background: <?php echo esc_attr( $dp_options['footer_widget_bg_color'] ); ?>">
			<div class="p-footer-widget-area__inner l-inner">
<?php
	dynamic_sidebar( $footer_widget );
?>
			</div>
		</div>
<?php
endif;
?>
		<div class="p-footer__logo" style="display: none;">
			<div class="l-inner p-footer__logo__inner">
<?php
if ( 'yes' == $dp_options['use_logo_image'] && $image = wp_get_attachment_image_src( $dp_options['footer_logo_image'], 'full' ) ) :
?>
				<div class="p-logo p-logo__footer<?php if ( $dp_options['footer_logo_image_retina'] ) echo ' p-logo__footer--retina'; ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_attr( $image[0] ); ?>" alt="<?php bloginfo( 'name' ); ?>"<?php if ( $dp_options['footer_logo_image_retina'] ) echo ' width="' . floor( $image[1] / 2 ) . '"'; ?>></a>
				</div>
<?php
else :
?>
				<div class="p-logo p-logo__footer p-logo__footer--text">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
				</div>
<?php
endif;

if ( ! is_no_responsive() ) :
	if ( 'yes' == $dp_options['use_logo_image'] && $image = wp_get_attachment_image_src( $dp_options['footer_logo_image_mobile'], 'full' ) ) :
?>
				<div class="p-logo p-logo__footer--mobile<?php if ( $dp_options['footer_logo_image_mobile_retina'] ) echo ' p-logo__footer--retina'; ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_attr( $image[0] ); ?>" alt="<?php bloginfo( 'name' ); ?>"<?php if ( $dp_options['footer_logo_image_mobile_retina'] ) echo ' width="' . floor( $image[1] / 2 ) . '"'; ?>></a>
				</div>
<?php
	else :
?>
				<div class="p-logo p-logo__footer--mobile p-logo__footer--text">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
				</div>
<?php
	endif;
endif;

if ( has_nav_menu( 'footer' ) ) :
	wp_nav_menu( array(
		'container' => 'nav',
		'menu_class' => 'p-footer-nav',
		'theme_location' => 'footer',
		'depth' => 1
	) );
	echo "\n";
endif;

// ヘッダーソーシャルボタン
$sns_html = '';
foreach ( array( 'facebook', 'twitter', 'youtube', 'instagram', 'pinterest', 'contact' ) as $value ) :
	if ( !empty( $dp_options[$value . '_url'] ) && !empty( $dp_options['show_' . $value . '_footer'] ) ) :
		$sns_html .= '<li class="p-social-nav__item p-social-nav__item--' . $value . '"><a href="' . esc_attr( $dp_options[$value . '_url'] ) . '" target="_blank"></a></li>';
	endif;
endforeach;
if ( $dp_options['show_rss_footer'] ) :
	$sns_html .= '<li class="p-social-nav__item p-social-nav__item--rss"><a href="' . get_bloginfo( 'rss2_url' ) . '" target="_blank"></a></li>';
endif;

if ( $sns_html ) :
?>
				<ul class="p-social-nav"><?php echo $sns_html; ?></ul>
<?php
endif;
?>
			</div>
		</div>
		
		<div class="p-copyright" style="display: none;">
			<div class="l-inner">
				<p>Copyright &copy;<span class="u-hidden-xs"> <?php echo date( 'Y',current_time( 'timestamp', 0 ) ); ?></span> <?php bloginfo( 'name' ); ?>. All Rights Reserved.</p>
			</div>
		</div>
<?php
if ( is_mobile() && ! is_no_responsive() && 'type3' !== $dp_options['footer_bar_display'] ) :
	get_template_part( 'template-parts/footer-bar' );
endif;
?>
		<div id="js-pagetop" class="p-pagetop"><a href="#"></a></div>
	</footer>
</div><?php // #site_wrap ?>
<?php wp_footer(); ?>
<script>
jQuery(function($){

	var initialized = false;
	var initialize = function(){
		if (initialized) return;
		initialized = true;

		$(document).trigger('js-initialized');
		$(window).trigger('resize').trigger('scroll');
	};

<?php
if ( $dp_options['use_load_icon'] ) :
?>
	$(window).load(function() {
		setTimeout(initialize, 800);
		$('#site_loader_animation:not(:hidden, :animated)').delay(600).fadeOut(400);
		$('#site_loader_overlay:not(:hidden, :animated)').delay(900).fadeOut(800);
	});
	setTimeout(function(){
		setTimeout(initialize, 800);
		$('#site_loader_animation:not(:hidden, :animated)').delay(600).fadeOut(400);
		$('#site_loader_overlay:not(:hidden, :animated)').delay(900).fadeOut(800);
	}, <?php echo esc_html( $dp_options['load_time'] ? $dp_options['load_time'] : 5000 ); ?>);
<?php
else : // ロード画面を表示しない
?>
	initialize();
<?php
endif;
?>

});
</script>
<?php
if ( is_singular() && ! is_page() ) :
	if ( 'type5' == $dp_options['sns_type_top'] || 'type5' == $dp_options['sns_type_btm'] ) :
		if ( $dp_options['show_twitter_top'] || $dp_options['show_twitter_btm'] ) :
?>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<?php
		endif;
		if ( $dp_options['show_fblike_top'] || $dp_options['show_fbshare_top'] || $dp_options['show_fblike_btm'] || $dp_options['show_fbshare_btm'] ) :
?>
<!-- facebook share button code -->
<div id="fb-root"></div>
<script>
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.5";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<?php
		endif;
		if ( $dp_options['show_google_top'] || $dp_options['show_google_btm'] ) :
?>
<script type="text/javascript">window.___gcfg = {lang: 'ja'};(function() {var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;po.src = 'https://apis.google.com/js/plusone.js';var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);})();
</script>
<?php
		endif;
		if ( $dp_options['show_hatena_top'] || $dp_options['show_hatena_btm'] ) :
?>
<script type="text/javascript" src="http://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
<?php
		endif;
		if ( $dp_options['show_pocket_top'] || $dp_options['show_pocket_btm'] ) :
?>
<script type="text/javascript">!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://widgets.getpocket.com/v1/j/btn.js?v=1";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"pocket-btn-js");</script>
<?php
		endif;
		if ( $dp_options['show_pinterest_top'] || $dp_options['show_pinterest_btm'] ) :
?>
<script async defer src="//assets.pinterest.com/js/pinit.js"></script>
<?php
		endif;
	endif;
endif;
?>




<style>
.l-footer{ margin-top: 70px;}
.footer_02{display:block;}
.h_logo_css{width:224px;margin:8px 0 0 0;display:block;}
.wm_login_btn{background:#fff;width:96px;border:solid 1px #00AEBD;border-radius:5px;margin:0 0 0 0;padding:10px 0 10px 0;display:flex;align-items:center;align-content:center;justify-content:center;}
.wm_login_btn a{color:#00AEBD;}
.wm_signup_btn{background:#00AEBD;width:96px;border-radius:5px;margin:0 30px 0 0;padding:10px 0 10px 0;display:flex;align-items:center;align-content:center;justify-content:center;}
.wm_signup_btn a{color:#fff !important;}
@media screen and (max-width: 1000px){
#nav-tgl_clone:checked + .open{transform:translateX(0px);}
#nav-tgl_clone:checked + .open span{transform:scaleX(0);width:60%;right:20%;}
#nav-tgl_clone:checked + .open::before{transform:rotate(45deg);width:60%;right:20%;}
#nav-tgl_clone:checked + .open::after{transform:rotate(-45deg);width:60%;right:20%;}
#nav-tgl_clone:checked ~ .close{pointer-events:auto;background:rgba(0,0,0,.3);z-index:5;}
#nav-tgl:checked ~ .drower-menu{transform:none;}
.h_logo_css{width:158px;}
}
.footer_02{background:#F4F4F4;font-size:14px;font-weight:bold;}
.footer_02 a{color:#707070;}
.footer_02 .footer_main{padding:50px 0;}
.footer_02 .footer_main_inner{width:100%;max-width:1040px;margin:0 auto;padding:0 20px;display:flex;flex-wrap:wrap;}
.footer_02 .footer_main_01{width:50%;border-right:solid 1px #fff;padding:20px 0 20px 0;}
.footer_02 .footer_main_02{width:25%;border-right:solid 1px #fff;padding:20px 0 20px 20px;}
.footer_02 .footer_main_03{width:25%;padding:20px 0 20px 20px;}
.footer_02 .footer_tit{width:100%;font-size:16px;color:#00AEBD;margin:0 0 20px 0;}
.footer_02 .footer_item{margin:0 0 15px 0;}
.footer_02 .footer_under{background:#fff;padding:20px 0;}
.footer_02 .footer_under_inner{width:100%;max-width:1200px;margin:0 auto;display:flex;flex-direction:row;}
.footer_02 .footer_list{display:flex;flex-direction:row;align-items:center;justify-content:flex-start;}
.footer_02 .footer_list li{margin-right:25px;}
.footer_02 .footer_logo{margin:0 25px 0 0;}
.footer_02 .footer_logo img{width:180px;}
@media screen and (max-width: 768px){
.footer_02 .footer_main{padding:30px 0;}
.footer_02 .footer_main_inner{display:block;padding:0 15px;}
.footer_02 .footer_main_01{width:100%;border-right:none;padding:20px 0;border-bottom:solid 1px #fff;}
.footer_02 .footer_main_02{width:100%;border-right:none;padding:20px 0;border-bottom:solid 1px #fff;}
.footer_02 .footer_main_03{width:100%;padding:20px 0;}
.footer_02 .footer_under{padding:10px 15px;}
.footer_02 .footer_under_inner{flex-direction:column;}
.footer_02 .footer_logo{margin:0 0 15px 0;width:100%;}
.footer_02 .footer_list{flex-direction:column;align-items:flex-start;}
.footer_02 .footer_list .wm_login_btn,.footer_list .wm_signup_btn{padding:5px 0;}
.footer_02 .footer_list li{margin-bottom:15px;}
}

#media_menu_footer ul li { padding: 8px 10px 8px 0;}
.p-pagetop a::after {
    color: #fff;
}
@media screen and (max-width: 991px){
.footer_02 .footer_under_inner{max-width: calc(100% - 20px);}
	.footer_under .p-gb_global-nav{ display: none;}
}

</style>
<div class="footer_02">
    <div class="footer_main">
        <div class="footer_main_inner">

            <div class="footer_main_01">
                <h4 class="footer_tit">エントリー一覧</h4>

<div id="media_menu_footer">
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
</div>

                            </div>

            <div class="footer_main_02">
                <h4 class="footer_tit">プロジェクト一覧</h4>
                
                <div class="footer_item"><a href="https://fanreturn.com/my_project/project">プロジェクトを作る</a></div>
            </div>

            <div class="footer_main_03">
                <h4 class="footer_tit">fanreturnについて</h4>
                
                <div class="footer_item"><a href="https://fanreturn.com/trade_law">運営会社</a></div>
                <div class="footer_item"><a href="https://fanreturn.com/terms_of_service">利用規約</a></div>
                <div class="footer_item"><a href="https://fanreturn.com/ps_terms_of_service">プロジェクトサポーター利用規約</a></div>
                <div class="footer_item"><a href="https://fanreturn.com/privacy_policy">プライバシーポリシー</a></div>
                <div class="footer_item"><a href="https://fanreturn.com/trade_law">特定商取引法に基づく表記</a></div>
                <div class="footer_item"><a href="https://fanreturn.com/inquiry/create">お問い合わせ</a></div>
                
                
            </div>
        </div><!--/.footer_inner-->
    </div><!--/.footer_main-->

    <div class="footer_under">
        <div class="footer_under_inner">
            <div class="footer_logo">
                <img class="h_logo_css" src="https://fanreturn.com/image/logo-color.svg">
            </div>
		<ul id="js-global-nav" class="p-gb_global-nav main-gb_menu gb_menu_base">
					
					<li id="gb_menu-item-1" class="gb_menu-item gb_menu-item-1 nav_btn m_t_1 under_arrow_no">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>%e3%83%97%e3%83%ad%e3%82%b8%e3%82%a7%e3%82%af%e3%83%88%e4%b8%80%e8%a6%a7/" id="top_gb_menu1" data-megamenu="js-megagb_menu1" class="nav_btn_link current_h_btn">
								<div>
									<p class="nav_btn_tit_L">エントリー一覧</p>
								</div>
							</a>
					</li>
			
					<li id="gb_menu-item-2" class="gb_menu-item gb_menu-item-2 nav_btn m_t_2 under_arrow_yes">
							<a href="https://fanreturn.com/" id="top_gb_menu2" data-megamenu="js-megagb_menu2" class="nav_btn_link">
								<div>
									<p class="nav_btn_tit_L">プロジェクト一覧</p>
								</div>
							</a>
					</li>
					
					<li id="gb_menu-item-3" class="gb_menu-item gb_menu-item-3 nav_btn m_t_3 under_arrow_no">
						
						<a href="https://fanreturn.com/question" id="top_gb_menu3" data-megamenu="js-megagb_menu3" class="nav_btn_link">
							<div><p class="nav_btn_tit_L">ファンリターンとは</p></div>
						</a>
					</li>
					
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



					</ul>
        </div><!--/.footer_inner-->
    </div><!--/.footer_under-->
</div>












</body>
</html>
