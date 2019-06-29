<?php 
	$image_links  	= wp_get_attachment_image_url(get_post_thumbnail_id(),'woocommerce_thumbnail');
	$style_product = $margin_top = '';
	$wishlist_setting = $beau_option['enabled-wishlist'];
	$show_price_setting = $beau_option['enabled-show-price'];
	$cart_setting = $beau_option['enabled-add-to-cart'];
	$none_book = get_post_meta( get_the_ID(),'_beautheme_product_none_book', TRUE);
	if($none_book == 'on'){
    	$style_product = 'none-book';
    }
?>
<li <?php post_class('col-6 col-sm-3 mb-5'); ?>>
	<div class="book-item-shop">
		<div class="book-item <?php print($style_product) ?>" <?php print($margin_top) ?>>


			<div class="book-image">
				<div class="book-image">
					<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
				</div>
			</div>

			<div class="book-actions">
				<div class="list-action">
					<?php 
						if ($cart_setting != '1') {
							do_action( 'woocommerce_after_shop_loop_item' ); 
						}
					?>
					<?php 
                    	if ($wishlist_setting != '1') {
                        	echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); 
                        }
                    ?>

				</div><!--End list-action-->
			</div>
		</div>
		<div class="book-info">
			<?php echo woocommerce_template_loop_rating(); ?>
			<span class="book-name"><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></span>
			<span class="book-author">
				<?php _e('By:', 'bebostore'); ?>
                   <?php
                   		$author = get_field('field_book_author');
                   ?>
                    <?php if( $author ): ?>
                    	<?php
                    		if(count($author) == 1){
                    		foreach( $author as $authors ): ?>
                            <a href="<?php echo get_permalink( $authors->ID ); ?>" target="blank"><?php echo get_the_title( $authors->ID ); ?></a>
                        <?php endforeach;
                        	}
                        else{
                        ?>
                        <?php foreach( $author as $authors ): ?>
                            <a href="<?php echo get_permalink( $authors->ID ); ?>" target="blank"><?php echo get_the_title( $authors->ID ); ?></a>,
                        <?php endforeach; ?>
                        <?php } ?>
                    <?php endif; ?>
			</span>
			<?php
				if ($show_price_setting != '1') {
			?>
				<span class="book-price"><?php echo woocommerce_template_loop_price(); ?></span>
			<?php
				 } 
			?>
			
			<span class="book-desc">
				<?php echo the_content(); ?>
			</span>
		</div>
	</div>
</li>