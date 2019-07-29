<?php
$video_file = "";
extract(shortcode_atts(array(
    'video_file'			=> '',
), $atts));
?>
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="<?php echo wp_get_attachment_url( $video_file ); ?>" allowfullscreen></iframe>
</div>