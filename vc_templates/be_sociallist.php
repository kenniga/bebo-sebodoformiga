<?php
$title_box = "";
extract(shortcode_atts(array(
    'title_box'	=> '',
), $atts));
?>
<div class="super-ftop social col-md-12 col-sm-12 col-xs-12">
	<div class="title-box book-center">
		<span><?php echo esc_attr($title_box); ?></span>
	</div>
	<div class="clearfix"></div>
	<div class="social-list-footer book-center">
	<?php
		global $beau_option;
        if (isset($beau_option['show-social-link'])) {
		  $list_social = $beau_option['show-social-link'];
        }else{
            $list_social = array();
        }
	?>
		<ul class="social-list no-border book-center">
		<?php
			foreach ($list_social as $key => $value) {
				if (isset($beau_option['beau-'.$value]) && $beau_option['beau-'.$value]) {
					$url_social = $beau_option['beau-'.$value];
		?>
			<li><a href="<?php echo esc_url($url_social)?>"><i class="<?php printf('fa fa-%s', $value);?>"></i></a></li>
		<?php }
			}
		?>
		</ul>
	</div>
</div>
