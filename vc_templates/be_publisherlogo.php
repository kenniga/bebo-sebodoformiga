<?php
$perpage = $perslide = "";
extract(shortcode_atts(array(
    'perpage' 			=> '',
    'perslide' 			=> '5',
), $atts));
$idparthNer = 'parthner_id_'.rand(100, 999);
$args = array(
	'post_type' 		=> 'publisher',
	'posts_per_page' 	=> $perpage,
);
$loop = new WP_Query( $args);
wp_reset_postdata();
?>
<div id="<?php printf('%s',$idparthNer)?>" class="parther-list">
	<div class="list-parthner">
	<?php if ($loop->have_posts()) {?>
		<div class="swiper-container parthner-slider">
			<div class="swiper-wrapper">
				<?php while ($loop->have_posts()){ $loop ->the_post();
					$publisherAvatar = get_post_meta(get_the_ID(), '_beautheme_type_image', TRUE);
					// $publisherAvatar_ID 	= beau_get_attachment_id_from_url($publisherAvatar);
					// $authorAvatar = wp_get_attachment_image( $publisherAvatar_ID, 'publisher-thumbnail' );
					if ($publisherAvatar == "") {
						$authorAvatar = '<img src="http://placehold.it/188x58">';
					} else {
                        $authorAvatar = '<img src="'.$publisherAvatar.'">';
                    }
				?>
				<div class="swiper-slide">
					<a href="<?php echo esc_url(get_the_permalink()); ?>"><?php printf('%s', $authorAvatar);?></a>
				</div>
				<?php }?>
			</div>
		</div>
	<?php }	?>
	</div>
</div>
<script>
	(function($) {
		"use strict";
		var <?php printf("parthNerSlide%s", $idparthNer); ?> = new Swiper('<?php printf("#%s .parthner-slider", $idparthNer); ?>', {
			slidesPerView: 5,
			slidesPerGroup: 3,
			breakpoints: {
				320: {
					slidesPerView: 1,
					slidesPerGroup: 1,
				},
				// when window width is <= 480px
				480: {
					slidesPerView: 2,
					slidesPerGroup: 1
				},
				// when window width is <= 640px
				640: {
					slidesPerView: 3,
					slidesPerGroup: 2,
				},
				// when window width is <= 640px
				991: {
					slidesPerView: 4,
					slidesPerGroup: 3
				}
			},
			grabCursor:false,
			speed: 1000,
		});
	})(jQuery);
</script>
