<?php
$perpage = $category = $title_box = $title_center = "";
extract(shortcode_atts(array(
    'title_box' => '',
    'title_center' => '',
    'perpage' 	=> '3',
    'category' => '',
), $atts));
if ($category == 'All') {
  	$args = array(
      'post_type' => 'post',
      'posts_per_page' => $perpage,
      'order' => 'DESC' ,
	);
}
else{
	$args = array(
      'post_type' => 'post',
      'posts_per_page' => $perpage,
      'order' => 'DESC' ,
      'category_name' => $category,
	);
}
$loop = new WP_Query( $args );

wp_reset_postdata();
if ($title_center == "title_center") {
	$class_extra = "book-center";
}else{
	$class_extra = "";
}
?>
<div class="book-blogs-section">
	<div class="container">
		<div class="title-box title-blog <?php echo esc_attr($class_extra)?>"><span><?php echo esc_html($title_box); ?></span></div><!--title-box-->
		<?php if ($loop->have_posts()) {?>
		<ul class="list-blog">
			<?php while ($loop->have_posts()) {$loop ->the_post();?>
			<li class="blog-item  col-md-3 col-sm-3 col-xs-12">
				<?php
					$imgFeature = get_the_post_thumbnail( get_the_ID(), 'bebostore-thumbnail');
					if ($imgFeature == "") {
						$imgFeature = '<img src="http://placehold.it/245x140" alt="No feature image">';
					}
				?>
				<a href="<?php echo esc_url(the_permalink());?>" class="book-blog-thumb"><?php printf('%s', $imgFeature);?></a>
				<span class="title-blog"><a href="<?php echo esc_url(the_permalink());?>"><?php the_title();?></a></span>
				<span class="blog-timeup"><?php esc_html_e('On','bebostore')?> <?php echo get_the_date();?></span>
			</li>
			<?php }?>
		</ul>
		<?php }?>
	</div>
</div><!--End landing-auth-blog-->