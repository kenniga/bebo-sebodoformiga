<?php
/**
 * The template for displaying product widget entries
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( ! is_a( $product, 'WC_Product' ) ) {
	return;
}
?>
<li>
	<div class="book-best-right">
		<a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
			<div class="book-item">
				<div class="book-image">
					<?php print ($product->get_image()); ?>
				</div>
			</div>
			<div class="name-best">
				<p class="b-name"><?php print ($product->get_title()); ?></p>
				<span class="b-author">
					<?php 
                   		$author = get_field('field_book_author'); 
                   ?>
                    <?php if( $author ): ?>
                    	<?php 
                    		if(count($author) == 1){
                    		foreach( $author as $authors ): ?>

                            <?php echo get_the_title( $authors->ID ); ?>
                        <?php endforeach; 
                        	} 
                        else{
                        ?>
                        <?php foreach( $author as $authors ): ?>
                            <?php echo get_the_title( $authors->ID ); ?>,
                        <?php endforeach; ?>
                        <?php } ?>
                    <?php endif; ?>
				</span>
				<p class="b-price"><?php print ($product->get_price_html()); ?></p>
			</div>
		</a>
	</div><!--Emd book-best-right-->
</li>