<?php
$dp_options = get_design_plus_option();

if ( is_singular( $dp_options['news_slug'] ) ) :
	get_template_part( 'single-news' );
	return;
endif;

$active_sidebars = get_active_sidebars();
get_header();
?>
<main class="l-main">
<?php
get_template_part( 'template-parts/page-header' );
get_template_part( 'template-parts/breadcrumb' );

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		if ( $post->page_link && in_array( $post->page_link, array( 'type1', 'type2' ) ) ) :
			$page_link = $post->page_link;
		else :
			$page_link = $dp_options['page_link'];
		endif;

		if ( $active_sidebars['column_layout_class'] ) :
?>
	<div class="l-inner <?php echo esc_attr( $active_sidebars['column_layout_class'] ); ?>">
<?php
		endif;
?>
		<article class="p-entry <?php echo $active_sidebars['column_layout_class'] ? 'l-primary' : 'l-inner'; ?>">
			<div class="p-entry__inner">
<?php
		if ( $dp_options['show_thumbnail'] && has_post_thumbnail() ) :
?>
				<div class="p-entry__thumbnail"><?php the_post_thumbnail( 'size5' ); ?></div>
<?php
		endif;
?>
				<div class="p-entry__header">
					<h1 class="p-entry__title"><?php the_title(); ?></h1>
<?php
		if ( $dp_options['show_author'] || $dp_options['show_date'] || $dp_options['show_views'] ) :
?>
					<ul class="p-entry__meta-top u-clearfix">
<?php
			if ( $dp_options['show_author'] ) :
				if ( function_exists( 'get_coauthors') ) :
					$authors = get_coauthors();
				else :
					$authors = array( get_user_by( 'id', $post->post_author ) );
				endif;
				if ( $authors && is_array( $authors ) ) :
					foreach ( $authors as $author ) :
						if ( ! $author->show_author ) continue;
?>
						<li class="p-entry__author">
							<a class="p-author__link p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php echo get_author_posts_url( $author->ID ); ?>">
								<span class="p-author__thumbnail p-hover-effect__image"><?php echo get_avatar( $author->ID, 60 ); ?></span>
								<span class="p-author__name"><?php echo esc_html( $author->display_name ); ?></span>
							</a>
						</li>


<?php
					endforeach;
				endif;
			endif;
			if ( $dp_options['show_date'] ) :
?>
						<li class="p-entry__date p-article__date"><time datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time></li>
<?php
			endif;
			if ( $dp_options['show_views'] ) :
?>
						<li class="p-entry__views p-article__views"><?php echo number_format( intval( $post->_views ) ); ?> views</li>
<?php
			endif;
?>
					</ul>
<?php
		endif;
?>
				</div>



<?php
		if ( $dp_options['show_sns_top'] ) :
			get_template_part( 'template-parts/sns-btn-top' );
		endif;
?>
				<div class="p-entry__body">
<?php
		the_content();

		if ( ! post_password_required() ) :
			if ( 'type2' === $page_link ):
				if ( $page < $numpages && preg_match( '/href="(.*?)"/', _wp_link_page( $page + 1 ), $matches ) ) :
?>
					<div class="p-entry__next-page">
						<a class="p-entry__next-page__link" href="<?php echo esc_url( $matches[1] ); ?>"><?php _e( 'Read more', 'tcd-w' ); ?></a>
						<div class="p-entry__next-page__numbers"><?php echo $page . ' / ' . $numpages; ?></div>
					</div>
<?php
				endif;
			else:
				wp_link_pages( array(
					'before' => '<div class="p-page-links">',
					'after' => '</div>',
					'link_before' => '<span>',
					'link_after' => '</span>'
				) );
			endif;
		endif;
?>

<?php //▼▼▼▼▼ACF▼▼▼▼▼ ?>



<?php while(has_sub_field('見出し＆文章＆画像')) : ?>

<?php if(get_row_layout() == '見出しのみ') : ?>
<div class="col-all <?php the_sub_field('見出しのみ-見出し-追加class(親)'); ?> col_<?php the_sub_field('見出しのみ-見出しタグ'); ?> animate" data-animate="fadeIn" data-duration="1.2s" data-delay="0.1s">
	<<?php the_sub_field('見出しのみ-見出しタグ'); ?> class="txt_tit_all <?php the_sub_field('見出しのみ-見出し-追加class'); ?>"><?php the_sub_field('見出しのみ-見出し'); ?></<?php the_sub_field('見出しのみ-見出しタグ'); ?>>
</div>
<?php endif; ?>

<?php if(get_row_layout() == '文章のみ') : ?>
<div class="col-all <?php the_sub_field('文章のみ-文章-追加class(親)'); ?> animate" data-animate="fadeIn" data-duration="1.2s" data-delay="0.1s">
	<div class="txt_all <?php the_sub_field('文章のみ-文章-追加class'); ?>"><?php $txt_p_br = get_sub_field('文章のみ-文章-自動整形');
     if ($txt_p_br == 'p_br_no') { $txt_p_br_no == 'false'; the_sub_field('文章のみ-文章',$txt_p_br_no); } else { the_sub_field('文章のみ-文章');}; ?>
	 </div>
</div>
<?php endif; ?>

<?php if(get_row_layout() == '画像のみ') : ?>
<div class="col-all img_base <?php the_sub_field('画像-追加class(親)'); ?> animate" data-animate="fadeIn" data-duration="1.2s" data-delay="0.1s">
	<img src="<?php the_sub_field('画像'); ?>"  class="img_all <?php the_sub_field('画像-追加class'); ?>" alt="<?php the_sub_field('画像説明(alt)'); ?>" />
	<?php if(get_sub_field('画像説明(キャプション)')): ?>
	<div class="img_caption"><?php the_sub_field('画像説明(キャプション)'); ?></div>
	<?php endif; ?>
</div>
<?php endif; ?>

<?php if(get_row_layout() == 'ファイルのみ') : ?>
<div class="col-all <?php the_sub_field('ファイル-追加class(親)'); ?> animate" data-animate="fadeIn" data-duration="1.2s" data-delay="0.1s">
	<a href="<?php the_sub_field('ファイル'); ?>" target="_blank" class="<?php the_sub_field('ファイル-追加class'); ?>"><?php the_sub_field('表示ファイル名'); ?></a>
</div>
<?php endif; ?>


<?php
//$file_name = get_field('ファイル',$postid);
//$file_name_01 = $file_name['url'];
?>
<?php //if(get_row_layout() == 'ファイルのみ') : ?>
<!--
<div class="col-all <?php //the_sub_field('ファイル-追加class(親)'); ?> animate" data-animate="fadeIn" data-duration="1.2s" data-delay="0.1s">
	<a href="<?php //echo $file_name_01; ?>" target="_blank" class="<?php //the_sub_field('ファイル-追加class'); ?>"><?php //the_sub_field('表示ファイル名'); ?></a>
</div>
-->
<?php //endif; ?>


<?php if(get_row_layout() == 'レイアウト（画像左用）') : ?>
<div class="col-all col-LR-base-L <?php the_sub_field('レイアウト-左-追加class(親)'); ?> animate" data-animate="fadeIn" data-duration="1.2s" data-delay="0.1s">
	<div class="col-L img_base <?php the_sub_field('画像-左-追加class(親)'); ?>">
		<img src="<?php the_sub_field('画像-左'); ?>"  class="img_all <?php the_sub_field('画像-左-追加class'); ?>" alt="<?php the_sub_field('画像-左-画像説明(alt)'); ?>" />
		<?php if(get_sub_field('画像-左-画像説明(キャプション)')): ?>
		<div class="img_caption"><?php the_sub_field('画像-左-画像説明(キャプション)'); ?></div>
		<?php endif; ?>
	</div>
	<div class="col-R <?php the_sub_field('見出し-右-追加class(親)'); ?> <?php the_sub_field('文章-右-追加class(親)'); ?>">
		<?php while(has_sub_field('見出し＆文章-右')) : ?>
			<?php if(get_row_layout() == '見出し-右') : ?>
				  <<?php the_sub_field('見出し-右-見出しタグ'); ?> class="txt_tit_all <?php the_sub_field('見出し-右-追加class'); ?>"><?php the_sub_field('見出し-右-見出し'); ?></<?php the_sub_field('見出し-右-見出しタグ'); ?>>
			<?php endif; ?>

			<?php if(get_row_layout() == '文章-右') : ?>
				  <div class="txt_all <?php the_sub_field('文章-右-追加class'); ?>"><?php the_sub_field('文章-右-文章'); ?></div>
			<?php endif; ?>

			<?php if(get_row_layout() == '余白ブロック') : ?>
				  <div class="yohaku_block"></div>
			<?php endif; ?>

		<?php endwhile; ?>
	</div>
</div>
<?php endif; ?>


<?php if(get_row_layout() == 'レイアウト（画像右用）') : ?>
<div class="col-all col-LR-base-R  <?php the_sub_field('レイアウト-右-追加class(親)'); ?> animate" data-animate="fadeIn" data-duration="1.2s" data-delay="0.1s">
	<div class="col-L <?php the_sub_field('見出し-左-追加class(親)'); ?> <?php the_sub_field('文章-左-追加class(親)'); ?>">
		<?php while(has_sub_field('見出し＆文章-左')) : ?>
			<?php if(get_row_layout() == '見出し-左') : ?>
				  <<?php the_sub_field('見出し-左-見出しタグ'); ?> class="txt_tit_all <?php the_sub_field('見出し-左-追加class'); ?>"><?php the_sub_field('見出し-左-見出し'); ?></<?php the_sub_field('見出し-左-見出しタグ'); ?>>
			<?php endif; ?>

			<?php if(get_row_layout() == '文章-左') : ?>
				  <div class="txt_all <?php the_sub_field('文章-左-追加class'); ?>"><?php the_sub_field('文章-左-文章'); ?></div>
			<?php endif; ?>

			<?php if(get_row_layout() == '余白ブロック') : ?>
				  <div class="yohaku_block"></div>
			<?php endif; ?>

		<?php endwhile; ?>
	</div>
	<div class="col-R img_base <?php the_sub_field('画像-右-追加class(親)'); ?>">
		<img src="<?php the_sub_field('画像-右'); ?>"  class="img_all <?php the_sub_field('画像-右-追加class'); ?>" alt="<?php the_sub_field('画像-右-画像説明(alt)'); ?>" />
		<?php if(get_sub_field('画像-右-画像説明(キャプション)')): ?>
		<div class="img_caption"><?php the_sub_field('画像-右-画像説明(キャプション)'); ?></div>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>



<?php if(get_row_layout() == 'htmlソースコード') : ?>
<div class="col-all <?php the_sub_field('html_ソースコード-追加class(親)'); ?> animate" data-animate="fadeIn" data-duration="1.2s" data-delay="0.1s">
	<?php the_sub_field('html_ソースコード'); ?>
</div>
<?php endif; ?>


<?php if(get_row_layout() == '余白ブロック') : ?>
<div class="col-all yohaku_block"></div>
<?php endif; ?>


<?php if(get_row_layout() == '動画挿入（youtube）') : ?>
<div class="col-all">
	<div class="youtube_video_Box">
		<?php $embed_code_youtube = get_sub_field('youtubeのurl'); echo $embed_code = wp_oembed_get($embed_code_youtube); ?>
	</div>
	<?php if(get_sub_field('動画タイトル')): ?>
		<div class="video_tit"><i class="fas fa-film"></i>  <?php the_sub_field('動画タイトル'); ?></div>
	<?php endif; ?>
</div>
<?php endif; ?>


<?php if(get_row_layout() == '動画挿入（html5）') : ?>
<div class="col-all">
	<div class="mp4_video_Box">
		<video class="wp-video" src="<?php the_sub_field('mp4ファイル'); ?>" muted controls metadata></video>
	</div>
	<?php if(get_sub_field('動画タイトル')): ?>
		<div class="video_tit"><i class="fas fa-film"></i>  <?php the_sub_field('動画タイトル'); ?></div>
	<?php endif; ?>
</div>
<?php endif; ?>



<?php if(get_row_layout() == 'テーブル') : ?>

<div class="col-all <?php the_sub_field('テーブル-追加class(親)'); ?> animate" data-animate="fadeIn" data-duration="1.2s" data-delay="0.1s">
<style><?php the_sub_field('テーブルスタイル'); ?></style>

<?php $switch_table = get_sub_field('テーブル切り替え'); ?>
<?php if ($switch_table == 'tag_table') { ?>

	<?php
	$table = get_sub_field( 'テーブルベース' );
	$count_t_item_01 = 0;
	$count_t_item_02 = 0;
	$count_t_item_03 = 0;
	if ( ! empty ( $table ) ) {
		echo '<table cellpadding="0" border="0" class="default-table-base ';
			the_sub_field('テーブル-追加class');
		echo '">';
			if ( ! empty( $table['caption'] ) ) {
				echo '<caption class="table_caption">' . $table['caption'] . '</caption>';
			}
			if ( ! empty( $table['header'] ) ) {
				echo '<thead class="default-th-base ">';
					echo '<tr class="default-th-tr ';
						the_sub_field('TR-追加class');
					echo '">';
						foreach ( $table['header'] as $th ) {
							$count_t_item_01++;
							echo '<th class="default-th-th ';
								the_sub_field('TH-追加class');
								echo ' ';
								the_sub_field('TH-追加class');
								echo '-';
								echo $count_t_item_01;
							echo '"><div>';
								echo $th['c'];
							echo '</div></th>';
						}
					echo '</tr>';
				echo '</thead>';
			}
			echo '<tbody>';
				foreach ( $table['body'] as $tr ) {
					$count_t_item_02++;
					echo '<tr class="default-tr ';
						the_sub_field('TR-追加class');
						echo ' ';
						the_sub_field('TR-追加class');
						echo '-';
						echo $count_t_item_02;
					echo '">';

					$count_t_item_03 = 0;
						foreach ( $tr as $td ) {
							$count_t_item_03++;
							echo '<td class="default-td ';
								the_sub_field('TD-追加class');
								echo ' ';
								the_sub_field('TD-追加class');
								echo '-';
								echo $count_t_item_03;
							echo '"><div>';
								echo $td['c'];
							echo '</div></td>';
						}
					echo '</tr>';
				}
			echo '</tbody>';
		echo '</table>';
	}
	?>

<?php  } else { ?>

	<?php
	$table = get_sub_field( 'テーブルベース' );
	$count_t_item_01 = 0;
	$count_t_item_02 = 0;
	$count_t_item_03 = 0;
	if ( ! empty ( $table ) ) {
		echo '<div class=" div_table ';
			the_sub_field('テーブル-追加class');
		echo '">';
			if ( ! empty( $table['caption'] ) ) {
				echo '<div class="table_caption">' . $table['caption'] . '</div>';
			}
			if ( ! empty( $table['header'] ) ) {
				echo '<div>';
					echo '<div class="';
						the_sub_field('TR-追加class');
					echo '">';
						foreach ( $table['header'] as $th ) {
							$count_t_item_01++;
							echo '<div class="';
								the_sub_field('TH-追加class');
								echo ' ';
								the_sub_field('TH-追加class');
								echo '-';
								echo $count_t_item_01;
							echo '"><div>';
								echo $th['c'];
							echo '</div></div>';
						}
					echo '</div>';
				echo '</div>';
			}
			echo '<div>';
				foreach ( $table['body'] as $tr ) {
					$count_t_item_02++;
					echo '<div class="';
						the_sub_field('TR-追加class');
						echo ' ';
						the_sub_field('TR-追加class');
						echo '-';
						echo $count_t_item_02;
					echo '">';

					$count_t_item_03 = 0;
						foreach ( $tr as $td ) {
							$count_t_item_03++;
							echo '<div class="';
								the_sub_field('TD-追加class');
								echo ' ';
								the_sub_field('TD-追加class');
								echo '-';
								echo $count_t_item_03;
							echo '"><div>';
								echo $td['c'];
							echo '</div></div>';
						}
					echo '</div>';
				}
			echo '</div>';
		echo '</div>';
	}
	?>

<?php  }; ?>

</div>
<?php endif; ?>


<?php endwhile; ?>
<?php //▲▲▲▲▲ACF▲▲▲▲▲ ?>

<div class="txt_tit_basic">
	<h3><span>Introduction</span><b>はじめに</b></h3>
</div>

<?php //▼▼▼▼▼募集要項▼▼▼▼▼ ?>
<?php the_field('タイトル') ?>
<?php the_field('サブタイトル') ?>
<?php the_field('説明') ?>
<?php while(has_sub_field('募集要項')) : ?>

<?php if(get_row_layout() == 'テーブル') : ?>

<?php the_sub_field('見出し') ?>
<?php the_sub_field('内容') ?>
<?php endif; ?>
<?php endwhile; ?>

<?php echo '<br>'; ?>
<?php //▼▼▼▼▼フロー▼▼▼▼▼ ?>

<?php the_field('フロータイトル') ?>
<?php the_field('フローサブタイトル') ?>
<?php while(has_sub_field('フロー詳細')) : ?>

<?php if(get_row_layout() == '詳細') : ?>

<?php the_sub_field('番号') ?>
<?php the_sub_field('項目') ?>
<?php the_sub_field('詳細テキスト') ?>
<?php endif; ?>
<?php endwhile; ?>

<?php //▼▼▼▼▼掲載相談▼▼▼▼▼ ?>
<?php
  $form = get_field('form');
  if( $form && in_array('on', $form)){
	echo do_shortcode('[contact-form-7 id="84" title="掲載相談"]');
  }
?>



				</div>
<?php
		if ( $dp_options['show_sns_btm'] ) :
			get_template_part( 'template-parts/sns-btn-btm' );
		endif;

		if ( $dp_options['show_category'] || $dp_options['show_tag'] || $dp_options['show_comment'] ) :
?>
				<ul class="p-entry__meta c-meta-box u-clearfix">
					<?php if ( $dp_options['show_category'] ) : ?><li class="c-meta-box__item c-meta-box__item--category"><?php the_category( ', ' ); ?></li><?php endif; ?>
					<?php if ( $dp_options['show_tag'] && get_the_tags() ) : ?><li class="c-meta-box__item c-meta-box__item--tag"><?php echo get_the_tag_list( '', ', ', '' ); ?></li><?php endif; ?>
					<?php if ( $dp_options['show_comment'] ) : ?><li class="c-meta-box__item c-meta-box__item--comment"><?php _e( 'Comments', 'tcd-w' ); ?>: <a href="#comment_headline"><?php echo get_comments_number( '0', '1', '%' ); ?></a></li><?php endif; ?>
				</ul>
<?php
		endif;

		$previous_post = get_previous_post();
		$next_post = get_next_post();
		if ( $dp_options['show_next_post'] && ( $previous_post || $next_post ) ) :
?>
				<ul class="p-entry__nav c-entry-nav">
<?php
			if ( $previous_post ) :
?>
					<li class="c-entry-nav__item c-entry-nav__item--prev">
						<a href="<?php echo esc_url( get_permalink( $previous_post->ID ) ); ?>" data-prev="<?php _e( 'Previous post', 'tcd-w' ); ?>"><span class="u-hidden-sm"><?php echo esc_html( mb_strimwidth( strip_tags( $previous_post->post_title ), 0, 64, '...' ) ); ?></span></a>
					</li>
<?php
			else :
?>
					<li class="c-entry-nav__item c-entry-nav__item--empty"></li>
<?php
			endif;
			if ( $next_post ) :
?>
					<li class="c-entry-nav__item c-entry-nav__item--next">
						<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" data-next="<?php _e( 'Next post', 'tcd-w' ); ?>"><span class="u-hidden-sm"><?php echo esc_html( mb_strimwidth( strip_tags( $next_post->post_title ), 0, 64, '...' ) ); ?></span></a>
					</li>
<?php
			else :
?>
					<li class="c-entry-nav__item c-entry-nav__item--empty"></li>
<?php
			endif;
?>
				</ul>
<?php
		endif;

		get_template_part( 'template-parts/advertisement' );
?>
			</div>
<?php
		if ( $dp_options['show_related_post'] ) :
			$args = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'post__not_in' => array( $post->ID ),
				'posts_per_page' => $dp_options['related_post_num'],
				'orderby' => 'rand'
			);
			$categories = get_the_category();
			if ( $categories ) :
				$category_ids = array();
				foreach ( $categories as $key => $category ) :
					if ( !empty( $category->term_id ) ) :
						if ( 0 === $key ) :
							$term_meta = get_option( 'taxonomy_' . $category->term_id, array() );
							if ( ! empty( $term_meta['color'] ) ) :
								$related_bg = $term_meta['color'];
							endif;
						endif;
						$category_ids[] = $category->term_id;
					endif;
				endforeach;
				if ( $category_ids ) :
					$args['tax_query'][] = array(
						'taxonomy' => 'category',
						'field' => 'term_id',
						'terms' => $category_ids,
						'operator' => 'IN'
					);
				endif;
			endif;
			$the_query = new WP_Query( $args );
			if ( $the_query->have_posts() ) :
?>
			<section class="p-entry__related">
<?php
				if ( $dp_options['related_post_headline'] ) :
?>
				<h2 class="p-headline"<?php if ( ! empty( $related_bg ) ) echo ' style="background-color: ' . esc_attr( $related_bg ) . '"'; ?>><?php echo esc_html( $dp_options['related_post_headline'] ); ?></h2>
<?php
				endif;
?>
				<div class="p-entry__related-items">
<?php
				$post_count = 0;
				$post_count_with_ad = 0;

				while ( $the_query->have_posts() ) :
					$the_query->the_post();
					$post_count++;
					$post_count_with_ad++;
?>
					<article class="p-entry__related-item">
						<a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php the_permalink(); ?>">
							<div class="p-entry__related-item__thumbnail p-hover-effect__image js-object-fit-cover">
<?php
					echo "\t\t\t\t\t\t\t\t";
					if ( has_post_thumbnail() ) :
						the_post_thumbnail( 'size1' );
					else :
						echo '<img src="' . get_template_directory_uri() . '/img/no-image-300x300.gif" alt="">';
					endif;
					echo "\n";
?>
							</div>
							<h3 class="p-entry__related-item__title p-article__title"><?php echo mb_strimwidth( strip_tags( get_the_title() ), 0, 54, '...' ); ?></h3>
<?php
					if ( $dp_options['show_date'] ) :
?>
							<p class="p-entry__related-item__meta p-article__meta"><time class="p-article__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time></p>
<?php
					endif;
?>
						</a>
					</article>
<?php
					// ネイティブ広告
					if ( $dp_options['show_related_post_native_ad'] && 0 === $post_count % $dp_options['related_post_native_ad_position'] ) :
						$native_ad = get_native_ad();
						if ( $native_ad ) :
							$post_count_with_ad++;
?>
					<article class="p-entry__related-item">
						<a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php echo esc_attr( $native_ad['native_ad_url'] ); ?>"<?php if ( ! empty( $native_ad['native_ad_target'] ) ) echo ' target="_blank"'; ?>>
							<div class="p-entry__related-item__thumbnail p-hover-effect__image js-object-fit-cover">
<?php
							echo "\t\t\t\t\t\t\t\t";
							if ( $native_ad['native_ad_image'] ) :
								$image_src = wp_get_attachment_image_src( $native_ad['native_ad_image'], 'size1' );
							else :
								$image_src = null;
							endif;
							if ( ! empty( $image_src[0] ) ) :
								echo '<img src="' . esc_attr( $image_src[0] ) . '" alt="">';

							else :
								echo '<img src="' . get_template_directory_uri() . '/img/no-image-300x300.gif" alt="">';
							endif;
							echo "\n";
?>
							</div>
<?php
							if ( $native_ad['native_ad_title'] ) :
								echo "\t\t\t\t\t\t\t";
								echo '<h3 class="p-entry__related-item__title p-article__title">' . esc_html( mb_strimwidth( $native_ad['native_ad_title'], 0, 54, '...' ) ) . '</h3>' . "\n";
							endif;

							if ( $native_ad['native_ad_label'] ) :
								echo "\t\t\t\t\t\t\t";
								echo '<p class="p-entry__related-item__meta p-article__meta"><span class="p-article__native-ad-label">' . esc_html( $native_ad['native_ad_label'] ) . '</span></p>' . "\n";
							endif;
?>
						</a>
					</article>
<?php
						endif;
					endif;

					if ( $post_count_with_ad >= $dp_options['related_post_num'] ) :
						break;
					endif;
				endwhile;

				if ( $active_sidebars['sidebar_a'] && $active_sidebars['sidebar_b'] ) :
					$related_cols = 4;
				else :
					$related_cols = 5;
				endif;
				if ( $post_count_with_ad % $related_cols > 0 ) :
					echo "\t\t\t\t\t" . str_repeat('<div class="p-entry__related-item u-hidden-sm"></div>', $related_cols - ( $post_count_with_ad % $related_cols ) ) . "\n";
				endif;

				wp_reset_postdata();
?>
				</div>
			</section>
<?php
			endif;
		endif;

		if ( $dp_options['show_comment'] ) :
			comments_template( '', true );
		endif;
?>
		</article>
<?php
	endwhile;
endif;

if ( $active_sidebars['column_layout_class'] ) :
	get_sidebar();
?>
	</div>
<?php
endif;
?>
</main>
<?php get_footer(); ?>
