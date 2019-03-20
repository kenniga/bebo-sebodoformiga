<?php if ( have_posts() ) :
require(get_template_directory().'/templates/header-blog.php');

$title_page = esc_html__('Blog','bebostore');
if(is_category()){
    $cat = get_category_by_path(get_query_var('category_name'),false);
    $title_page = $cat->cat_name;
}
if (is_tag()) {
    $postTag = get_term_by('slug', get_query_var('tag'), 'post_tag');
    $title_page = esc_html__('Tag: ','bebostore').$postTag->name;
}
if (is_search()) {
    $title_page = esc_html__('Search with keywords: ','bebostore').esc_html($_REQUEST['s']);
}
?>
<section class="header-page blog-header-grid" <?php printf('%s', $style_page)?>>
    <div class="container">
        <span class="title-page"><?php echo esc_attr( $title_page ); ?></span>
    </div>
</section>
<section>
    <div class="container">
        <div class="left-cols pull-left col-md-12 col-sm-12 col-xs-12">
            <div class="page-blogs-grid grid-random-columns">
            <?php
                if (!$page_setting) {
                    while ( have_posts() ) : the_post();
                       require(get_template_directory().'/templates/content-post.php');
                    endwhile;
                }else{
                    $loop = new WP_Query( $args );
                    while ( $loop -> have_posts() ) : $loop -> the_post();
                        require(get_template_directory().'/templates/content-post.php');
                    endwhile;
                    $wp_query = $loop;
                    wp_reset_postdata();
                }
            ?>
            </div><!--End blog-list-->
            <script>
                (function($) {
                    "use strict";
                    $(window).load(function() {
                        $('.grid-random-columns').isotope({
                        itemSelector: '.blog-items',
                            masonry: {
                              columnWidth: 267
                            }
                        });
                    });
                })(jQuery);
            </script>
            <div class="clearfix"></div>
            <?php echo bebostore_pagination($wp_query);?>
        </div><!--End left-cols-->
    </div><!--End .container-->
</section>
<?php
else :
    get_template_part( 'templates/content', 'none' );
endif;
?>