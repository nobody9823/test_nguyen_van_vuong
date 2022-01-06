<?php
$course_category = get_queried_object();
wp_redirect(get_post_type_archive_link('course').'#course_category-'.$course_category->term_id);
exit;
