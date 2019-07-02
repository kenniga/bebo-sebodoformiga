<?php
    global $beau_option;
	$wishlist_setting = $beau_option['enabled-wishlist'];
    $disable_search = $beau_option['disable_search'];
    $enabled_cart = $beau_option['enabled-cart-header'];
    $enabled_header_top = $beau_option['is-header-top'];
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
?>
<?php if( $enabled_header_top == 0 ): ?>
<div class="header-top">
	<div class="container">
		<div class="top-menu d-flex justify-content-end align-items-center">
			<div class="language-selector">
				<?php if (has_nav_menu('small-menu')): ?>
					<?php
						wp_nav_menu(array(
							'theme_location'=> 'small-menu',
							'menu_class'    => 'col-md-12 col-sm-12 hidden-xs',
							'menu_id'       => 'small-navigation',
							'container'     => '',
						));
					?>
				<?php endif ?>
			</div>
			<div class="account-settings">
			<?php
				if( !is_user_logged_in()) {
				?>
					<a href="<?php echo esc_url(get_permalink( get_option('woocommerce_myaccount_page_id') )); ?>"><?php esc_html_e('Sign in','bebostore'); ?></a>
				<?php }
				else{
				?>
					<a href="<?php echo esc_url(wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) )); ?>"><?php esc_html_e('Log out','bebostore'); ?></a>
				<?php
				}
				?>
			</div>
		</div>
	</div>
</div><!--End header-top-->
<?php endif ?>
<header class="menu-stick sticky-top header-one <?php if ( $enabled_header_top ) { echo 'no-header-top'; } ?> py-3">
    <div class="container">
        <div class="d-flex flex-wrap">
            
            <div class="header-bottom flex-fill d-flex align-items-center justify-content-between">
                <div class="beau-logo">
                    <?php
                        if (isset($beau_option['logo'])) {
                            $store_logo = $beau_option['logo']['url'];
                        }else{
                            $store_logo = get_template_directory_uri().'/asset/images/logo.png';
                        }
                    ?>
                    <a href="<?php echo esc_url(home_url( '/' ));?>">
						<img src="<?php echo esc_url($store_logo);?>" alt="Logo">
					</a>
                </div><!--End .logo-->
                <div id="main-nav" class="d-md-flex h-100">
                    <?php
                        wp_nav_menu(array(
                            'theme_location' => 'main-menu',
                            'menu_class'    => 'col-md-12 col-sm-12 hidden-xs d-md-flex',
                            'menu_id'       => 'main-navigation',
                            'container'     => '',
                        ));
                    ?>
    
    
                </div>
                <div class="right-menu">
					<?php
							$wishlist_url = '';
							if( function_exists( 'YITH_WCWL' ) && get_option( 'yith_wcwl_wishlist_page_id' ) ){
								$wishlist_url = YITH_WCWL()->get_wishlist_url();
							}

						 if ($wishlist_setting == '2' && $wishlist_url != '') {
							$wishlist_count = YITH_WCWL()->count_products(); ?>
						<div class="wishlist-icon">
							<a class="wishlist-link" href="<?php echo esc_url($wishlist_url); ?>">
								<i class="icon-icon-heart"></i>
								<span class="wishlist-counter"><?php echo $wishlist_count; ?></span>
							</a>
						</div>
						<?php
							}
						?>
                    <?php
                        if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
                            if ($enabled_cart != '1') {
                                $cart_url = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : WC()->cart->get_cart_url();
                            ?>
                    <div class="woocomerce-cart">
                        <a href="<?php echo esc_url($cart_url); ?>"><i class="icon-icon-cart"></i></a>
                        <span class="icon-cart-ajax"><?php  printf(esc_html__('%s','bebostore' ), WC()->cart->cart_contents_count); ?></span>
                    </div>
                    <?php
                            }
                        }
                    ?>
                    <?php if ($disable_search != '2'): ?>
                    <div class="form-search">
                        <a class="open-search-modal" data-toggle="modal" data-target="#search-modal" data-backdrop="static" data-keyboard="false">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </a>
                    </div><!--Left .pull-left-->
                    <?php endif ?>
                </div>
            </div>
            <?php 
                $hamburger_logo = get_template_directory_uri().'/asset/images/icon-hamburger-menu.png';
            ?>
            <span class="humberger-button d-flex d-sm-none align-items-center justify-content-between">
                <button>
                    <img src="<?php echo esc_url($hamburger_logo);?>" alt="">
                </button>
            </span>

        </div>
        
    </div><!--End container-->
</header>
