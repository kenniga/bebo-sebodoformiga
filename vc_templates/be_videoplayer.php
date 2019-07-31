<?php
$video_file = $image_placeholder = "";
extract(shortcode_atts(array(
    'video_file'			=> '',
    'image_placeholder'			=> '',
), $atts));

?>
<div class="sc-video-player">
  <div class="embed-responsive embed-responsive-16by9">
    <video class="embed-responsive-item" id="video_player" controls>
      <source src="<?php echo wp_get_attachment_url( $video_file ); ?>" type="video/mp4">
      <!-- <source src="video.ogg" type="video/ogg">
      <source src="video.webm" type="video/webm">
      <object data="video.mp4" width="470" height="255">
      <embed src="video.swf" width="470" height="255"> -->
    </video>
    <div class="sc-video-player__placeholder" onClick="playVid(this)">
      <img src="<?php echo wp_get_attachment_url( $image_placeholder ) ?>" alt="">
      <i class="fa fa-play"></i>
    </div>
  </div>
  <script type="text/javascript">
    var vid = document.getElementById("video_player"); 
    function playVid(e) { 
        vid.play(); 
        e.style.display = "none";
    } 
    
  </script>

</div>

