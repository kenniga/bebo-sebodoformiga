<?php
$author_name = $author_style = $author_facebook = $author_twitter = $author_google = $author_instagram = $author_pinterest = $author_behance = $author_youtube = $author_linkedin = $author_image = $author_book = "";
extract(shortcode_atts(array(
    'author_name'		=> '',
    'author_style'		=> '',
    'author_image'		=> '',
    'author_book'		=> '',
    'author_facebook'	=> '',
    'author_twitter'	=> '',
    'author_google'		=> '',
    'author_instagram'	=> '',
    'author_pinterest'	=> '',
    'author_behance'		=> '',
    'author_youtube'	=> '',
    'author_linkedin'	=> '',
    
), $atts));
?>
<div class="container">
	<div class="hot-author">
		<div class="col-md-4 col-sm-4 col-xs-12">
			<div class="title-box title-right title-bold"><span><?php esc_html_e('About author','bebostore');?></span></div>
			<div class="author-info">
				<span class="author-name"><?php printf('%s', $author_name);?></span>
				<span class="author-tags"><?php esc_html_e('Style', 'bebostore');?>: <a><?php printf('%s', $author_style);?></a></span>
				<span class="author-desc"><?php printf($content);?></span>
				<span class="author-social">
					<ul>
						<?php if (!empty($author_facebook)) {?>
						<li><a href="<?php echo esc_url($author_facebook)?>"><i class="fa fa-facebook"></i></a></li>
						<?php }?>
						<?php if (!empty($author_google)) {?>
						<li><a href="<?php echo esc_url($author_google)?>"><i class="fa fa-google"></i></a></li>
						<?php }?>
						<?php if (!empty($author_twitter)) {?>
						<li><a href="<?php echo esc_url($author_twitter)?>"><i class="fa fa-twitter"></i></a></li>
						<?php }?>
						<?php if (!empty($author_instagram)) {?>
						<li><a href="<?php echo esc_url($author_instagram)?>"><i class="fa fa-instagram"></i></a></li>
						<?php }?>
						<?php if (!empty($author_pinterest)) {?>
						<li><a href="<?php echo esc_url($author_pinterest)?>"><i class="fa fa-pinterest"></i></a></li>
						<?php }?>
						<?php if (!empty($author_behance)) {?>
						<li><a href="<?php echo esc_url($author_behance)?>"><i class="fa fa-behance"></i></a></li>
						<?php }?>
						<?php if (!empty($author_youtube)) {?>
						<li><a href="<?php echo esc_url($author_youtube)?>"><i class="fa fa-youtube"></i></a></li>
						<?php }?>
						<?php if (!empty($author_linkedin)) {?>
						<li><a href="<?php echo esc_url($author_linkedin)?>"><i class="fa fa-linkedin"></i></a></li>
						<?php }?>
					</ul>
				</span>
			</div>
		</div>
		<div class="col-md-4 col-sm-4 col-xs-12">
		<?php if(!empty($author_image)){?>
		<?php $mainimg = wp_get_attachment_image_src( $author_image, 'main-thumbnail' );?>
			<img src="<?php printf('%s', $mainimg[0])?>" alt="<?php printf('%s', $author_name);?>">
		<?php }?>
		</div>
		<div class="col-md-4 col-sm-4 col-xs-12">
			<?php
				$book_list = explode(',', $author_book);
				$args = array(
					'post_type' 	=>'product',
					'post__in'		=> $book_list,
				);
				$loop = new WP_Query( $args);
				wp_reset_postdata();
			?>
			<?php if ($loop->have_posts()) {?>
			<ul class="author-book">
				<?php
				while ($loop->have_posts()) {
				$loop ->the_post();
				?>
				<li class="author-item">
					<a href="<?php echo esc_url(get_the_permalink()); ?>">
						<div class="book-item">
							<div class="book-image"><?php echo woocommerce_get_product_thumbnail(get_the_ID());?></div>
							<div class="book-actions">
								<div class="list-action"></div><!--End list-action-->
							</div>
						</div><!--End book-item-->
					</a>
					<div class="book-info">
						<span class="book-name"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title();?></a></span>
					</div><!--End book-info-->
				</li>
				<?php }?>
			</ul>
			<?php }?>
		</div>
	</div><!--End hot-author-->
</div>