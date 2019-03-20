<?php
get_header();
global $beau_option;
if (isset($beau_option['archive-type'])) {
	$beau_archive = $beau_option['archive-type'];
}else{
	$beau_archive = NULL;
}
if($beau_archive==NULL){
	$beau_archive = "default";
}
if (isset($_GET['post_type'])) {
    echo "yeah product";
}else{
    get_template_part('templates/archive', $beau_archive);
}
get_footer();
?>