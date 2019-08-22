<?php
$form_class = $form_title = "";
extract(shortcode_atts(array(
    'form_class'	=> '',
    'form_title'	=> ''
), $atts));

$id_form  =  "form_id_".rand(1111,9999);
?>
<?php if ( !is_user_logged_in() ) {
    if( !empty($form_title) ) {
        ?>
        <h4 style="color: #0a0a0a;text-align: left" class="vc_custom_heading font-intro-bold vc_custom_1566450676803"><? echo esc_html($form_title) ?> </h4>
    <?php } ?>
        <div class="sc-ultimate-form <?php echo esc_attr( $form_class ) ?>" id="<?php echo esc_attr($id_form); ?>">
            <?php echo do_shortcode($content); ?>
        </div>
<?php 
} 
?>
