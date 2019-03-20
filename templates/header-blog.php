<?php
	$page_setting  = get_post_meta(get_the_ID(), '_beautheme_archive_custom', TRUE);
	$title_page    = get_the_title();
	$cover_cat     = '';

    //Default page
    if(is_category()){
        $cat = get_category_by_path(get_query_var('category_name'),false);
        $title_page = $cat->cat_name;
    }
    if (is_tag()) {
        $postTag = get_term_by('slug', get_query_var('tag'), 'post_tag');
        $title_page = esc_html__('Tag: ','bebostore').$postTag->name;
    }
    if (is_search()) {
        $title_page = esc_html__('Search with keywords: ','bebostore').esc_html($_REQUEST['s']);
    }
    //Page setting
	if (!$page_setting) {
		$cat_id = get_query_var('cat');
		$style_page = "";
		if (function_exists('z_taxonomy_image_url')){
			$cover_cat = z_taxonomy_image_url($cat_id, NULL, TRUE);
		}
		$title_page = get_cat_name( $cat_id );
	}else{
		$cover_cat  =  get_post_meta(get_the_ID(), '_beautheme_archive_custom_cover', TRUE);
		if (!($cover_cat) || ($cover_cat=="") || ($cover_cat && $cover_cat!="" && !(file_exists($cover_cat)))){
			$cover_cat  =  get_the_post_thumbnail_url(get_the_ID(), 'full');
		}
	}
    if ($cover_cat=="") {
       $cover_cat = "http://placehold.it/400x1368";
    }
	$style_page = 'style="background-image: url('.$cover_cat.')"';
	$paged = get_query_var('paged') ? get_query_var('paged') : 1;
	$args = array(
		'post_type'  => 'post',
		'paged' 	 => $paged,
	);
?>
