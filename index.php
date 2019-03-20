<?php
//Index default template
get_header();
if (is_home()) {
	global $beau_option;
	if (isset($beau_option['archive-type'])) {
		$beau_archive = $beau_option['archive-type'];
	}else{
		$beau_archive = NULL;
	}
	if($beau_archive==NULL){
		$beau_archive = "default";
	}
	get_template_part('templates/archive', $beau_archive);
}else{
	get_template_part('templates/section','one-column-full');
}
get_footer();
?>