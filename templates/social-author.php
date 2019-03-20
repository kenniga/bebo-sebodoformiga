<ul class="list-social">
	<?php
	global $beau_option;
	if (isset($beau_option['show-social-link'])) {
		if ($beau_option['show-social-link']) {
			foreach($beau_option['show-social-link'] as $key=> $social){
				if(isset($beau_option['beau-'.$social])){
					echo '<li><a href="'.esc_url($beau_option['beau-'.$social]).'" target="_blank"><i class="fa fa-'.esc_attr($social).'"></i></a></li>';
				}
			}
		}
	}
	?>
</ul>