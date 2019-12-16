<?php
$form_class = $form_title = $image_title = $image_after_login = $image_before_login = $image_link = "";
extract(shortcode_atts(array(
    'form_class'	    => '',
    'form_title'	    => '',
    'image_after_login' => '',
    'image_before_login'=> '',
    'image_link'        => '',
    'image_title'       => ''

), $atts));

$id_form  =  "form_id_".rand(1111,9999);
$image_link = vc_build_link($image_link);
?>
<?php if ( !is_user_logged_in() ) {
    ?>
    <div class="row">
        <div class="col-12 col-sm-6">
            <?php if(!empty($image_title)) { ?>
                <h4 style="color: #0a0a0a;text-align: left" class="vc_custom_heading font-intro-bold vc_custom_1566482503107 mb-4"><?php echo esc_html($image_title); ?></h4>
            <?php } ?>
            <?php if(!empty($image_before_login)) { ?>
                <a href="<?php echo $image_link['url'];?>">
                    <img src="<?php echo wp_get_attachment_image_src( $image_before_login, 'full' )[0] ?>" alt="">
                </a>
            <?php } ?>
        </div>
        <div class="col-12 col-sm-6">
            <?php if( !empty($form_title) ) { ?>
                <h4 style="color: #0a0a0a;text-align: left; margin-left: 50px;" class="vc_custom_heading remove-ml-mobile font-intro-bold vc_custom_1566450676803"><? echo esc_html($form_title) ?> </h4>
            <?php } ?>
            <div class="sc-ultimate-form <?php echo esc_attr( $form_class ) ?>" id="<?php echo esc_attr($id_form); ?>">
                <?php echo do_shortcode($content); ?>
            </div>
        </div>
    </div>
<?php 
    } else { ?>
    <div class="row">
        <div class="col-12">
            <h4 style="color: #0a0a0a;text-align: center" class="vc_custom_heading font-intro-bold mb-5 vc_custom_1566482503107"><?php echo esc_html($image_title); ?></h4>
            <?php if(!empty($image_after_login)) { ?>
                <a class="d-block" href="<?php echo $image_link['url']; ?>">
                    <img src="<?php echo wp_get_attachment_image_src( $image_after_login, 'full')[0]; ?>" alt="">
                </a>
            <?php } ?>
        </div>
    </div>
<?php } ?>
