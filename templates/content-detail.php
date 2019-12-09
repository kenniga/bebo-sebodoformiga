<?php while ( have_posts() ) : the_post();?>
<?php $post_id = get_the_ID();?>
<?php if (has_post_thumbnail()) {?>
<section class="banner-detail">
	<?php sebodo_debug(get_field('header_image')); ?>
		<?php if(!empty(get_field('header_image'))) {
			echo wp_get_attachment_image(get_field('header_image'), 'full');
		} else {
			echo the_post_thumbnail('bebostore-banner-thumbnail'); 
		}
	?>
</section>
<?php }?>
<section class="section-blog-detail blogs-detail-full wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="0.8s">
	<div class="container">
		<div class="left-cols book-center col-md-8 col-sm-11 col-xs-12">
			<div id="post-detail-<?php the_ID();?>" <?php post_class("page-blogs-grid section-landing-view blogs-detail");?>>
				<div class="news-title"><?php the_title();?></div>
				<div class="news-dateup"><?php esc_html_e('On','bebostore')?> <?php printf('%s', get_the_date());?> | <?php printf('%s', get_post_field( 'comment_count', get_the_ID()));?> <?php esc_html_e('Comments','bebostore');?></div>
				<div class="news-content"><?php the_content();?></div><!--End news-content-->
			</div><!--End blog-list-->

			<div class="clearfix"></div>
			<div class="nav-detail">
				<?php previous_post_link('%link', '<i class="fa fa-long-arrow-left"></i> %title', TRUE); ?>
				<?php next_post_link('%link', '<i class="fa fa-long-arrow-right"></i> %title', TRUE); ?>
			</div><!--End nav-detail-->

			<?php if ( comments_open() ) {?>
				<div class="book-about-author">
					<div class="author-avatar col-md-2 col-sm-2">
						<?php printf('%s',get_avatar( get_the_author_meta('ID'), '103' )); ?>
					</div>
					<div class="about-post-author col-md-9 col-sm-9">
						<span class="author-name"> <a href="<?php esc_url(the_author_meta('url')); ?>"><?php the_author(); ?></a></span>
						<span class="author-desc"><?php the_author_meta('description'); if(!get_the_author_meta('description')) esc_html_e('No description.
	Please update your profile.','bebostore'); ?></span>
		<span class="author-link"> <a href="<?php esc_url(the_author_meta('url')); ?>"><?php the_author_meta('url'); ?></a></span>
					</div>
				</div><!--End book-about-author-->
			<?php comments_template();?>
			<?php }?>
		</div><!--End left-cols-->
	</div>
</section>
<?php endwhile;?>

<section>
	<div class="landing-book-blog">
		<div class="container">
			<div class="title-box title-bold"><span><?php esc_html_e('More news','bebostore')?></span></div><!--title-box-->
			<ul class="landing-list-news list-other-news">
				<?php
					$args = array(
						'post_type' => 'post',
						'posts_per_page' => '2',
						'post_status' => 'publish',
						'post__not_in' => array($post_id),
					);
					$post_others = new WP_Query( $args);
					if ($post_others->have_posts()): ;
					while ( $post_others->have_posts() ) : $post_others->the_post();
				?>
					<li class="news-item">
						<a href="<?php echo esc_url(get_the_permalink());?>" class="news-landing-book"><?php printf('%s',get_the_post_thumbnail(get_the_ID(), 'bebostore-thumbnail'))?></a>
						<div>
							<a href="<?php echo esc_url(get_the_permalink());?>"><?php the_title();?></a>
							<span class="time-up"><?php esc_html_e('On','bebostore');?>&nbsp;<?php printf('%s',get_the_date());?></span>
						</div>
					</li>
				<?php
					endwhile;
				endif;
				?>
			</ul>
		</div>
	</div><!--End landing-auth-blog-->
</section>
