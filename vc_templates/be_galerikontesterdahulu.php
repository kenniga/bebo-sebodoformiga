<?php
$args_terms = array(
    'taxonomy' => 'lokasi_kontes',
    'meta_query' => array(
        array(
             'key'       => 'kontes_aktif',
             'value'     => true,
             'compare'   => '!='
        )
    ),
);
$terms = get_terms( $args_terms );
?>
<div class="container">
    <div class="row">
        <div class="col-12">
        <h4 style="color: #0a0a0a;text-align: left;font-size: 18px;margin-bottom: 30px;" class="vc_custom_heading font-intro-bold">Galeri Sebelumnya</h4>
        </div>
    </div>
    <div class="row">
    

<?php
    foreach ($terms as $key => $value) { 
        $args = array('post_type'=> 'galeri_kontes', 'post_status' => 'publish', 'order' => 'DESC', 'tax_query' => array(
            array(
            'taxonomy' => 'lokasi_kontes',
            'field' => 'ID',
            'terms' => $value->term_id,
            )
        ));

        $posts = get_posts($args);
        ?>
        <div class="col-sm-3">
            <a href="<?php echo get_term_link($value->term_id); ?>" class="sc-galeri-kontes-terdahulu__item">
                <?php 
                    foreach ($posts as $key_thumbnail => $value_thumbnail) {
                        if( $key_thumbnail == 4 ) continue;
                        echo get_the_post_thumbnail($posts[$key_thumbnail]->ID);  
                    }
                ?>
            </a>
            <div class="sc-galeri-kontes-terdahulu__overlay">
                <h6>
                    Series <?php echo $value->name; ?>
                </h6>
            </div>
        </div>
    <?php }; ?>
    </div>
</div>
<?php

