<?php
$video_file = $image_placeholder = "";
extract(shortcode_atts(array(
    'video_file'			=> '',
    'image_placeholder'			=> '',
), $atts));

$args = array(
  'post_type' => 'post',
  'meta_query' => array(
    array(
        'key' => 'show_this_post_on',
        'value' => 'below-tentang-jabar-masagi',
        'compare' => 'LIKE'
    )
  )
);
  $post = get_posts($args)[0];
?>
<div class="row">
  <div class="col-sm-12">
    <h4 style="color: #ffffff;text-align: center" class="vc_custom_heading font-intro-bold">What We Do</h4>
  </div>
  <div class="col-sm-4">
    <div class="sc-card-item">
      <h5 class="sc-card-item__title">
        <?php echo esc_html($post->post_title) ?>
      </h5>
        <div class="sc-card-item__img">
            <?php 
            if ( !empty( $post->ID ) ) { 
                echo '<img src="' . get_the_post_thumbnail_url( $post->ID, 'medium' ) .  '  " class="img-responsive" />'; 
            }  ?>
        </div>
        <div class="sc-card-item__content">
            <p>
            <?php echo get_the_excerpt( $post->ID ); ?> 
            </p>
        </div>
        <div class="sc-card-item__action">
            <a class="sc-card-item__action-link" href="<?php echo get_permalink( $post->ID ) ?>">
                Lebih Lanjut
            </a>
        </div>
    </div>
  </div>
  <div class="col-sm-8">
    <div class="sc-video-player">
      <div class="embed-responsive embed-responsive-16by9">
        <video class="embed-responsive-item" id="video_player" controls>
          <source src="<?php echo get_field('video_homepage', $post->ID)['video_file'][0]['url']; ?>" type="video/mp4">
          <!-- <source src="video.ogg" type="video/ogg">
          <source src="video.webm" type="video/webm">
          <object data="video.mp4" width="470" height="255">
          <embed src="video.swf" width="470" height="255"> -->
        </video>
        <div class="sc-video-player__placeholder" onClick="playVid(this)">
          <img src="<?php echo wp_get_attachment_url(get_field('video_homepage', $post->ID)['video_thumbnail']); ?>" alt="">
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
  </div>
</div>

