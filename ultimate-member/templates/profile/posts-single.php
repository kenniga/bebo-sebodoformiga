<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div class="um-item col-12 col-sm-3">
	<?php if ( has_post_thumbnail( $post->ID ) ) {
		$image_id = get_post_thumbnail_id( $post->ID );
		$image_url = wp_get_attachment_image_src( $image_id, 'full', true ); ?>

		<div class="um-item-img">
			<a href="<?php echo esc_url( get_permalink( $post ) ); ?>">
				<?php echo get_the_post_thumbnail( $post->ID, 'medium' ); ?>
			</a>
		</div>

	<?php } else { 
		$video = get_field( 'post_youtube', $post->ID );
		preg_match('/src="(.+?)"/', $video, $matches_url );
		$src = $matches_url[1];	
		
		preg_match('/embed(.*?)?feature/', $src, $matches_id );
		$id = $matches_id[1];
		$id = str_replace( str_split( '?/' ), '', $id );
		?>
		<div class="um-item-img">
			<a href="<?php echo esc_url( get_permalink( $post ) ); ?>">
			<img src="http://img.youtube.com/vi/<?php echo $id; ?>/mqdefault.jpg"/>
			</a>
		</div>
	<?php } ?>
	<div class="um-item-link">
		<a href="<?php echo esc_url( get_permalink( $post ) ); ?>"><?php echo esc_html( $post->post_title ); ?></a>
	</div>

	<div class="um-item-meta">
		<span>
			<div class="short-desc">
				<?php 
					$content_post = get_post($post->ID);
					$content = $content_post->post_content;
					$content = apply_filters('the_content', $content);
					$content = str_replace(']]>', ']]&gt;', $content);
					echo wp_trim_words($content, 15);
				?>
			</div>
		</span>
	</div>
</div>