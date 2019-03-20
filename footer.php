	<?php
		global $beau_option;
		if (!is_404()) {
			$footer_page 	= get_post_meta(get_the_ID(), '_beautheme_footer_custom', TRUE );
            if (isset($beau_option['footer-type'])) {
                $footer_setting = $beau_option['footer-type'];
            }else{
                $footer_setting = "";
            }
			if ($footer_page) {
				$footer_setting = $footer_page;
			}
			if ($footer_setting == '') {
				$footer_setting = "default";
			}
			get_template_part('templates/footer', $footer_setting );
		}
	?>
	<?php if ($beau_option['enable_back_to_top'] != '1'): ?>
		<a href="#" class="back-to-top"></a>
	<?php endif ?>
	
<?php wp_footer();?>
</body>
</html>