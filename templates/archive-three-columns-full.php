<?php if ( have_posts() ) :
require(get_template_directory().'/templates/header-blog.php');
?>
<section>
	<div class="container">
		<div class="page-blogs-grid grid-fullcolumns">
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
	</div>
</section>
<?php
else :
	get_template_part( 'templates/content', 'none' );
endif;
?>