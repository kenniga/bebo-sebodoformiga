<?php
global $beau_option;

$title_store = $number_store = "";
extract(shortcode_atts(array(
	'title_store' => '',
	'number_store' => ''
), $atts));
$img = shortcode_atts(array(
        'store_image' => 'store_image',
    ), $atts);
$img_arr = wp_get_attachment_image_src($img["store_image"], "full");
$url_img = $img_arr[0];
?>
<section class="sc-store">
	<div class="list-store">
		<div class="container">
			<div class="row justify-content-center">
				<?php 
				$args = array(
					'post_type'=> 'store','posts_per_page' => $number_store,
				);
				$loop = new WP_Query( $args);
				wp_reset_postdata();
				?>
				<?php if ($loop->have_posts()) {?>
					<?php while ($loop->have_posts()) { $loop ->the_post();?>
					<div class="item-store col-10">
						<div class="store-title"><?php the_title();?></div>
						<div class="store-address">
							<?php if (!empty(get_post_meta(get_the_ID(), '_beautheme_store_address', TRUE))) : ?>
								<div class="address-block">
									<?php echo get_post_meta(get_the_ID(), '_beautheme_store_address', TRUE);?>
								</div>
							<?php endif; ?>
							<?php if (!empty(get_post_meta(get_the_ID(), '_beautheme_store_phone', TRUE))) : ?>
							<div class="phone-block">
								<?php echo get_post_meta(get_the_ID(), '_beautheme_store_phone', TRUE);?>
							</div>
							<?php endif; ?>
							<?php if (!empty(get_post_meta(get_the_ID(), '_beautheme_store_email', TRUE))) : ?>
							<div class="email-block">
								<?php echo get_post_meta(get_the_ID(), '_beautheme_store_email', TRUE);?>
							</div>
							<?php endif; ?>
							<?php if (!empty(get_post_meta(get_the_ID(), '_beautheme_store_open', TRUE))) : ?>
							<div class="hours-block">
								<?php echo get_post_meta(get_the_ID(), '_beautheme_store_open', TRUE);?>
							</div>
							<?php endif; ?>
							<?php 
								if ($beau_option) {
									if ($beau_option['show-social-link']) {
										echo '
										<ul class="socials-block">';
										foreach($beau_option['show-social-link'] as $key=> $social){
											if(isset($beau_option['beau-'.$social])){
												echo '<li><a href="'.esc_url($beau_option['beau-'.$social]).'" target="_blank"><i class="fa fa-'.esc_attr($social).'"></i></a></li>';
											}
										}
										echo '</ul>';
									}
								}
							?>
						</div>
					</div>
					<?php }?>
				<?php }?>

			</div>
		</div>
	</div>
</section>