<?php if ( have_posts() ) :
require(get_template_directory().'/templates/header-blog.php');
?>
<section class="header-page blog-header-grid" <?php printf('%s', $style_page)?>>
	<div class="container">
		<span class="title-page"><?php echo esc_attr( $title_page ); ?></span>
	</div>
</section>
<section>
	<div class="container">
		<div class="left-cols right-bar pull-right col-md-9 col-sm-9 col-xs-12">
			<div class="page-blogs-grid grid-2columns">
		 	<?php
			 	$i=2;
				if (!$page_setting) {
					while ( have_posts() ) : the_post();
						if ($i%2 == 0 && $i > 2) {
							echo '<div class="clearfix"></div>';
						}
						require(get_template_directory().'/templates/content-post.php');
						$i++;
				 	endwhile;
				}else{
					$loop = new WP_Query( $args );
					while ( $loop -> have_posts() ) : $loop -> the_post();
						if ($i%2 == 0 && $i > 2) {
							echo '<div class="clearfix"></div>';
						}
						require(get_template_directory().'/templates/content-post.php');
						$i++;
				 	endwhile;
				 	$wp_query = $loop;
				 	wp_reset_postdata();
				}
			?>
			</div><!--End blog-list-->
			<div class="clearfix"></div>
			<?php echo bebostore_pagination($wp_query);?>
		</div><!--End left-cols-->
		<div class="right-sidebar left-bar pull-left col-md-3 col-sm-3 col-xs-12">
		<?php  get_sidebar('nice-bar');?>
		</div><!--End sidebar-->
	</div><!--End .container-->
</section>
<?php
else :
	get_template_part( 'templates/content', 'none' );
endif;
?>