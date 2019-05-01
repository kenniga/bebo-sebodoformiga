<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <!--[if lt IE 9]>
        <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/asset/js/html5.js"></script>
    <![endif]-->
    <!-- Mobile Specific Metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, minimum-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11" />
<?php wp_head();?>
</head>
<body <?php body_class(); ?>>
<?php
if (!is_404()) {
    global $beau_option;
    $header_setting = '';
    $header_page_setting = get_post_meta( get_the_ID(), '_beautheme_custom_header', TRUE );
    if (isset($beau_option['header-type'])) {
        $header_setting =  $beau_option['header-type'];
    }
    if ($header_page_setting) {
        $header_setting = $header_page_setting;
    }
    if (!$header_setting) {
        $header_setting = 'default';
    }
    get_template_part('templates/header', $header_setting);
?>
<div id="book-mobile-menu">
    <div class="mobile-menu">
        <span class="close-btn">
            <i class="fa fa-close"></i>
        </span>
        <?php wp_nav_menu( array( // show menu mobile
            'theme_location' => 'mobile-menu',
            'container' => 'nav',
            'container_class' => 'mobile-menu',
            'menu_id'       => 'mobile-navigation',
     ) ); ?>
    </div>
</div>
<?php }?>