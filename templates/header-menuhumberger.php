<?php
	global $beau_option;
	$wishlist_setting = $beau_option['enabled-wishlist'];
	$disable_search = $beau_option['disable_search'];
	$enabled_cart = $beau_option['enabled-cart-header'];
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$cart_url = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : WC()->cart->get_cart_url();
?>
<div class="menu-fix-all<?php echo (isset($beau_option['header-fixed']) && $beau_option['header-fixed']==2 ? ' enable-sticky' : ''); ?>">
    <div class="container">
    	<span class="humberger-button">
            <button>
                <i></i>
                <i></i>
                <i></i>
            </button>
        </span>
        <div class="beau-logo">
            <?php
                $store_logo = $beau_option['logo']['url'];
                if ($store_logo == "") {
                    $store_logo = get_template_directory_uri().'/asset/images/logo.png';
                }
            ?>
            <a href="<?php echo esc_url(home_url( '/' ));?>"><img src="<?php echo esc_url($store_logo);?>" alt="Logo"></a>
        </div><!--End .logo-->
        <div class="menu">
            <?php
                wp_nav_menu(array(
                    'theme_location'   => 'sticker-menu',
                    'menu_class'       => 'col-md-12 col-sm-12 hidden-xs',
                    'menu_id'          => 'main-navigation',
                    'container'        => '',
                    'theme_location'   => 'main-menu',
                ));
            ?>
        </div>
        <?php get_template_part('templates/stick','search') ?>
    </div>
</div>
<header class="header-two">
	<div class="header-top">
		<div class="container-fluid">
			<?php if (has_nav_menu('small-menu')): ?>
				<div class="menu-top">
					<?php
	                    wp_nav_menu(array(
	                        'theme_location'          => 'small-menu',
	                        'menu_class'    => 'col-md-12 col-sm-12 hidden-xs',
	                        'menu_id'       => 'main-navigation',
	                        'container'     => '',
	                    ));
	                ?>
				</div><!--End menu-top-->
			<?php endif ?>
			<div class="social-contact pull-right">
				<?php get_template_part('templates/social','list');?>
				<?php if ($beau_option['hotline']): ?>
				<span class="header-phone"> <i class="fa fa-phone"></i>  <?php echo esc_attr($beau_option['hotline']); ?></span>
				<?php endif ?>
			</div><!--End social-contact-->
		</div>
	</div>
	<div class="header-bottom">
		<div class="container-fluid">
			<div class="full-height col-md-3 col-sm-4 col-xs-12">
				<div class="humberger-menu-logo no-left">
					<span class="humberger-button">
						<button>
							<i></i>
							<i></i>
							<i></i>
						</button>
					</span>
					<div class="book-logo">
						<?php
		                    $store_logo = $beau_option['logo']['url'];
		                    if ($store_logo == "") {
		                        $store_logo = get_template_directory_uri().'/asset/images/logo.png';
		                    }
		                ?>
		                <a href="<?php echo esc_url(home_url( '/' ));?>"><img src="<?php echo esc_url($store_logo);?>" alt="Logo"></a>
					</div>
				</div><!--End humberger-menu-->
			</div>
			<div class="full-height col-md-6 col-sm-8 col-xs-12">
				<?php if ($disable_search != '2'): ?>
					<div class="search-navigation-full">
						<div class="search">
							<form action="<?php echo esc_url(home_url( '/' ));?>" method="GET">
								<span class="felement">
									<input type="text" name="s" id="txt-search" placeholder="<?php esc_html_e('Search by title book','bebostore'); ?>">
	                                <input type="hidden" name="post_type" value="product" />
									<select name="category_name" class="custom-dropdown search-fillter">
										<option value="0" selected><?php esc_html_e('All products','bebostore'); ?></option>
										<?php
				                            $args = array(
				                                'orderby'   => 'title',
				                                'order'     => 'ASC',
				                                'hide_empty'          => FALSE,
				                            );
				                            $product_categories = get_terms( 'product_cat', $args );
				                            $count = count($product_categories);
				                            if ( $count > 0 ){
				                                foreach ( $product_categories as $product_category ) {
				                                    echo '<option value="' . $product_category->slug . '">' . $product_category->name . '</option>';
				                                }
				                            }
				                        ?>
									</select>
								</span>
								<button type="submit"><?php esc_html_e('Search','bebostore');?></button>
							</form>
						</div><!--End search-->
						<script>
							(function($){
								"use strict";
								jQuery('#txt-search').focus(function() {
									jQuery('.felement').addClass('solid-border');
								});
								jQuery(document).click(function(event) {
								    if(!jQuery(event.target).closest('.felement').length) {
								        if(jQuery('.felement').hasClass('solid-border')) {
								            jQuery('.felement').removeClass('solid-border');
								        }
								    }
								})
							})(jQuery)

						</script>
					</div><!--End search-navigation-->
				<?php endif ?>

			</div>
			<div class="full-height col-md-3 col-sm-12 hidden-xs">
				<div class="nav-right">
					<ul class="list-right-nav">
						<?php
						if( !is_user_logged_in()) {
						?>
							<li><a href="<?php echo esc_url(get_permalink( get_option('woocommerce_myaccount_page_id') )); ?>"><?php esc_html_e('Sign in','bebostore'); ?><br> <?php esc_html_e('Your account','bebostore'); ?></a></li>
						<?php }
						else{
						?>
							<li><a href="<?php echo esc_url(wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) )); ?>"><?php esc_html_e('Log out','bebostore'); ?><br> <?php esc_html_e('Your account','bebostore'); ?></a></li>
						<?php
						}
						?>
						<?php
							$wishlist_url = '';
							if( function_exists( 'YITH_WCWL' ) && get_option( 'yith_wcwl_wishlist_page_id' ) ){
							    $wishlist_url = YITH_WCWL()->get_wishlist_url();
							}


						 if ($wishlist_setting == '2' && $wishlist_url != '') {
						 ?>
						<li>
							<a href="<?php echo esc_url($wishlist_url); ?>"><?php esc_html_e('Wishlist', 'bebostore'); ?></a>
						</li>
						<?php
							}
						?>
					</ul>

                    <?php
                    	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
                    	if ($enabled_cart != '1') {
                    ?>
                    <div class="woocomerce-cart">
	                    <a href="<?php echo esc_url($cart_url); ?>"><i class="be be-bag"></i></a>
	                    <a href="<?php echo esc_url($cart_url); ?>" class="icon-cart-ajax"><?php  printf(esc_html__('%s','bebostore' ), WC()->cart->cart_contents_count); ?></a>
                    </div>
                    <?php
	                	}
	                   }
                    ?>

				</div><!--End nav-right-->
			</div>
		</div>
	</div>

</header>
<div id="menu-humberger" class="">
<?php
    wp_nav_menu(array(
        'theme_location'          => 'main-menu',
        'menu_class'    => 'col-md-12 col-sm-12 hidden-xs',
        'menu_id'       => 'main-navigation',
        'container'     => '',
    ));
?>
</div>
