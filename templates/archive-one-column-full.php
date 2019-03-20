<?php if ( have_posts() ) :
require(get_template_directory().'/templates/header-blog.php');
?>
<section class="header-page blog-header-grid" <?php printf('%s', $style_page); ?>>
	<div class="container">
		<span class="title-page"><?php echo esc_attr($title_page); ?></span>
	</div>
</section>
<section>
	<div class="container">
		<div class="page-blogs-list no-border section-landing-view section-blog-detail">
		<?php
			if (!$page_setting) {
				while ( have_posts() ) : the_post();
					require(get_template_directory().'/templates/content-post.php');
			 	endwhile;
			}else{
				$loop = new WP_Query( $args );
				while ( $loop -> have_posts() ) : $loop -> the_post();
					require(get_template_directory().'/templates/content-post.php');
			 	endwhile;
			 	$wp_query = $loop;
			 	wp_reset_postdata();
			}
		?>
		</div><!--End blog-list-->
		<div class="clearfix"></div>
		<?php echo bebostore_pagination($wp_query);?>
	</div><!--End .container-->
</section>
<?php
else :
	get_template_part( 'templates/content', 'none' );
endif;
?>