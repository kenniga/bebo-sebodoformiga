<?php if ( have_posts() ) :
require(get_template_directory().'/templates/header-blog.php');
?>
<section>
	<div class="container">
		<div class="left-cols left-bar pull-left col-md-9 col-sm-9 col-xs-12">
			<div class="page-blogs-grid blogs-classic-colums">
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

			<?php echo bebostore_pagination($wp_query);?>
		</div><!--End left-cols-->
		<div class="right-sidebar right-bar pull-right col-md-3 col-sm-3 col-xs-12">
		<?php  get_sidebar();?>
		</div><!--End sidebar-->
	</div><!--End .container-->
</section>
<?php
else :
	get_template_part( 'templates/content', 'none' );
endif;
?>