<?php while ( have_posts() ) : the_post();?>
<?php $post_id = get_the_ID();?>
<section class="section-blog-detail">
	<div class="container">
		<div class="left-cols pull-left col-md-9 col-sm-9 col-xs-12">
			<div id="post-detail-<?php the_ID();?>" <?php post_class("page-blogs-grid blogs-detail");?>>
				<?php if (has_post_thumbnail()) {?>
					<div class="news-feature-image">
						<?php echo the_post_thumbnail('bebostore-thumbnail');?>
					</div>

				<?php }?>
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
		<div class="right-sidebar pull-right col-md-3 col-sm-3 col-xs-12">
		<?php
		 	if ( is_active_sidebar( 'sidebar-widget') ){
				dynamic_sidebar( 'sidebar-widget');
			}
		?>
		</div><!--End right-sidebar-->
	</div>
</section>
<?php endwhile;?>