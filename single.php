<?php
get_header();
global $beau_option;
if (isset($beau_option['single-page'])) {
	$beau_single = $beau_option['single-page'];
}else{
	$beau_single = NULL;
}
if($beau_single==NULL){
	$beau_single = "detail";
}
get_template_part('templates/content', $beau_single);
get_footer();
?>