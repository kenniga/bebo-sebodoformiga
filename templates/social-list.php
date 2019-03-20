<?php
global $beau_option;
if ($beau_option) {
	if ($beau_option['show-social-link']) {
		echo '<ul class="list-social">';
		foreach($beau_option['show-social-link'] as $key=> $social){
			if(isset($beau_option['beau-'.$social])){
				echo '<li><a href="'.esc_url($beau_option['beau-'.$social]).'" target="_blank"><i class="fa fa-'.esc_attr($social).'"></i></a></li>';
			}
		}
		echo '</ul>';
	}
}
?>