<?php
$perpage = $category = $title_box = $title_center = $blog_thumbnail_style = "";
extract(shortcode_atts(array(
    'title_box' => '',
    'title_center' => '',
    'perpage' 	=> '3',
    'category' => '',
    'blog_thumbnail_style' => '',
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

sebodo_debug($loop); 

?>
<div class="book-blogs-section jabarmasagi-blog-card-slider <?php echo esc_attr($blog_thumbnail_style) ?>">
	<?php if ($loop->have_posts()) {?>
		<div class="container">
			<div class="blog-card-slider-container">
				<!-- Additional required wrapper -->
				<ul class="row list-blog-slider">
					<?php while ($loop->have_posts()) {$loop ->the_post();?>
					<li class="col-md-4 col-sm-4 col-12">
						<?php 
							$post_format = get_post_format( get_the_ID() );
							if ($post_format == 'video') {
								$youtube_url = get_post_meta( get_the_ID(),'_beautheme_video_thumbnail', TRUE);
	
								parse_str( parse_url( $youtube_url, PHP_URL_QUERY ), $my_array_of_vars );
								$youtube_id = $my_array_of_vars['v'];
							?> 
	
							<div class="card-item post-video">
								<?php
									$imgFeature = get_the_post_thumbnail( get_the_ID(), 'large');
									if ($imgFeature == "") {
										$imgFeature = '<img src="http://placehold.it/245x140" alt="No feature image">';
									}
								?>
								<a href="#" class="launch-video-modal" data-toggle="modal" data-target="#video-modal" data-video-id="<?php echo esc_attr($youtube_id) ?>">
									<?php printf('%s', $imgFeature);?>
									<span class="icon-play">
										<i class="fa fa-play"></i>
									</span>
								</a>
							</div>
	
							<?php } else { ?>
	
							<div class="card-item">
								<?php
									$imgFeature = get_the_post_thumbnail( get_the_ID(), 'bebostore-thumbnail');
									if ($imgFeature == "") {
										$imgFeature = '<img src="http://placehold.it/245x140" alt="No feature image">';
									}

									$trimmed = get_the_excerpt();
									$trimmed = wp_trim_words( $trimmed, 17, '...' )
								?>
								<a href="<?php echo esc_url(the_permalink());?>" class="book-blog-thumb"><?php printf('%s', $imgFeature);?></a>
								<h4 class="title-blog">
									<a href="<?php echo esc_url(the_permalink());?>"><?php the_title();?></a>
								</h4>
								<p class="blog-excerpt">
									<?php esc_html_e($trimmed);?>
								</p>
								<a href="<?php echo esc_url(the_permalink());?>" class="jabarmasagi-btn btn btn-rounded">Read More</a>
							</div>
						<?php } ?>
					</li>
					<?php } ?>
				</ul>
	
			</div>
		</div>
	<?php }?>
</div><!--End landing-auth-blog-->