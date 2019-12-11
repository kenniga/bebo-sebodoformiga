<?php while ( have_posts() ) : the_post();?>
<?php $post_id = get_the_ID();?>
<?php gt_set_post_view(); ?>
<?php
	$is_bottom_post =  get_permalink( get_adjacent_post(true,'',false, 'lokasi_kontes')->ID ) === get_permalink();
	$is_top_post =  get_permalink( get_adjacent_post(true,'',true, 'lokasi_kontes')->ID ) === get_permalink();
	$next_post_link_url = !$is_bottom_post ? get_permalink( get_adjacent_post(true,'',false, 'lokasi_kontes')->ID ) : 'javascript:void(0)'; 
	$prev_post_link_url = !$is_top_post ? get_permalink( get_adjacent_post(true,'',true, 'lokasi_kontes')->ID ) : 'javascript:void(0)';
?>
<section>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<!-- a block container is required -->
				
				<?php 
					if( !empty(get_field('post_youtube')) ) {
						?>
						<div class="video-viewer">
							<?php echo get_field('post_youtube') ?>
							<a href="<?php echo $prev_post_link_url; ?>" class="image-viewer__nav image-viewer__next <?php if($is_top_post) { echo 'disabled'; } ?>"><i class="fa fa-chevron-right"></i></a>
							<a href="<?php echo $next_post_link_url; ?>" class="image-viewer__nav image-viewer__prev <?php if($is_bottom_post) { echo 'disabled'; } ?>"><i class="fa fa-chevron-left"></i></a>
						</div>
					<?php } else if (has_post_thumbnail()) {?>

				<div class="image-viewer">
					<ul id="images">
					<?php 
						$args = array(
							'author' => get_the_author_meta('ID'),
							'post_type' => 'galeri_kontes',
						);
						$author_posts = get_posts( $args );
						foreach ($author_posts as $key => $value) {
							?>
							<li><?php echo get_the_post_thumbnail() ?></li>
							<?php } ?>
					</ul>
				
					<a href="<?php echo $prev_post_link_url; ?>" class="image-viewer__nav image-viewer__next <?php if($is_top_post) { echo 'disabled'; } ?>"><i class="fa fa-chevron-right"></i></a>
					<a href="<?php echo $next_post_link_url; ?>" class="image-viewer__nav image-viewer__prev <?php if($is_bottom_post) { echo 'disabled'; } ?>"><i class="fa fa-chevron-left"></i></a>
				</div>
				<div class="image-viewer__fullscreen-container">
					<a href="#" class="image-viewer__fullscreen-action">
						<i class="fa fa-arrows-alt"></i>
					</a>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>

<section class="kontes-detail-full wow fadeInUp" data-wow-delay="0.4s" data-wow-duration="0.8s">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-sm-11 col-12 order-1 order-sm-0">
				<div class="single-galeri_kontes__comments">
					<div class="title-box title-comment-box"><span><?php esc_html_e("Comments" ,'bebostore'); ?></span></div>
					<?php comments_template();?>
				</div>
			</div><!--End left-cols-->
			<div class="right-cols col-md-4 order-0 order-sm-1">
				<div id="post-detail-<?php the_ID();?>" <?php post_class("page-blogs-grid single-galeri_kontes__author blogs-detail");?>>
				<?php 
					$get_author_gravatar = get_avatar_url(get_the_author_meta('ID'), array('size' => 80));
					$get_author_gravatar_modal = get_avatar_url(get_the_author_meta('ID'), array('size' => 370));
				?>
					<div class="single-galeri_kontes__author-detail">
						<img src="<?php echo $get_author_gravatar; ?>" class="single-galeri-kontes--author-photo" data-img-modal="<?php echo $get_author_gravatar_modal; ?>" />
						<div class="author-info">
							<div class="author-name">
								<?php the_author(); ?>
							</div>
							<div class="author-school">
								<?php echo get_the_author_meta('sekolah_asal'); ?>
							</div>
						</div>
					</div>
					<div class="single-galeri_kontes__photo-information">
						<div class="news-title">
							<div class="news-title__label">
								Judul Karya
							</div>
							<div class="news-title__content">
								<?php the_title();?>
							</div>
						</div>
						<div class="news-content">
							<div class="news-content__label">
								Deskripsi Karya
							</div>
							<div class="news-content__content">
									<?php the_content();?>
							</div>
						</div><!--End news-content-->
						<div class="news-status">
							<div class="news-status__views">
								<i class="fa fa-eye"></i> 
								<span>
									<?= gt_get_post_view(); ?>
								</span>
							</div>
							<div class="news-status__comments">
								<i class="fa fa-comment"></i> 
								<span>
									<?php printf('%s', get_post_field( 'comment_count', get_the_ID()));?> Comments
								</span>
							</div>
						</div>
					</div>
				</div><!--End blog-list-->


				<div class="clearfix"></div>
				<div class="nav-detail">
					<?php previous_post_link('%link', '<i class="fa fa-long-arrow-left"></i> %title', TRUE); ?>
					<?php next_post_link('%link', '<i class="fa fa-long-arrow-right"></i> %title', TRUE); ?>
				</div><!--End nav-detail-->
				
			</div>
		</div>
	</div>
</section>
<?php endwhile;?>

<script>
(function($) {
	$(document).ready(function(){
		var $image = $('#image');

		$('.single-galeri-kontes--author-photo').on('click', function(){
			$('#modal-pp img.pp-image-inside-modal').attr('src', $(this).data('img-modal'));
			$('#modal-pp').modal('show');
		});

	
		// Get the Viewer.js instance after initialized
		var viewer = $image.data('viewer');
	
		// View a list of images
		$('#images').viewer({
			inline: true,
			movable: false,
			toolbar: false,
			navbar: false,
			title: false
		});

		// $('.image-viewer__next').on('click', function(e){
		// 	e.preventDefault();
		// 	$('#images').viewer('next');
		// });

		// $('.image-viewer__prev').on('click', function(e){
		// 	e.preventDefault();
		// 	$('#images').viewer('prev');
		// });

		$('.image-viewer__fullscreen-action').on('click', function(e){
			e.preventDefault();
			$('#images').viewer('full');
		});
	})
})(jQuery);
</script>