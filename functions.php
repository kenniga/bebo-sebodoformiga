<?php
$themeInfo            =  wp_get_theme();
$themeName            = trim($themeInfo['Title']);
$themeAuthor          = trim($themeInfo['Author']);
$themeAuthor_URI      = trim($themeInfo['Author URI']);
$themeVersion         = trim($themeInfo['Version']);
$textDomain           = 'bebostore';

define('BEAU_BASE_URL', get_template_directory_uri());
define('BEAU_BASE', get_template_directory());
define('BEAU_THEME_NAME', $themeName);
define('BEAU_TEXT_DOMAIN', $textDomain);
define('BEAU_THEME_AUTHOR', $themeAuthor);
define('BEAU_THEME_AUTHOR_URI', $themeAuthor_URI);
define('BEAU_THEME_VERSION', $themeVersion);
define('BEAU_IMAGES', BEAU_BASE_URL . '/asset/images');
define('BEAU_JS', BEAU_BASE_URL . '/asset/js');
define('BEAU_CSS', BEAU_BASE_URL . '/asset/css');
define('PLUGINS_PATH', 'http://plugins.beautheme.com');
define('PLUGINS_PATH_REQUIRE', BEAU_BASE.'/includes/');
define('PLUGINS_PATH_LIBS', BEAU_BASE.'/libs/');
define('BEAU_THEME_DOMAIN','bebostore');


//For multiple language
$language_folder = BEAU_BASE .'/languages';
load_theme_textdomain( $textDomain, $language_folder );

if (!class_exists('bebostore_ThemeFunction')) {
    class bebostore_ThemeFunction {

        public function __construct(){
            //Get all file php in include folder
            $this -> bebostore_Get_files();
        }
        //Include php
        public function bebostore_Get_files(){
            $files = scandir(get_template_directory().'/includes/');
            foreach ($files as $key => $file) {
                if (preg_match("/\.(php)$/", $file)) {
                    require_once(get_template_directory().'/includes/'.$file);
                }
            }
        }
    }
    new bebostore_ThemeFunction;
}

if ( ! isset( $content_width ) ) $content_width = 900;
///Beautheme support


// Add theme support for this theme
function bebostore_theme_support() {

    add_theme_support( "excerpt", array( "post" ) );
    add_theme_support( "automatic-feed-links" );
    add_theme_support( "post-thumbnails" );
    add_theme_support( "automatic-feed-links" );
    add_theme_support( 'title-tag' );
    add_theme_support( "custom-header", array());
    add_theme_support( "custom-background", array()) ;
    add_theme_support( 'post-formats',
        array(
            'video',
            'audio',
            'gallery',
        )
    );
    add_editor_style();

    // For thumbnai and size image

    add_image_size('bebostore-main-thumbnail','345','520', true);
    add_image_size('bebostore-blog-thumbnail', '525', '340', TRUE );
    add_image_size('bebostore-banner-thumbnail', '1368', '400', TRUE );
    add_image_size('bebostore-thumbnail', '800', '400', TRUE );
    add_image_size('bebostore-book-thumb', '325', '500');
    
    add_theme_support( 'wc-product-gallery-lightbox' );


    // Theme support with nav menu
    add_theme_support( "nav-menus" );
    $nav_menus['main-menu'] = esc_html__( 'Main menu', 'bebostore');
    register_nav_menus( $nav_menus );
}
add_action( 'after_setup_theme', 'bebostore_theme_support' );


function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return 'jm-btn-download-' . $randomString;
}
add_action( 'save_post_authorbook', 'set_prefix_name_author', 10,3 ); 
function set_prefix_name_author( $post_id, $post, $update ) {     
    $title = array_values(array_diff(explode(" ", $post->post_title), array('')));
    $prefix_name = substr($title[0], 0, 1);
    $prefix_last_name = substr($title[count($title) - 1], 0, 1);
    update_post_meta($post_id,'_beautheme_prefix_name',$prefix_name);
    update_post_meta($post_id,'_beautheme_prefix_last_name',$prefix_last_name);
}

function bebostore_scripts(){
    // Lib jquery
    if (!is_admin()) {
        global $beau_option;
        $api_key = bebostore_option('google_map_api');
        if (!is_404()) {
            wp_enqueue_script('jquery-idangerous', BEAU_JS .'/swiper.min.js', array('jquery'), '4.4.1', FALSE);
            wp_enqueue_script('jquery-isotope', BEAU_JS .'/isotope.pkgd.min.js', array('jquery'), '1.2.7', TRUE);
            wp_enqueue_script('jquery-layout-mode', BEAU_JS .'/layout-mode.js', array('jquery'), '1.2.7', TRUE);
            wp_enqueue_script('jquery-layout-modes-masonry', BEAU_JS .'/layout-modes/masonry.js', array('jquery'), '1.4.2', TRUE);
            wp_enqueue_script('jquery-layout-modes-fit-rows', BEAU_JS .'/layout-modes/fit-rows.js', array('jquery'), '1.4.2', TRUE);
            wp_enqueue_script('jquery-layout-modes-vertical', BEAU_JS .'/layout-modes/vertical.js', array('jquery'), '1.4.2', TRUE);
            wp_enqueue_script('jquery-wow', BEAU_JS .'/wow.min.js', array('jquery'), '1.0.3', TRUE);
            wp_enqueue_script('jquery-selectbox', BEAU_JS .'/jquery.selectbox.js', array('jquery'), '1.0.0', TRUE);

            //Js flipbook
            wp_enqueue_script('jquery-flipbook', BEAU_JS .'/books.js', array('jquery'), '1.0.0', TRUE);
            wp_enqueue_script('jquery-flipbook-main', BEAU_JS .'/modernizr.custom.js', array('jquery'), '1.0.1', TRUE);
            //get background image color
            wp_enqueue_script('jquery-get-color', BEAU_JS .'/jquery.adaptive-backgrounds.js', array('jquery'), '1.0.1', FALSE);
            wp_enqueue_script('bootstrap',  BEAU_JS .'/bootstrap.min.js', array('jquery'), '3.3.1', FALSE);

            //check menu fix
            if (isset($beau_option['header-fixed']) && $beau_option['header-fixed']==2) {
                wp_enqueue_script('jquery-menufix',  BEAU_JS .'/sticker-menu.js', array('jquery'), '1.0.0', TRUE);
            }

            //js scroll
            wp_enqueue_script('jquery-TweenMax', BEAU_JS .'/TweenMax.min.js', array('jquery'), '1.0.0', TRUE);
            wp_enqueue_script('jquery-ScrollToPlugin', BEAU_JS .'/ScrollToPlugin.min.js', array('jquery'), '1.0.0', TRUE);

            // Js for playlist
            if (is_single()) {
                wp_enqueue_script('jquery-player', BEAU_JS .'/jquery.jplayer.js', array('jquery'), '2.9.2', FALSE);
                wp_enqueue_script('jquery-playlist', BEAU_JS .'/jplayer.playlist.min.js', array('jquery'), '2.9.2', FALSE);

            }
            
            wp_enqueue_script('google-map-js', 'https://maps.googleapis.com/maps/api/js?libraries=places&key='.$api_key, array(), '3.0', false);

            wp_enqueue_script('jquery-sticky-sidebar', BEAU_JS .'/theia-sticky-sidebar.js', array('jquery'), '1.7.0', FALSE);

            //js site
            // wp_enqueue_script('jquery-author-app', BEAU_JS .'/grid.js', array('jquery'), '1.0.1', TRUE);
            wp_enqueue_script('jquery-book-app', BEAU_JS .'/bebostore.js', array('jquery'), '1.0.1', TRUE);
            wp_enqueue_script('viewer-js', BEAU_JS .'/viewer.min.js', array('jquery'), '1.0.1', TRUE);
            wp_enqueue_script('jquery-viewer-js', BEAU_JS .'/jquery-viewer.min.js', array('jquery'), '1.0.1', TRUE);
        }
        if (!is_404()) {
            wp_enqueue_style('css-font-awesome', BEAU_CSS .'/font-awesome.min.css', array(), '4.3.0');
            wp_enqueue_style('css-animate', BEAU_CSS .'/animate.css', array(), BEAU_THEME_VERSION);
            wp_enqueue_style('css-selectbox', BEAU_CSS .'/jquery.selectbox.css', array(), BEAU_THEME_VERSION);
            wp_enqueue_style('css-idangerous', BEAU_CSS .'/swiper.min.css', array(), BEAU_THEME_VERSION);
            wp_enqueue_style('css-style-woo', BEAU_CSS .'/bebostore_woo.css', array(), '1.0.0');
            wp_enqueue_style('css-flipbook', BEAU_CSS .'/css-flipbook.css', array(), '1.0.0');
            wp_enqueue_style('css-viewer', BEAU_CSS .'/viewer.min.css', array(), '1.0.0');
        }
        wp_enqueue_style('css-bootstrap', BEAU_CSS .'/bootstrap.css', array(), '3.3.1');
        wp_enqueue_style('css-bootstrap', BEAU_CSS .'/animate.css', array(), '3.3.1');
        wp_enqueue_style('css-font-Merriweather', '//fonts.googleapis.com/css?family=Merriweather:400,300italic,700italic,300,700', array(), BEAU_THEME_VERSION);
        wp_enqueue_style('css-font-lato', '//fonts.googleapis.com/css?family=Lato:100,300,400,700,900', array(), BEAU_THEME_VERSION);

        if (is_child_theme()){
            wp_enqueue_style( 'bookstoreparent-theme-style', get_template_directory_uri() . '/style.css' );
        }
        wp_enqueue_style('css-store-style', get_stylesheet_uri());
        wp_enqueue_style('css-default-style', BEAU_CSS .'/bebostore.css', array(), BEAU_THEME_VERSION);
    }
    if (is_admin()) {
        wp_enqueue_style('css-admin-style', BEAU_CSS .'/bebostore_admin.css', array(), BEAU_THEME_VERSION);
    }
}
add_action( 'wp_enqueue_scripts', 'bebostore_scripts', 1 );

//Theme menu
register_nav_menus(array(
    'main-menu'     => esc_html__('Main menu', 'bebostore'),
    'sticker-menu'     => esc_html__('Sticker menu', 'bebostore'),
    'small-menu'    => esc_html__('Small menu', 'bebostore'),
    'mobile-menu'    => esc_html__('Mobile Menu', 'bebostore'),
));


// Numbered Pagination
if ( !function_exists( 'bebostore_pagination' ) ) {
    function bebostore_pagination($loop='', $range = 4) {
        global $wp_query;
        if ($loop=="") {
            $loop = $wp_query;
        }
        $big = 999999999; // need an unlikely integer
        $pages = paginate_links( array(
            'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'    => '?paged=%#%',
            'current'   => max( 1, get_query_var('paged') ),
            'total'     => $loop->max_num_pages,
            'prev_next' => false,
            'type'      => 'array',
            'prev_next' => TRUE,
            'prev_text' => esc_html__('PREV','bebostore'),
            'next_text' => esc_html__('NEXT','bebostore'),
        ) );
        if( is_array( $pages ) ) {
            $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
            echo '<div class="pagging"><ul>';
            foreach ( $pages as $page ) {
                echo "<li>$page</li>";
            }
           echo '</ul></div>';
        }
    }
}


function bebostore_getprefixauth(){
    global $wpdb, $table_prefix;
    $arrayPrefix = array();
    $results = $wpdb->get_results( 'SELECT DISTINCT(meta_value) FROM '.$table_prefix.'postmeta WHERE meta_key = "' . (bebostore_option('author-sort') ? '_beautheme_prefix_last_name' : '_beautheme_prefix_name') . '" ORDER BY meta_value ASC', ARRAY_N );
    foreach ($results as $key => $value) {
        $arrayPrefix[$key] = $value[0];
    }
    return $arrayPrefix;
}




/* REGISTER WIDGETS ------------------------------------------------------------*/

if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar Product','bebostore'),
        'id'            => 'sidebar-product',
        'description'   => esc_html__('Sidebar product widget position.','bebostore'),
        'before_widget' => '<div id="%1$s" class="with-widget col-md-3 col-sm-3 col-xs-12">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>'
    ));

    register_sidebar(array(
        'name'          => esc_html__('Sidebar Home 07','bebostore'),
        'id'            => 'sidebar-home-07',
        'description'   => esc_html__('Sidebar home 07 position.','bebostore'),
        'before_widget' => '<div id="%1$s" class="with-widget widget-home-07 col-md-12 col-sm-12 col-xs-12">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="name-widget">',
        'after_title'   => '</h2>'
    ));

    register_sidebar(array(
        'name' => esc_html__('Sidebar Home 06','bebostore'),
        'id'   => 'sidebar-home-06',
        'description'   => esc_html__('Sidebar home 06 position.','bebostore'),
        'before_widget' => '<div id="%1$s" class="with-widget widget-home-3 col-md-3 col-sm-3 col-xs-12">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="name-widget">',
        'after_title'   => '</h2>'
    ));

}

function sebodo_debug( $dv_value, $dv_bgcolor = '#666', $dv_fontcolor='#fff', $dv_height = '450' ){
    $dv_height = ( $dv_height == '' ) ? '450' : $dv_height;
    $dv_output = '<pre style="font-size:13px; height:'.$dv_height.'px; overflow-y:scroll; background: '.$dv_bgcolor.'; color: '.$dv_fontcolor.';">';
    $dv_output .= print_r( $dv_value, true );
    $dv_output .= '</pre>';
    printf( "%s", $dv_output );
}

/*
Register footer sidebar
*/

////Register widget for page
function bebostore_register_sidebar() {
    global $beau_option;

    $col = $sidebarWidgets = "";

    //Register sidebar for sidebar widget
    register_sidebar(
        array(
            'name' => esc_html__('Sidebar widget', 'bebostore' ),
            'id' => 'sidebar-widget',
            'before_widget' => '<div class="sidebar-widget">',
            'after_widget' => '</div></div>',
            'before_title' => '<div class="title-box title-sidebar-widget"><span>',
            'after_title' => '</span></div><div class="sidebar-content-widget">'
        )
    );

    //Register to show sidebar on footer
    if (isset($beau_option['footer-widget-number'])) {
        $col    = intval($beau_option['footer-widget-number']);
    }
    if($col==0){
        $col  = 4;
    }
    $columns = intval(12/$col);
    if($columns==1){
        register_sidebar(
            array(  // 1
                'name' => esc_html__( 'Footer sidebar', 'bebostore' ),
                'description' => esc_html__( 'This is footer sidebar ', 'bebostore' ),
                'id' => 'sidebar-footer-1',
                'before_widget' => '<div class="footer-column col-md-12 col-sm-12 col-12"><div class="footer-widget">',
                'after_widget' => '</div></div></div>',
                'before_title' => '<div class="title-box widget-title"><span>',
                'after_title' => '</span></div><div class="widget-body">'
            )
        );
    }else{
        for ($i=1; $i <= $col; $i++) {
            register_sidebar(
                array(
                    'name' => 'Footer sidebar '.$i,
                    'id' => 'sidebar-footer-'.$i,
                    'before_widget' => '<div class="footer-column col-md-'.$columns.' col-sm-'.$columns.' col-12"><div class="footer-widget">',
                    'after_widget' => '</div></div>',
                    'before_title' => '<div class="title-box widget-title">',
                    'after_title' => '</div>'
                )
            );
        }
    }

}
add_action( 'widgets_init', 'bebostore_register_sidebar' );

function bebostore_get_category_product(){
    $terms = get_terms('product_cat');
    $category_product['Select...'] = '';
    $category_product['All'] = '';
    if (is_array($terms)) {
        foreach ($terms as $term) {
            $category_product[$term->name] = $term->name;
        }
    }
    return $category_product;
}

function bebostore_get_category_blog(){
    $terms = get_terms('category');
    $category_blog['Select...'] = '';
    $category_blog['All'] = '';
    if (is_array($terms)) {
        foreach ($terms as $term) {
            $category_blog[$term->name] = $term->name;
        }
    }
    return $category_blog;
}

function bebostore_get_home_slider(){
    $args = array(
        'post_type'        => 'slider_hero',
        'post_status'      => 'publish',
    );
    $posts_array = get_posts( $args );
    $home_sliders['Select...'] = '';
    if (is_array($posts_array)) {
        foreach ($posts_array as $post) {
            $home_sliders[get_field('show_on_page' , $post->ID)] = $post->ID;
            
        }
    }
    return $home_sliders;
}

//Get option page
function bebostore_option($string){
    global $beau_option;
    if (isset($beau_option[$string]) && $beau_option[$string] !=='') {
        return $beau_option[$string];
    }
    return;
}

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_filter('the_excerpt', 'do_shortcode');
// remove cross-sells from their normal place
remove_action( 'woocommerce_cart_collaterals',
'woocommerce_cross_sell_display' );
// add them back in further up the page
add_action ('woocommerce_after_cart', 'woocommerce_cross_sell_display' );

add_filter('the_excerpt', 'do_shortcode');
function bebostore_get_list_taxonomy_by_name($taxonomy){
    if($taxonomy != NULL ) {
        $terms = get_terms($taxonomy, array('hide_empty' => true,'orderby' => 'date','order' => 'DESC'));
        $taxonomy_list = array();
        if(empty($terms)) {
            return false;
        } else {
            foreach ($terms as $term) {
                if(is_object($term)) {
                    $taxonomy_list[] = array(
                        'value' => $term->term_id,
                        'label' => $term->name,
                    );
                }
            }
        }

    return $taxonomy_list;
    }
    else return false;

}
/**
 * Get Single Post by Post Type
 * @param  string $post_type
 * @return  array
 */
function bebostore_get_single_post( $post_type = '' ) {
      $posts = get_posts( array(
        'posts_per_page'  => -1,
        'post_type'     => $post_type,
      ));
      $result = array();
      foreach ( $posts as $post ) {
        $result[] = array(
          'value' => $post->ID,
          'label' => $post->post_title,
        );
    }

    return $result;
}

if (!current_user_can('manage_options')) {
    add_filter('show_admin_bar','__return_false');
}

function gt_get_post_view() {


    $count = get_post_meta( get_the_ID(), 'post_views_count', true );


    return "$count views";


}


function gt_set_post_view() {


    $key = 'post_views_count';


    $post_id = get_the_ID();


    $count = (int) get_post_meta( $post_id, $key, true );


    $count++;


    update_post_meta( $post_id, $key, $count );


}


function gt_posts_column_views( $columns ) {


    $columns['post_views'] = 'Views';


    return $columns;


}


function gt_posts_custom_column_views( $column ) {


    if ( $column === 'post_views') {


        echo gt_get_post_view();


    }


}


add_filter( 'manage_posts_columns', 'gt_posts_column_views' );


add_action( 'manage_posts_custom_column', 'gt_posts_custom_column_views' );

function custom_um_profile_query_make_posts( $args = array() ) {

    // Change the post type to our liking.

    $args['post_type'] = 'galeri_kontes';

    return $args;

}

add_filter( 'um_profile_query_make_posts', 'custom_um_profile_query_make_posts', 12, 1 );

@ini_set( 'upload_max_size' , '256M' );
@ini_set( 'post_max_size', '256M');
@ini_set( 'max_execution_time', '300' );