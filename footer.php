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

		<div class="modal modal-uph modal-uph__video modal-jm modal-jm__video fade" id="video-modal" tabindex="-1" role="dialog" aria-labelledby="videoModalTitle" aria-hidden="true">
			<div class="close close-overlay" data-dismiss="modal" aria-label="Close"></div>
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 100 100" overflow="visible" enable-background="new 0 0 100 100" xml:space="preserve">
					<line fill="none" stroke="#fff" stroke-width="12" stroke-linecap="square" x1="10" y1="10" x2="90" y2="90"></line>
					<line fill="none" stroke="#fff" stroke-width="12" stroke-linecap="square" x1="90" y1="10" x2="10" y2="90"></line>
					</svg>
				</button>
				<div class="modal-body">
					<div class="video-wrapper">
					<iframe src="" frameborder="0" allowfullscreen></iframe>
					</div>
				</div>
				</div>
			</div>
		</div>
	
<?php wp_footer();?>
</body>
</html>