<?php
$contact7 = $contact_id = $option = $lat = $lng = $title_contact = $city_contact = $address_contact = $phone_contact = $email_contact = $fb_contact = $twitter_contact = $rss_contact = $google_contact = $flick_contact = $style_map = "";
extract(shortcode_atts(array(
	'option' => '',
    'lat' => '',
    'lng' => '',
    'contact7' => '',
    'contact_id' => '',
    'title_contact' => '',
    'city_contact' => '',
    'address_contact' => '',
    'phone_contact' => '',
    'email_contact' => '',
    'fb_contact' => '',
    'twitter_contact' => '',
    'rss_contact' => '',
    'google_contact' => '',
    'flick_contact' => '',
    'style_map' => '',
), $atts));
if($style_map == ''){
	$style_map = 'default';
}
$map_style_data = array(
	'default' => '[{"featureType":"administrative","elementType":"labels","stylers":[{"visibility":"simplified"},{"color":"#e94f3f"}]},{"featureType":"landscape","elementType":"all","stylers":[{"visibility":"on"},{"gamma":"0.50"},{"hue":"#ff4a00"},{"lightness":"-79"},{"saturation":"-86"}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"hue":"#ff1700"}]},{"featureType":"landscape.natural.landcover","elementType":"all","stylers":[{"visibility":"on"},{"hue":"#ff0000"}]},{"featureType":"poi","elementType":"all","stylers":[{"color":"#e74231"},{"visibility":"off"}]},{"featureType":"poi","elementType":"labels.text.stroke","stylers":[{"color":"#4d6447"},{"visibility":"off"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"color":"#f0ce41"},{"visibility":"off"}]},{"featureType":"poi.park","elementType":"all","stylers":[{"color":"#363f42"}]},{"featureType":"road","elementType":"all","stylers":[{"color":"#231f20"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#6c5e53"}]},{"featureType":"transit","elementType":"all","stylers":[{"color":"#313639"},{"visibility":"off"}]},{"featureType":"transit","elementType":"labels.text","stylers":[{"hue":"#ff0000"}]},{"featureType":"transit","elementType":"labels.text.fill","stylers":[{"visibility":"simplified"},{"hue":"#ff0000"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#0e171d"}]}]',

	'paper' => '[{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"landscape","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#5f94ff"},{"lightness":26},{"gamma":5.86}]},{"featureType":"road.highway","elementType":"all","stylers":[{"weight":0.6},{"saturation":-85},{"lightness":61}]},{"featureType":"landscape","elementType":"all","stylers":[{"hue":"#0066ff"},{"saturation":74},{"lightness":100}]}]',

	'retro'	=> '[{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"simplified"}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"landscape","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#84afa3"},{"lightness":52}]},{"featureType":"all","elementType":"all","stylers":[{"saturation":-17},{"gamma":0.36}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"color":"#3f518c"}]}]',

	'light-mono' => '[{"featureType":"water","elementType":"all","stylers":[{"visibility":"simplified"},{"hue":"#e9ebed"},{"saturation":-78},{"lightness":67}]},{"featureType":"landscape","elementType":"all","stylers":[{"visibility":"simplified"},{"hue":"#ffffff"},{"saturation":-100},{"lightness":100}]},{"featureType":"road","elementType":"geometry","stylers":[{"visibility":"simplified"},{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"},{"hue":"#ffffff"},{"saturation":-100},{"lightness":100}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"visibility":"simplified"},{"hue":"#e9ebed"},{"saturation":-90},{"lightness":-8}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"on"},{"hue":"#e9ebed"},{"saturation":10},{"lightness":69}]},{"featureType":"administrative.locality","elementType":"all","stylers":[{"visibility":"on"},{"hue":"#2c2e33"},{"saturation":7},{"lightness":19}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"on"},{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31}]},{"featureType":"road.arterial","elementType":"labels","stylers":[{"visibility":"simplified"},{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":-2}]}]',

	'blue-water' => '[{"featureType":"water","elementType":"all","stylers":[{"visibility":"on"},{"color":"#46bcec"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]}]',

	'facebook' => '[{"featureType":"water","elementType":"all","stylers":[{"color":"#3b5998"}]},{"featureType":"administrative.province","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"all","elementType":"all","stylers":[{"hue":"#3b5998"},{"saturation":-22}]},{"featureType":"landscape","elementType":"all","stylers":[{"visibility":"on"},{"color":"#f7f7f7"},{"saturation":10},{"lightness":76}]},{"featureType":"landscape.natural","elementType":"all","stylers":[{"color":"#f7f7f7"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"color":"#8b9dc3"}]},{"featureType":"administrative.country","elementType":"geometry.stroke","stylers":[{"visibility":"simplified"},{"color":"#3b5998"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"on"},{"color":"#8b9dc3"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"},{"color":"#8b9dc3"}]},{"featureType":"transit.line","elementType":"all","stylers":[{"invert_lightness":false},{"color":"#ffffff"},{"weight":0.43}]},{"featureType":"road.highway","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"#8b9dc3"}]},{"featureType":"administrative","elementType":"labels.icon","stylers":[{"visibility":"on"},{"color":"#3b5998"}]}]',
);
?>
<?php
if ($option == 'horizontal-one') {
?>
<section class="book-contact full-column full-center">
	<script type="text/javascript">
	    google.maps.event.addDomListener(window, 'load', init);
	    function init() {
	        var mapOptions = {
	            zoom: 16,
	            scrollwheel: false,
	            // mapTypeId: google.maps.MapTypeId.ROADMAP,
	            center: new google.maps.LatLng(<?php print($lat); ?>, <?php print($lng); ?>),
	            <?php if($style_map != 'default-google') : ?>
                	styles: <?php echo $map_style_data[$style_map]; ?>
				<?php endif; ?>
			};
	        var mapElement = document.getElementById('book-map-contact');
	        var map = new google.maps.Map(mapElement, mapOptions);
	        var marker = new google.maps.Marker({
	            position: new google.maps.LatLng(<?php print($lat); ?>, <?php print($lng); ?>),
	            map: map,
	            icon: "",
	            title: 'Map title'
	        });
	    }
	</script>
	<div class="book-map-address col-md-12 col-sm-12 col-xs-12">
		<div id="book-map-contact"></div>
	</div>
	<div class="container">
		<div class="col-md-12 col-sm-12 col-xs-12 book-form-contact">
			<div class="text-form-contact col-md-12 col-sm-12 col-xs-12">
				<div class="title-box title-contact"><span><?php print($title_contact); ?></span></div>
				<div class="book-address book-center">
					<span class="book-place-name"><?php print($city_contact); ?></span>
					<span class="book-contact-add">
						<?php print($address_contact); ?><br>
						<?php print($phone_contact); ?><br>
						<?php print($email_contact); ?>
					</span>
				</div>
				<ul class="list-social no-border book-center">
					<?php
						if (!$fb_contact =='') {
					?>
						<li><a href="<?php echo esc_url($fb_contact); ?>"><i class="fa fa-facebook"></i></a></li>
					<?php } ?>
					<?php
						if (!$twitter_contact =='') {
					?>
						<li><a href="<?php echo esc_url($twitter_contact); ?>"><i class="fa fa-twitter"></i></a></li>
					<?php } ?>
					<?php
						if (!$rss_contact =='') {
					?>
						<li><a href="<?php echo esc_url($rss_contact); ?>"><i class="fa fa-rss"></i></a></li>
					<?php } ?>
					<?php
						if (!$google_contact =='') {
					?>
						<li><a href="<?php echo esc_url($google_contact); ?>"><i class="fa fa-google-plus"></i></a></li>
					<?php } ?>
					<?php
						if (!$flick_contact =='') {
					?>
						<li><a href="<?php echo esc_url($flick_contact); ?>"><i class="fa fa-flickr"></i></a></li>
					<?php } ?>

				</ul>
			</div>
			<div class="form-content book-center col-md-10 col-sm-10 col-xs-12">
				<div class="contact-content book-center">
					<center><?php print($content); ?></center>
				</div>
				<?php if($contact7 != 'yes') :?>
				<form action="" class="book-contact-form col-md-8 col-sm-8 col-xs-12">
					<div class="success-form-message"><?php esc_html_e('Success & Error message','bebostore');?></div>
					<input id="beau-first-name"  placeholder="<?php esc_html_e('First Name *','bebostore')?>" type="text" name="txt-firstname" class="beau-input txt-contact">
					<input id="beau-email"  placeholder="<?php esc_html_e('Email *','bebostore')?>" type="text" name="txt-email" class="beau-input txt-contact">
					<input id="beau-last-name"  placeholder="<?php esc_html_e('Last Name *','bebostore')?>" type="text" name="txt-lastname" class="beau-input txt-contact">
					<input id="beau-website"  placeholder="<?php esc_html_e('Website','bebostore')?>" type="text" name="txt-website" class="beau-input txt-contact">
					<textarea id="beau-message"  placeholder="<?php esc_html_e('Your message.','bebostore')?>" name="txt-message" class="beau-input txt-message"></textarea>
					<button type="button" name="btn-submit" class="contact-button book-button book-button-small book-button-active pull-right"><?php esc_html_e('Send','bebostore');?></button>
				</form>
			<?php else : 
				if($contact_id != NULL) {
			        echo do_shortcode('[contact-form-7 id="'.$contact_id.'" title="'.esc_html__('Contact','bebostore').'"]');
			    }
			    else  echo esc_html__('No Form Contact !', 'bebostore');
			endif;?>
			</div>

		</div><!--End form-contact-->

	</div>
</section><!--End book-contact-->
<?php } ?>
<?php
if ($option == 'horizontal') {
?>
<section class="book-contact full-column">
	<script type="text/javascript">
	    google.maps.event.addDomListener(window, 'load', init);
	    function init() {
	        var mapOptions = {
	            zoom: 16,
	            scrollwheel: false,
	            // mapTypeId: google.maps.MapTypeId.ROADMAP,
	            center: new google.maps.LatLng(<?php print($lat); ?>, <?php print($lng); ?>),
	            <?php if($style_map != 'default-google') : ?>
                	styles: <?php echo $map_style_data[$style_map]; ?>
				<?php endif; ?>
			};
	        var mapElement = document.getElementById('book-map-contact');
	        var map = new google.maps.Map(mapElement, mapOptions);
	        var marker = new google.maps.Marker({
	            position: new google.maps.LatLng(<?php print($lat); ?>, <?php print($lng); ?>),
	            map: map,
	            icon: "",
	            title: 'Map title'
	        });
	    }
	</script>
	<div class="book-map-address col-md-12 col-sm-12 col-xs-12">
		<div id="book-map-contact"></div>
	</div>
	<div class="container">
		<div class="col-md-12 col-sm-12 col-xs-12 book-form-contact">
			<div class="text-form-contact col-md-3 col-sm-3 col-xs-12">
				<div class="title-box"><span><?php print($title_contact); ?></span></div>
				<div class="book-address">
					<span class="book-place-name"><?php print($city_contact); ?></span>
					<span class="book-contact-add">
						<?php print($address_contact); ?><br>
						<?php print($phone_contact); ?><br>
						<?php print($email_contact); ?>
					</span>
				</div>
				<ul class="list-social no-border">
					<?php
						if (!$fb_contact =='') {
					?>
						<li><a href="<?php echo esc_url($fb_contact); ?>"><i class="fa fa-facebook"></i></a></li>
					<?php } ?>
					<?php
						if (!$twitter_contact =='') {
					?>
						<li><a href="<?php echo esc_url($twitter_contact); ?>"><i class="fa fa-twitter"></i></a></li>
					<?php } ?>
					<?php
						if (!$rss_contact =='') {
					?>
						<li><a href="<?php echo esc_url($rss_contact); ?>"><i class="fa fa-rss"></i></a></li>
					<?php } ?>
					<?php
						if (!$google_contact =='') {
					?>
						<li><a href="<?php echo esc_url($google_contact); ?>"><i class="fa fa-google-plus"></i></a></li>
					<?php } ?>
					<?php
						if (!$flick_contact =='') {
					?>
						<li><a href="<?php echo esc_url($flick_contact); ?>"><i class="fa fa-flickr"></i></a></li>
					<?php } ?>

				</ul>


			</div>
			<div class="form-content form-contact2 col-md-8 col-sm-8 col-xs-12 pull-right">
				<div class="contact-content">
					<?php print($content); ?>
				</div>
				<?php if($contact7 != 'yes') :?>
				<form action="" class="book-contact-form col-md-8 col-sm-8 col-xs-12">
					<div class="success-form-message"><?php esc_html_e('Success & Error message','bebostore');?></div>
					<input id="beau-first-name"  placeholder="<?php esc_html_e('First Name *','bebostore')?>" type="text" name="txt-firstname" class="beau-input txt-contact">
					<input id="beau-email"  placeholder="<?php esc_html_e('Email *','bebostore')?>" type="text" name="txt-email" class="beau-input txt-contact">
					<input id="beau-last-name"  placeholder="<?php esc_html_e('Last Name *','bebostore')?>" type="text" name="txt-lastname" class="beau-input txt-contact">
					<input id="beau-website"  placeholder="<?php esc_html_e('Website','bebostore')?>" type="text" name="txt-website" class="beau-input txt-contact">
					<textarea id="beau-message"  placeholder="<?php esc_html_e('Your message.','bebostore')?>" name="txt-message" class="beau-input txt-message"></textarea>
					<button type="button" name="btn-submit" class="contact-button book-button book-button-small book-button-active pull-right"><?php esc_html_e('Send','bebostore');?></button>
				</form>
				<?php else : 
					if($contact_id != NULL) {
				        echo do_shortcode('[contact-form-7 id="'.$contact_id.'" title="'.esc_html__('Contact','bebostore').'"]');
				    }
				    else  echo esc_html__('No Form Contact !', 'bebostore');
				endif;?>
			</div>

		</div><!--End form-contact-->

	</div>
</section><!--End book-contact-->
<?php } ?>
<?php
if ($option == 'vertical') {
?>
<section class="book-contact two-columns">
	<div class="container">
		<div class="col-md-6 col-sm-6 col-xs-12 book-form-contact">
			<div class="text-form-contact">

				<div class="title-box"><span><?php print($title_contact); ?></span></div>
				<div class="book-address">
					<span class="book-place-name"><?php print($city_contact); ?></span>
					<span class="book-contact-add">
						<?php print($address_contact); ?><br>
						<?php print($phone_contact); ?><br>
						<?php print($email_contact); ?>
					</span>
				</div>
				<ul class="list-social no-border">
					<?php
						if (!$fb_contact =='') {
					?>
						<li><a href="<?php echo esc_url($fb_contact); ?>"><i class="fa fa-facebook"></i></a></li>
					<?php } ?>
					<?php
						if (!$twitter_contact =='') {
					?>
						<li><a href="<?php echo esc_url($twitter_contact); ?>"><i class="fa fa-twitter"></i></a></li>
					<?php } ?>
					<?php
						if (!$rss_contact =='') {
					?>
						<li><a href="<?php echo esc_url($rss_contact); ?>"><i class="fa fa-rss"></i></a></li>
					<?php } ?>
					<?php
						if (!$google_contact =='') {
					?>
						<li><a href="<?php echo esc_url($google_contact); ?>"><i class="fa fa-google-plus"></i></a></li>
					<?php } ?>
					<?php
						if (!$flick_contact =='') {
					?>
						<li><a href="<?php echo esc_url($flick_contact); ?>"><i class="fa fa-flickr"></i></a></li>
					<?php } ?>

				</ul>

			</div>
			<div class="form-content">
				<div class="contact-content content-contact-3">
					<?php print($content); ?>
				</div>
				<?php if($contact7 != 'yes') :?>
				<form action="#" class="book-contact-form">
					<div class="success-form-message"><?php esc_html_e('Success & Error message','bebostore');?></div>
					<input id="beau-first-name"  placeholder="<?php esc_html_e('First Name *','bebostore')?>" type="text" name="txt-firstname" class="beau-input txt-contact">
					<input id="beau-email"  placeholder="<?php esc_html_e('Email *','bebostore')?>" type="text" name="txt-email" class="beau-input txt-contact">
					<input id="beau-last-name"  placeholder="<?php esc_html_e('Last Name *','bebostore')?>" type="text" name="txt-lastname" class="beau-input txt-contact">
					<input id="beau-website"  placeholder="<?php esc_html_e('Website','bebostore')?>" type="text" name="txt-website" class="beau-input txt-contact">
					<textarea id="beau-message"  placeholder="<?php esc_html_e('Your message.','bebostore')?>" name="txt-message" class="beau-input txt-message"></textarea>
					<button type="button" name="btn-submit" class="contact-button book-button book-button-small book-button-active pull-right"><?php esc_html_e('Send','bebostore');?></button>
				</form>
				<?php else : 
					if($contact_id != NULL) {
				        echo do_shortcode('[contact-form-7 id="'.$contact_id.'" title="'.esc_html__('Contact','bebostore').'"]');
				    }
				    else  echo esc_html__('No Form Contact !', 'bebostore');
				endif;?>
			</div>
		</div><!--End form-contact-->

		<script type="text/javascript">
		    google.maps.event.addDomListener(window, 'load', init);
		    function init() {
		        var mapOptions = {
		            zoom: 16,
		            scrollwheel: false,
		            // mapTypeId: google.maps.MapTypeId.ROADMAP,
		            center: new google.maps.LatLng(<?php print($lat); ?>, <?php print($lng); ?>),
		            <?php if($style_map != 'default-google') : ?>
	                	styles: <?php echo $map_style_data[$style_map]; ?>
					<?php endif; ?>
				};
		        var mapElement = document.getElementById('book-map-contact');
		        var map = new google.maps.Map(mapElement, mapOptions);
		        var marker = new google.maps.Marker({
		            position: new google.maps.LatLng(<?php print($lat); ?>, <?php print($lng); ?>),
		            map: map,
		            icon: "",
		            title: 'Map title'
		        });
		    }
		</script>
		<div class="book-map-address col-md-6 col-sm-6 col-xs-12">
			<div id="book-map-contact"></div>
		</div>
	</div>
</section><!--End book-contact-->
<?php } ?>
<script>
	(function($) {
		$('.contact-button').click(function(event) {
        $('html,body').click(function(){
            $('.success-form-message').removeClass('active');
            $('.contact-button').removeAttr('disabled');
            $('.contact-button').removeClass('success-form');
        });
        $('.contact-button').attr('disabled', 'disabled');
        $(this).addClass('loading');
        $.ajax({
            type: "POST",
            url: '<?php echo admin_url( "admin-ajax.php" ); ?>',
            data:$('.book-contact-form').serialize(),
            success: function(data){
                var sucCessme = '<?php esc_html_e('Your email has been sent successfully','bebostore');?>';
                if (data == 1) {
                    $('.beau-input').val('');
                    $('.success-form-message').removeClass('error').addClass('active').html(sucCessme);
                    $('.contact-button').removeClass('loading').addClass('success-form');
                }else{
                    $('.success-form-message').addClass('active error').html(data);
                    $('.contact-button').removeClass('loading');
                }
            }
        })
    });
})(jQuery);
</script>
