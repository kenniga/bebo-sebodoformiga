<?php
$args_terms = array(
    'taxonomy' => 'lokasi_kontes',
    'meta_query' => array(
        array(
             'key'       => 'kontes_aktif',
             'value'     => true,
             'compare'   => '=='
        )
    ),
);
$terms = get_terms( $args_terms )[0]->term_id;
$args = array('post_type'=> 'galeri_kontes', 'post_status' => 'publish', 'order' => 'DESC', 'tax_query' => array(
    array(
    'taxonomy' => 'lokasi_kontes',
    'field' => 'ID',
    'terms' => $terms,
    )
));
?>
<div class="container">
    <div class="row">
        <div class="col-12">
        <h4 style="color: #0a0a0a;text-align: left;font-size: 18px;margin-bottom: 30px;" class="vc_custom_heading font-intro-bold">Galeri Peserta</h4>
        </div>
    </div>
    <div class="row">
    

<?php
    wp_reset_query();
    $query = new WP_Query($args);
    while($query->have_posts()) : $query->the_post();
        if(has_post_thumbnail()) {  ?>
        <div class="col-sm-3">
            <a href="<?php echo get_permalink(); ?>" class="sc-galeri-kontes__item">
                <?php the_post_thumbnail(); ?>
                <div class="sc-galeri-kontes__overlay">
                    <h6>
                        Judul Karya <?php the_title(); ?>
                    </h6>
                    <p>
                        Nama Peserta <?php the_author_meta('nickname'); ?>
                    </p>
                </div>
            </a>
        </div>
    <?php }
    elseif($thumbnail = get_post_meta($post->ID, 'image', true)) { echo 12323; ?>
        <div class="col-sm-3">
            <img src="<?php echo $thumbnail; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
            </div>
    <?php } endwhile;
    ?>
    </div>
</div>
<?php
