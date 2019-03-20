<?php 
    global $beau_option;
    $disable_search = $beau_option['disable_search'];
    $enabled_cart = $beau_option['enabled-cart-header'];
?>
<div class="search-cart">
    <?php if ($disable_search != '2'): ?>
        <div class="search-form">
            <form action="<?php echo home_url('/')?>" method="GET">
                <input type="text" name="s" class="txt-search">
                <input type="hidden" name="post_type" value="product" />
                <input type="hidden" name="category_name" value="">
                <i class="fa fa-search"></i>
            </form>
        </div>
    <?php endif ?>
    
    <?php
        if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
            if ($enabled_cart != '1') {
                $cart_url = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : WC()->cart->get_cart_url();
                ?>
                <div class="cart-icon">
                    <a href="<?php echo esc_url($cart_url); ?>">
                    <i class="be be-bag"></i>
                    <p class="icon-cart-ajax"><?php  printf(esc_html__('%s','bebostore' ), WC()->cart->cart_contents_count); ?></p></a>
                </div>
            <?php 
            }
       } 
    ?>
</div><!--End .search-cart-->
<script type="text/javascript">
    (function($){
        "use strict";
        $('.txt-search').focus(function(event) {
            $(this).parent('form').addClass('focus-class');
        })
        $(document).click(function(event) {
            if(!$(event.target).closest('.txt-search').length) {
                $('.search-form form').removeClass('focus-class').find('.txt-search').attr('value','');
            }
        })
    })(jQuery)
</script>