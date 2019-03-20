<?php
$testi_pagging = $show_perpage = $testi_type = $show_nav = "";
extract(shortcode_atts(array(
    'testi_pagging'	=> '',
    'show_perpage'	=> '',
    'testi_type'	=> '',
    'show_nav' => ''
), $atts));
$args = array(
	'post_type' 		=> 'testimonial',
	'posts_per_page' 	=> $testi_pagging,
);
$loop = new WP_Query( $args);
wp_reset_postdata();
$id_testi  =  "testi_id_".rand(1111,9999);
if (!$show_perpage) {
	$class = "testi-half-hard";
}else{
	$class = "";
}
?>
<?php if ($testi_type == 'ahalf'): ?>
<div id="<?php echo esc_attr($id_testi);?>" class="testimonial-half col-md-12 col-sm-12 col-xs-12 <?php printf('%s', $class)?>">

	<div class="swiper-container book-half-testimonial half-testmoni pull-right col-md-10 col-sm-10 col-xs-12">
		<div class="swiper-wrapper">
			<?php if ($loop->have_posts()) {?>
			<?php while ($loop->have_posts()) { $loop ->the_post();?>
			<div class="swiper-slide">
				<div class="testi-message">"<?php echo get_post_meta(get_the_ID(), '_beautheme_testimonial_message', TRUE);?>"</div>
				<div class="testi-author">
					<ul>
						<li><?php the_title();?></li>
						<li><?php echo get_post_meta(get_the_ID(), '_beautheme_author_job', TRUE);?></li>
					</ul>
				</div>
			</div>
			<?php }?>
			<?php }?>
		</div>
	</div><!--End swiper-container-->

	<?php if ($show_nav == true): ?>
		<div class="btn-prev btn-white testimonial-button-prev"></div>
		<div class="btn-next btn-white testimonial-button-next"></div>


		<script>
			(function($) {
				"use strict";
				var testiMonialHalf_<?php echo esc_js($id_testi);?> = new Swiper('#<?php echo esc_js($id_testi);?> .book-half-testimonial', {
					slidesPerView: 1,
					grabCursor:true,
					speed: 1000,
					loop: true,
					navigation: {
						nextEl: '#<?php echo esc_js($id_testi);?> .testimonial-button-next',
						prevEl: '#<?php echo esc_js($id_testi);?> .testimonial-button-prev',
					},
				  });
			})(jQuery);
		</script>
	<?php endif ?>
	<?php if ($show_nav != true): ?>
	<script>
		(function($) {
			"use strict";
			var testiMonialHalf_<?php echo esc_js($id_testi);?> = new Swiper('#<?php echo esc_js($id_testi);?> .book-half-testimonial', {
			      slidesPerView: 1,
			      grabCursor:true,
			      speed: 1000,
			      autoplay:3000,
			      loop: true,
			  });
		})(jQuery);
	</script>
	<?php endif ?>
</div>
<?php endif ?>
<?php if ($testi_type == 'full_layout' || $testi_type != 'ahalf' ): ?>
<div id="<?php echo esc_attr($id_testi);?>" class="testimonial-section">
	<div class="testimonial">
		<div class="container">
			<div class="swiper-container book-testimonial">
				<div class="swiper-wrapper">
					<?php if ($loop->have_posts()) {?>
					<?php while ($loop->have_posts()) { $loop ->the_post();?>
					<div class="swiper-slide">
						<div class="testimonial-author">
							<span class="author-name"><?php the_title();?></span>
							<?php
								$authorAvatar  		= get_post_meta(get_the_ID(), '_beautheme_type_image', TRUE);
								// $authorAvatar_ID 	= beau_get_attachment_id_from_url($authorAvatar);
								// $authorAvatar = wp_get_attachment_image( $authorAvatar_ID );
								if ($authorAvatar == "") {
									$authorAvatar = '<img src="http://placehold.it/87x87" alt="No avatar">';
								} else {
                                    $authorAvatar = '<img src="'.$authorAvatar.'" alt="No avatar">';
                                }
							?>
							<span class="author-avatar"><?php print $authorAvatar;?></span>
							<span class="author-job"><?php echo get_post_meta(get_the_ID(), '_beautheme_author_job', TRUE);?></span>
						</div>
						<div class="testimonial-message">
							<span class="message">" <?php echo get_post_meta(get_the_ID(), '_beautheme_testimonial_message', TRUE);?> "</span>
						</div>
					</div>
					<?php }?>
					<?php }?>
				</div><!--End testimonial wraper-->
			</div><!--End testimonial container-->
			<div class="btn-prev btn-white testimonial-button-prev"></div>
			<div class="btn-next btn-white testimonial-button-next"></div>
			<script>
				(function($) {
					"use strict";
					var testiMonial_<?php echo esc_js($id_testi);?> = new Swiper('#<?php echo esc_js($id_testi);?> .book-testimonial', {
						slidesPerView: 1,
						grabCursor:true,
						speed: 1000,
						autoplay:3000,
						loop: true,
						navigation: {
							nextEl: '#<?php echo esc_js($id_testi);?> .testimonial-button-next',
							prevEl: '#<?php echo esc_js($id_testi);?> .testimonial-button-prev',
						},
					});
				})(jQuery);
			</script>
		</div>
	</div>
</div>
<?php endif ?>
