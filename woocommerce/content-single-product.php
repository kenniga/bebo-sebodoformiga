<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
	 global $product;
?>
<?php
	global $beau_option;
    if (isset($beau_option['style-shop-details'])) {
        $options = $beau_option['style-shop-details'];
    }else{
        $options = 'shop-style-1';
    }
    $product_type = get_post_meta(get_the_ID(), '_beautheme_your_custom_product', TRUE);
    if($options == 'shop-style-1') {
?>
<?php
	require(get_template_directory().'/woocommerce/content-single-style-01.php');
?>
<?php }
	if($options == 'shop-style-2') {
?>
<?php
	require(get_template_directory().'/woocommerce/content-single-style-02.php');
?>
<?php }
	if($options == 'shop-style-3') {
?>
<?php
	require(get_template_directory().'/woocommerce/content-single-style-03.php');
?>

<?php } ?>
<?php if ($mp3Files) { ?>

        <div id="singlebook_player" class="jp-jplayer"></div>
        <div id="jp_container_2" class="jp-audio" role="application" aria-label="media player">
            <div class="close-detail-author"></div>
            <div class="container">
                <div class="jp-type-playlist">
                    <div class="jp-gui jp-interface">
                        <div class="jp-controls">
                            <button class="jp-previous" role="button" tabindex="0"></button>
                            <button class="jp-play" role="button" tabindex="1"></button>
                            <button class="jp-next" role="button" tabindex="2"></button>
                        </div>
                        <div class="jp-current-song">
                            <p id="jp-song-name"><?php print($songName); ?></p>
                        </div>
                        <div class="jp-progress">
                            <div class="jp-seek-bar">
                                <div class="jp-play-bar"></div>
                            </div>
                        </div>
                        <div class="jp-volume-controls">
                            <button class="jp-mute" role="button" tabindex="0"></button>
                            <button class="jp-volume-max" role="button" tabindex="0"></button>
                            <div class="jp-volume-bar">
                                <div class="jp-volume-bar-value"></div>
                            </div>
                        </div>
                        <div class="jp-time-holder">
                            <div class="jp-current-time" role="timer" aria-label="time">&nbsp;/</div>
                            <div class="jp-duration" role="timer" aria-label="duration"></div>
                        </div>
                        <div class="jp-book-thumbs">
                            <img src="<?php print ($image_link); ?>">
                            <span>
                                <p><?php echo the_title(); ?></p>
                                <p><?php esc_html_e('by','bebostore'); ?>:   <?php foreach( $author as $authors ): ?><?php echo get_the_title( $authors->ID ); ?><?php endforeach; ?></p>
                            </span>

                        </div><!--End .book-thumbs-->
                    </div>
                    <div class="clearfix"></div>
                    <div class="jp-playlist">
                        <div class="contain-playlist">
                            <ul>
                                <li>&nbsp;</li>
                            </ul>
                        </div>
                    </div>
                    <div class="jp-no-solution">
                        <span><?php esc_html_e('Update Required','bebostore')?></span>
                        <?php esc_html_e('To play the media you will need to either update your browser to a recent version or update your','bebostore')?> <a href="http://get.adobe.com/flashplayer/" target="_blank"><?php esc_html_e('Flash plugin','bebostore')?></a>.
                    </div>
                </div>
            </div><!--End .container-->
        </div>
    <?php } ?>

    <?php if ($video_EMbed): ?>
    <div class="modal fade" id="preview-modal" role="dialog">
        <div class="modal-dialog modal-play">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div><!--End modal-header-->
            <div class="modal-body">
                <?php printf('%s',do_shortcode($video_EMbed_play)); ?>
            </div><!--End .modal-body-->
            <div class="modal-footer"></div><!--End .modal-footer-->
          </div><!--End modal-dialog-->
        </div>
      </div>
      <script>
        (function($) {
          "use strict";
          $('#preview-modal').on('hidden.bs.modal', function () {
                $("#preview-modal iframe").attr("src", $("#preview-modal iframe").attr("src"));
                $('.mejs-playpause-button').click();
          })
        })(jQuery);
        </script>
    <?php endif ?>
<?php do_action( 'woocommerce_after_single_product' ); ?>
