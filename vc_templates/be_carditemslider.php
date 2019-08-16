<?php
$slider_attr = "";
extract(shortcode_atts(array(
    'slider_attr'		=> '',
), $atts));
$parsed_atts = vc_param_group_parse_atts( $slider_attr );
$id_slider  =  "slider_id_".rand(1111,9999);
?>
<div class="sc-card-slider sc-card-slider__container swiper-container" id="<?php echo esc_attr($id_slider);?>">
    <div class="swiper-wrapper">
        <?php foreach ($parsed_atts as $item) { ?>
        <div class="swiper-slide">
            <div class="sc-card-slider__item">
                <div class="sc-card-slider__img">
                    <?php 
                    if ( !empty( $item['upload_slider_picture'] ) ) { 
                        echo '<img src="' . wp_get_attachment_image_src( $item['upload_slider_picture'], 'thumbnail' )[0] .  '  " class="img-responsive" />'; 
                    }  ?>
                </div>
                <h5 class="sc-card-slider__title">
                    <?php echo esc_html($item['slider_title']) ?>
                </h5>
                <div class="sc-card-slider__content">
                    <p>
                        <?php echo esc_html( $item['slider_desc'] ); ?>
                    </p>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
        
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <script>
            (function($) {
                "use strict";
                var cardSlider_<?php echo esc_js($id_slider);?> = new Swiper('#<?php echo esc_js($id_slider);?>', {
                    slidesPerView: 3,
                    grabCursor:true,
                    speed: 1000,
                    loop: true,
                    spaceBetween: 30,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                });
            })(jQuery);
		</script>
</div>


