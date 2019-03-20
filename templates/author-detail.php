<?php
    while ( have_posts() ) : the_post();
    $post_id            = get_the_ID();
    $author_avatar      = get_post_meta( $post_id, '_beautheme_type_image', true );

    if (!$author_avatar) {
        $author_avatar  = '<img src="http://placehold.it/120x120" alt="No author avatar">';
    }
    $url_fb             = get_post_meta( $post_id, '_beautheme_author_facebook', true );
    $url_tt             = get_post_meta( $post_id, '_beautheme_author_twitter', true );
    $url_google         = get_post_meta( $post_id, '_beautheme_author_google', true );
    $year_author        = get_post_meta( $post_id, '_beautheme_year_job', true );
    $url_instagram      = get_post_meta( $post_id, '_beautheme_author_instagram', true );
    $url_pinterest      = get_post_meta( $post_id, '_beautheme_author_pinterest', true );
    $url_behance        = get_post_meta( $post_id, '_beautheme_author_behance', true );
    $url_youtube        = get_post_meta( $post_id, '_beautheme_author_youtube', true );
    $url_linkedin       = get_post_meta( $post_id, '_beautheme_author_linkedin', true );

    // Get book with author
    $args = array(
        'post_type'     => 'product',
        'order'         => 'DESC',
        'meta_key'      => 'book_author',
        'meta_value'    => $post_id,
        'meta_compare'  => 'LIKE',
        'posts_per_page' => -1,
    );
    $loop = new WP_Query( $args );

    // Get book with author
    $argsa = array(
        'post_type'         => 'authorbook',
        'order'             => 'ASC',
        'posts_per_page'    => 7,
        'post__not_in'      => array($post_id),
    );
    $authorList = new WP_Query( $argsa );
?>
    <section class="author-detail">

        <div class="container">
            <div class="avatar-author col-md-3 col-sm-3 col-xs-12">
                <span class="auth-avatar">
                    <!-- <img src="images/auth.jpg"> -->
                    <img src="<?php echo esc_attr($author_avatar) ?>" alt="Author avatar">
                </span>
                <div class="social">
                    <ul class="auth-social">
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
                    </ul>
                </div>
            </div>

            <div class="detail-author-description col-md-8 col-sm-8 col-xs-12">
                <div class="title-author"><?php echo get_the_title($post_id); ?></div>
                <div class="year-author"><?php echo esc_html($year_author); ?></div>
                <div class="desc-auth">
                    <?php the_content();?>
                </div>
            </div><!--End .author-description-->

        </div><!--End .container-->

    </section>
    <?php if ($loop->have_posts()): ?>
    <section class="book-by">
        <div class="container">
            <div class="title-list-book"><?php esc_html_e('Books by','bebostore');?> <?php echo get_the_title(); ?></div>
                <ul class="book-grid col-md-12-col-sm-12 col-xs-12">
                    <?php while ( $loop->have_posts() ) : $loop->the_post();?>
                    <?php 
                        $style_product = '';
                        $none_book = get_post_meta( get_the_ID(),'_beautheme_product_none_book', TRUE);
                        if($none_book == 'on'){
                            $style_product = 'none-book';
                        }
                     ?>
                    <li class="book-item-slide book-item-author">
                        <a id="author-<?php echo esc_attr(get_the_ID());?>" href="<?php echo esc_url(get_permalink()); ?>">
                            <div class="book-item <?php echo esc_attr($style_product);?>">
                                <div class="book-image">
                                    <?php
                                    $id_product = $loop->post->ID;
                                    $year_product = get_post_meta( $id_product, '_beautheme_publishing_year', true );
                                    if (has_post_thumbnail( $id_product )){?>
                                        <?php  echo get_the_post_thumbnail($id_product); ?>
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
                    </li>
                    <?php endwhile; ?>
                </ul>
         </div>
    </section>
    <?php endif ?>
    <?php if ($authorList->have_posts()): ?>
    <section class="other-author">
        <div class="container">

            <div class="title-boxies"><?php esc_html_e('Other author','bebostore');?></div>
            <div class="clearfix"></div>
            <div class="list-name-author">
                <div class="list-author-name  author-list-avatar">
                    <?php while ( $authorList->have_posts() ) : $authorList->the_post();
                        $author_avatar      = get_post_meta( get_the_ID(), '_beautheme_type_image', true );
                        if (!$author_avatar) {
                            $author_avatar  = '<img src="http://placehold.it/120x120" alt="No author avatar">';
                        }
                    ?>
                    <div class="author-item">
                        <a href="<?php the_permalink();?>">
                            <img src="<?php printf('%s', $author_avatar);?>" alt="Author avatar">
                        </a>
                        <a href="<?php the_permalink();?>">
                            <p><?php the_title();?></p>
                        </a>
                    </div>
                <?php endwhile; ?>
                </div>
            </div>

        </div>
    </section>
    <?php endif ?>
<?php endwhile;?>