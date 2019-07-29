<?php
$title_card = $card_image = $text_content = "";
extract(shortcode_atts(array(
    'title_card'			=> '',
    'card_image'			=> '',
    'text_content'		=> '',
), $atts));
?>
<div class="sc-card-item">
	<h5 class="sc-card-item__title">
		<?php echo esc_html($title_card) ?>
	</h5>
    <div class="sc-card-item__img">
        <?php 
        if ( !empty( $card_image ) ) { 
            echo '<img src="' . wp_get_attachment_image_src( $card_image, 'medium' )[0] .  '  " class="img-responsive" />'; 
        }  ?>
    </div>
    <div class="sc-card-item__content">
        <p>
            <?php echo esc_html( $text_content ); ?>
        </p>
    </div>
    <div class="sc-card-item__action">
        <a href="#">
            Lanjut
        </a>
    </div>
</div>
