<?php
//Support function
add_action('wp_head','bookstore_ajaxurl',1);
function bookstore_ajaxurl() {
?>
<script type="text/javascript">
    var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    var blogname = '<?php echo bloginfo( 'name' ); ?>';
    var authorPage = true;
    <?php
        if (bebostore_option('enable_author_ajax') != NULL) {
            if (bebostore_option('enable_author_ajax') == 1) {
    ?>
                authorPage = false;
    <?php
            }
        }
        $authorPage = bebostore_option('author-page');
        if ($authorPage) {
            $pageTMP = get_page_by_path( $authorPage );
            if($pageTMP){
                echo "var authorPageID = ".$pageTMP->ID.";\n";
            }
        }
    ?>
</script>
<?php
}


add_action('wp_ajax_bookstore_get_detail_author', 'bookstore_get_detail_author');
add_action('wp_ajax_nopriv_bookstore_get_detail_author', 'bookstore_get_detail_author');

function bebostore_get_attachment_id_from_url( $attachment_url = '' ) {
    global $wpdb;
    $attachment_id = false;
    if ( '' == $attachment_url )
        return;
    $upload_dir_paths = wp_upload_dir();
    if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
        $attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
        $attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
        $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
    }
    return $attachment_id;
}

function bookstore_get_detail_author(){
    if (isset($_GET['auth-id'])) {

       $detailAuthor = get_post(intval($_GET['auth-id']));
       if (is_object($detailAuthor)) {
        $post_id            = intval($_GET['auth-id']);
        $author_avatar      = get_post_meta( $post_id, '_beautheme_type_image', true );

        if (!$author_avatar) {
            $author_avatar  = '<img src="http://placehold.it/120x120" alt="No author avatar">';
        }
        $url_fb         = get_post_meta( $post_id, '_beautheme_author_facebook', true );
        $url_tt         = get_post_meta( $post_id, '_beautheme_author_twitter', true );
        $url_google     = get_post_meta( $post_id, '_beautheme_author_google', true );
        $year_author    = get_post_meta( $post_id, '_beautheme_year_job', true );
        $url_instagram  = get_post_meta( $post_id, '_beautheme_author_instagram', true );
        $url_pinterest  = get_post_meta( $post_id, '_beautheme_author_pinterest', true );
        $url_behance    = get_post_meta( $post_id, '_beautheme_author_behance', true );
        $url_youtube    = get_post_meta( $post_id, '_beautheme_author_youtube', true );
        $url_linkedin   = get_post_meta( $post_id, '_beautheme_author_linkedin', true );

        // Get book with author
        $args = array(
            'post_type'     => 'product',
            'order'         => 'DESC',
            'meta_key'      => 'book_author',
            'meta_value'    => $post_id,
            'meta_compare'  => 'LIKE',
        );
        $loop = new WP_Query( $args );
        ?>

        <div class="detail-author-book">
            <div class="box-meet-author col-md-6 col-sm-6 col-xs-12">
                <div class="title-box meet-box"><span><?php esc_html_e('Meet the Author','bebostore'); ?></span></div>
                <div class="author-info">
                    <div class="img-social">
                        <div class="avatar-author-item">
                            <img src="<?php printf('%s', $author_avatar);?>" alt="Author avatar">
                        </div>
                        <div class="clearfix"></div>
                        <ul>
                            <?php if( $url_fb ): ?>
                                <li><a href="<?php echo esc_url($url_fb); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <?php endif; ?>

                            <?php if( $url_tt ): ?>
                            <li><a href="<?php echo esc_url($url_tt); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <?php endif; ?>

                            <?php if( $url_google ): ?>
                            <li><a href="<?php echo esc_url($url_google); ?>" target="_blank"><i class="fa fa-google"></i></a></li>
                            <?php endif; ?>

                            <?php if( $url_instagram ): ?>
                            <li><a href="<?php echo esc_url($url_instagram); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                            <?php endif; ?>

                            <?php if( $url_pinterest ): ?>
                            <li><a href="<?php echo esc_url($url_pinterest); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                            <?php endif; ?>

                            <?php if( $url_behance ): ?>
                            <li><a href="<?php echo esc_url($url_behance); ?>" target="_blank"><i class="fa fa-behance"></i></a></li>
                            <?php endif; ?>

                            <?php if( $url_youtube ): ?>
                            <li><a href="<?php echo esc_url($url_youtube); ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
                            <?php endif; ?>

                            <?php if( $url_linkedin ): ?>
                            <li><a href="<?php echo esc_url($url_linkedin); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="desc-name">
                        <div class="name-author"><?php echo get_the_title($post_id); ?></div>
                        <div class="year-author"><?php echo esc_attr($year_author); ?></div>
                        <div class="desc-author"><?php echo  get_post_field('post_content', $post_id); ?></div>
                    </div>
                </div>
            </div><!--End box author-->
             <?php
                $custom_Width = ceil($loop->post_count/2) * 170;
                wp_reset_postdata();
                if ($loop->have_posts()) {
            ?>
            <div class="box-author-book col-md-6 col-sm-6 col-xs-12">
                <div class="author-book-title title-box"><span><?php esc_html_e('Books of ','bebostore'); ?><?php echo get_the_title( $post_id ); ?></span></div>
                <div class="clearfix"></div>
                <div id="author-book-slide" class="swiper-container author-book-slider slider-with-scroll">
                        <!-- Additional required wrapper -->
                        <div class="swiper-scrollbar author-book-scrollbar"></div>
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <?php
                            while ( $loop->have_posts() ) : $loop->the_post();
                                $style_product = '';
                                $none_book = get_post_meta( get_the_ID(),'_beautheme_product_none_book', TRUE);
                                if($none_book == 'on'){
                                    $style_product = 'none-book';
                                }
                                ?>
                                <div class="swiper-slide">
                                    <div class="beau-author-book-item">
                                        <div class="book-item-slide">
                                            <a id="author-<?php echo esc_attr(get_the_ID());?>" href="<?php echo esc_url(get_permalink()); ?>">
                                                <div class="book-item <?php echo esc_attr($style_product);?>">
                                                    <div class="book-image">
                                                        <?php
                                                        $id_product = $loop->post->ID;
                                                        $year_product = get_post_meta( $id_product, '_beautheme_publishing_year', true );
                                                        if (has_post_thumbnail( $id_product )){?>
                                                            <?php echo the_post_thumbnail(); ?>
                                                        <?php }
                                                        else{
                                                            echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="100px" height="150px" />';
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="author-info">
                                                <a href="<?php echo esc_url(get_permalink()); ?>">
                                                    <div class="book-name"> <?php the_title(); ?></div>
                                                </a>
                                                <div class="book-year"><?php echo esc_html($year_product); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--End swiper-slide-->
                            <?php endwhile; ?>
                        </div><!--End swiper-wrapper-->

                    </div><!--End .book-slider-feature-->
                    <script>
                        (function($) {
                            "use strict";
                            var bookAuthorLa = new Swiper('#author-book-slide', {
                                scrollContainer: true,
                                grabCursor: true,
                                scrollbar: {
                                  el: '.author-book-scrollbar'
                                },
                                slidesPerView: 3,
                                slidesPerColumn: 2,
                                breakpoints: {
                                    320: {
                                        slidesPerView: 2,
                                    },
                                    // when window width is <= 480px
                                    480: {
                                        slidesPerView: 2,
                                    },
                                    // when window width is <= 640px
                                    640: {
                                        slidesPerView: 3,
                                    },
                                },
                              });
                        })(jQuery);
                    </script>
            </div>
            <?php }?>
        </div>

    <?php
       }
       exit();
    }
}
add_action('wp_ajax_bookstore_filltertext', 'bookstore_filltertext');
add_action('wp_ajax_nopriv_bookstore_filltertext', 'bookstore_filltertext');
function bookstore_filltertext(){
    if (isset($_GET['author-prefix'])) {
        $text = $_GET['author-prefix'];
        if ($text != 'item-all') {
            bookstore_getAuthorList($text);
        }else{
            $alphaBeta = bebostore_getprefixauth();
            foreach ($alphaBeta as $value) {
                bookstore_getAuthorList($value);
            }
        }
       exit();
    }
}

function bookstore_getAuthorList($textPrefix){
    $args = array(
        'post_type'      => 'authorbook',
        'posts_per_page' => -1,
        'meta_key'       => (bebostore_option('author-sort') ? '_beautheme_prefix_last_name' : '_beautheme_prefix_name'),
        'meta_value'     => $textPrefix,
    );
    $loop = new WP_Query( $args);
    wp_reset_postdata();
    if ($loop->post_count) {
    ?>
    <div class="list-name-author">
        <div class="title-alpha"><?php echo esc_attr($textPrefix); ?><span>(<?php echo esc_html($loop->post_count); ?>)</span></div>
        <div class="list-author-name  author-list-avatar">

        <?php if ($loop->have_posts()) {
            while ($loop->have_posts()) { $loop ->the_post();
            $author_avatar      = get_post_meta( get_the_ID(), '_beautheme_type_image', true );
            if (!$author_avatar) {
                $author_avatar  = '<img src="http://placehold.it/120x120" alt="No author avatar">';
            }
            ?>
            <div class="author-item">
                <div class="avatar-author-item">
                    <a class="avatar-author" id="post-<?php echo get_the_ID();?>" data-authorID = "<?php echo get_the_ID();?>" href="<?php echo the_permalink(); ?>" title="<?php echo the_title(); ?>">
                        <img src="<?php print($author_avatar); ?>" alt="<?php esc_html_e('Author avatar','bookstore'); ?>">
                    </a>
                </div>
                <a href="<?php echo the_permalink(); ?>">
                    <p><?php the_title();?></p>
                </a>

            </div>
        <?php
           }
        }
        ?>
        </div>
    </div><!--End author-list-avatar-->
<?php }
}