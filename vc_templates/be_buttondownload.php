<?php
$button_title = $button_background = $button_font_size = $button_font_color = $button_file = $button_unique_id = "";
extract(shortcode_atts(array(
    'button_title'			    => '',
    'button_background'			=> '',
    'button_font_size'			=> '',
    'button_width'			    => '',
    'button_font_color'			=> '',
    'button_background_hover'	=> '',
    'button_font_color_hover'	=> '',
    'button_file'		        => '',
), $atts));

$button_unique_id = generateRandomString();

$scoped_style = sprintf('
	<style>
		#' . $button_unique_id . ' {
            %1$s;
            %2$s;
            %5$s;
            %6$s;
            %7$s;
		}
		#' . $button_unique_id . ':hover{
            %3$s;
            %4$s;
		}
	</style>
    ',
    $button_background          = !empty( $button_background ) ? 'background:' . $button_background : '',
    $button_font_color          = !empty( $button_font_color ) ? 'color:' . $button_font_color : '',
    $button_background_hover    = !empty( $button_background_hover ) ? 'background:' . $button_background_hover : '',
    $button_font_color_hover    = !empty( $button_font_color_hover ) ? 'color:' . $button_font_color_hover : '',
    $button_font_size           = !empty( $button_font_size ) ? 'font-size: calc(' . $button_font_size . 'vw + 1rem)' : '',
    $button_width               = !empty( $button_width ) ? 'width: ' . $button_width . ';' : '',
    $button_margin_bottom       = 'margin-bottom: calc(2vw + 1rem)'
);
echo $scoped_style;

?>

<a id="<?php echo esc_attr($button_unique_id) ?>" class="btn be_btn--rounded" <?php 
if ( !empty( $button_file ) ) { 
    echo 'href="' . wp_get_attachment_url($button_file) .  '  "'; 
}  ?>
download>
    <?php esc_html_e($button_title, 'bebostore') ?>
</a>