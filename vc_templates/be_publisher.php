<?php
$title_publisher = $number_publisher = "";
extract(shortcode_atts(array(
	'title_publisher' => '',
	'number_publisher' => ''
), $atts));
$img = shortcode_atts(array(
        'publisher_image' => 'publisher_image',
    ), $atts);
$img_arr = wp_get_attachment_image_src($img["publisher_image"], "full");
$url_img = $img_arr[0];
?>
<section class="header-page store-header" style="background: url(<?php print($url_img); ?>) no-repeat; background-size: cover;">
	<div class="container">
		<div class="title-page"><?php print($title_publisher); ?></div>
	</div>
</section>
<section>
	<div class="list-store">
		<div class="container">
		<?php 
		$args = array(
			'post_type' 		=> 'publisher','posts_per_page' => $number_publisher,
		);
		$loop = new WP_Query( $args);
		wp_reset_postdata();
		?>
		<?php if ($loop->have_posts()) {?>
			<?php while ($loop->have_posts()) { $loop ->the_post();?>
			<div class="item-store col-md-4 col-sm-4 col-xs-12">
				<div class="store-title"><?php the_title();?></div>
				<div class="store-address">
					<?php echo get_post_meta(get_the_ID(), '_beautheme_publisher_address', TRUE);?></br>
					<?php echo get_post_meta(get_the_ID(), '_beautheme_publisher_phone', TRUE);?></br>
					<?php echo get_post_meta(get_the_ID(), '_beautheme_publisher_fax', TRUE);?></br>
					<?php echo get_post_meta(get_the_ID(), '_beautheme_publisher_email', TRUE);?></br>
				</div>
			</div>
			<?php }?>
		<?php }?>
		</div>
	</div>
</section>