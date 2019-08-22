<?php
$content = $form_class = "";
extract(shortcode_atts(array(
    'form_class'	=> '',
    'content'	=> ''
), $atts));

$id_form  =  "form_id_".rand(1111,9999);
?>

<div class="sc-ultimate-form <?php echo esc_attr( $form_class ) ?>" id="<?php echo esc_attr($id_form); ?>">
    <?php do_shortcode($content); ?>
</div>
