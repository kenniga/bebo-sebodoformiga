<?php 
 global $beau_option;
?>
<div class="payment">
<?php
	global $beau_option;
	if (isset($beau_option['link-payment'])) {
		foreach ($beau_option['link-payment'] as $key => $value) {
			if ($beau_option['store-'.$value] !="") {
?>
			<a href="<?php echo esc_url($beau_option['store-'.$value]);?>"><img src="<?php printf('%s/asset/images/%s.png', get_template_directory_uri(), $value ); ?>" alt="Payment method"></a>
<?php
			}
		}
	}
?>
</div>
<div class="copyright">
	<?php if (isset($beau_option['store-footer-text'])): ?>
		<span class="text-copyright"><?php printf('%s', $beau_option['store-footer-text'])?></span>
	<?php endif ?>
	<?php if (!isset($beau_option['store-footer-text'])): ?>
		<span class="text-copyright"><?php esc_html_e('Copyright &copy;','bebostore');?> <?php echo date('Y');?> <a href="<?php esc_url(home_url( '/' ));?>"><?php echo bloginfo( 'name' );?></a>. <?php esc_html_e('All Rights Reserved.', 'bebostore'); ?></span>
	<?php endif ?>
</div>