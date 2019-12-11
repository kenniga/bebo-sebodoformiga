<?php
$show_on_page = "";
extract(shortcode_atts(array(
    'show_on_page' => ''
), $atts));

$images_array = get_field('home_slider_responsive' , $show_on_page);

?>

<div class="sc-heroslider swiper-container-sliders">
	<div class="swiper-wrapper">
		<?php
			foreach ($images_array as $value) {
				?>
					<!-- Slides -->
					<div class="swiper-slide">
						<img src="<?php echo esc_url($value['url']) ?>" alt="">
					</div>
				<?php
			}
		?>
</div>

<?php if( count($images_array) > 1 ) { ?>
	<div class="swiper-button-prev swiper-button-white"></div>
	<div class="swiper-button-next swiper-button-white"></div>
<?php } ?>

</div>

<script>
	(function($) {
	
	var mySwiper = new Swiper('.swiper-container-sliders', {
		speed: 400,
		height: 100,
		<?php if( count($images_array) > 1 ) { ?>
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
		<?php } ?>
	});
})(jQuery);
</script>