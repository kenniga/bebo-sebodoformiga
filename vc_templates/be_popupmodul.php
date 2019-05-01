<?php
$modul_target = $modul_title = $modul_image = $modul_subtitle = $modul_background = $modul_file = "";
extract(shortcode_atts(array(
    'modul_target'			=> '',
    'modul_title'			=> '',
    'modul_image'			=> '',
    'modul_subtitle'		=> '',
    'modul_background'		=> '',
    'modul_file'		=> '',
), $atts));

$button_unique_id = generateRandomString();

$scoped_style = sprintf('
	<style>
		#' . $button_unique_id . ' {
            %1$s;
            color: white;
		}
		#' . $button_unique_id . ':hover{
            background: #1b2c51;
		}
	</style>
    ',
    $modul_background          = !empty( $modul_background ) ? 'background:' . $modul_background : ''
);
echo $scoped_style;

?>

<a id="<?php echo esc_attr($button_unique_id) ?>" class="btn be_btn--rounded" data-toggle="modal" data-target="#<?php echo esc_attr( $modul_target ); ?>">
	<?php esc_html_e( $modul_title ); ?>
</a>

<div class="be_popupmodul modal fade " id="<?php echo esc_attr( $modul_target ); ?>" tabindex="-1" role="dialog"
	aria-labelledby="<?php echo esc_attr( $modul_target ); ?>" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content" <?php 
	  	if ( !empty( $modul_background ) ) { 
			echo 'style="' . esc_attr( $modul_background ) .  ';"'; 
		}  ?> >
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<div class="modal-body">
				<h3>
					<?php esc_html_e( $modul_title ); ?>
				</h3>
				<?php 
				if ( !empty( $modul_image ) ) { 
					echo '<img src="' . wp_get_attachment_image_src( $modul_image, 'medium' )[0] .  '  " class="img-responsive" />'; 
				}  ?>
				<h4>
					<?php echo esc_html_e( $modul_subtitle ); ?>
				</h4>
				<a class="btn" <?php 
				if ( !empty( $modul_file ) ) { 
					echo 'href="' . wp_get_attachment_url($modul_file) .  '  "'; 
				}  ?> download>
					Download Modul
				</a>
			</div>
		</div>
	</div>
</div>