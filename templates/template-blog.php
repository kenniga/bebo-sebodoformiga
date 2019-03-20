<?php
/*
* Template Name: Template blogs
*/
get_header();
if ( have_posts() ) :
global $beau_option;

$page_setting = get_post_meta(get_the_ID(), '_beautheme_archive_custom', TRUE);
if (isset($beau_option['archive-type'])) {
	$beau_archive = $beau_option['archive-type'];
}else{
	$beau_archive = NULL;
}
if($beau_archive==NULL){
	$beau_archive = "default";
}
if($beau_archive==NULL){
	$beau_archive = "default";
}
if ($page_setting !=="") {
	$beau_archive = $page_setting;
}
//Get template part to page setting or theme option
get_template_part('templates/archive', $beau_archive);
else :
	get_template_part( 'content', 'none' );
endif;
get_footer();
?>