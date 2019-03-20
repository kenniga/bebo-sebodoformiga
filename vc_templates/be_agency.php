<?php
$title_box = $ipad_link = $iphone_link = $united_link = $united_kingdom = $japan_link = "";
extract(shortcode_atts(array(
    'title_box'			=> '',
    'ipad_link'			=> '',
    'iphone_link'		=> '',
    'united_link'		=> '',
    'united_kingdom'	=> '',
    'japan_link'		=> '',
), $atts));
?>
<div class="super-ftop col-md-12 col-sm-12 col-xs-12">
	<div class="content-ftop">
		<div class="app-list book-center">
			<ul class="list-link">
				<li><a href="<?php echo esc_url($ipad_link);?>"><?php esc_html_e('BOOK for iPad','bebostore');?></a></li>
				<li><img src="<?php echo get_template_directory_uri();?>/asset/images/iphone-ipad.png" alt="ipad"></li>
				<li><a href="<?php echo esc_url($iphone_link)?>"><?php esc_html_e('BOOK for iPhone','bebostore');?></a></li>
			</ul>
		</div>
		<div class="clearfix"></div>
		<div class="language-footer book-center">
			<div class="title-language"><?php printf('%s',$title_box);?></div>
			<div class="clearfix"></div>
			<ul class="list-lang book-center">
				<li><img src="<?php echo get_template_directory_uri();?>/asset/images/flag-us.png" alt="us"><a href="<?php echo esc_url($united_link)?>"><?php esc_html_e('United States','bebostore');?></a></li>
				<li><img src="<?php echo get_template_directory_uri();?>/asset/images/flag-uk.png" alt="uk"><a href="<?php echo esc_url($united_kingdom)?>"><?php esc_html_e('United Kingdom', 'bebostore');?></a></li>
				<li><img src="<?php echo get_template_directory_uri();?>/asset/images/flag-japan.jpg" alt="japan"><a href="<?php echo esc_url($japan_link)?>"><?php esc_html_e('Japan','bebostore');?></a></li>
			</ul>
		</div>
	</div>
</div>