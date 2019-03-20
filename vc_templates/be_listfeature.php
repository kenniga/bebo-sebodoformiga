<?php
// This section show three feature with icon in SVG
$title_service = $icon_type = $desc_service = $service_type = "";
$icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypo = $icon_linecons = '';
$service_icon = '';
extract(shortcode_atts(array(
    'title_service'	=> '',
    'icon_type'		=> '',
    'desc_service'		=> '',
    'icon_fontawesome' => '',
	'icon_openiconic' 	=> '',
	'icon_typicons' 	=> '',
	'icon_entypo' 		=> '',
	'icon_linecons' 	=> '',
	'service_icon'		=> '',
	'service_type'		=> '',
), $atts));
//Get info of this book
?>
<?php if ($service_type != 'show-only-icon') {?>
<div class="service-item col-md-12 col-sm-12 col-xs-12">
	<i class="be <?php printf('%s', $service_icon); ?>"></i>
	<div class="clearfix"></div>
	<div class="service-title"><?php printf('%s', $title_service);?></div>
	<div class="service-desc"><?php printf('%s', $desc_service);?></div>
</div><!--End service-item-->
<?php }?>
<?php if ($service_type == 'show-only-icon') {?>
<div class="service-fitem col-md-12 col-sm-12 col-xs-12">
	<i class="be <?php printf('%s', $service_icon); ?>"></i>
	<span class="text-service"><?php printf('%s', $title_service);?></span>
</div>
<?php }?>


