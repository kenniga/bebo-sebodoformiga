<?php
$class_thumb = $class_item = "";
$lengthExc = 15;
if ($page_setting == 'one-column-full' || $page_setting == 'default' || $page_setting == 'one-column-leftsidebar' || $page_setting == 'one-column-rightsidebar') {
	$class_thumb =" col-md-6 col-sm-6 col-xs-12";
	$class_item  =" col-md-12 col-sm-12 col-xs-12";
	if ($page_setting == 'one-column-rightsidebar') {
		$class_item .=" rightbar-item";
	}
}elseif ($page_setting == 'three-columns-masory') {
	$class_thumb = "";
	$lengthExc = 15;
}elseif ($page_setting == 'two-columns-rightsidebar' || $page_setting == 'two-columns-leftsidebar') {
	$class_item  =" col-md-6 col-sm-6 col-xs-12";
	$class_thumb = "";
	$lengthExc = 0;
	if ($i%2==0) {
		$class_item .=" item-even";
	}else{
		$class_item .=" item-odd";
	}
}elseif($page_setting == 'three-columns-full' || $page_setting == 'three-columns-rightsidebar'){
	$class_item = ' col-md-4 col-sm-4 col-xs-12';
	$class_thumb = "";
	$lengthExc = 0;
}
?>

<div id="post-<?php the_ID();?>" <?php post_class("blog-items".$class_item); ?>>
	<a href="<?php echo esc_url( get_the_permalink());?>" class="news-thumbs <?php printf('%s', $class_thumb);?>">
		<?php if (is_sticky()): ?>
        <i class="sticky-note"><?php _e('Sticky','bebostore')?></i>
        <?php endif ?>
		<?php
		if (has_post_thumbnail( get_the_ID())) {
			printf('%s',get_the_post_thumbnail(get_the_ID(), 'bebostore-thumbnail'));
		}else{?>
		<?php if ($page_setting != 'three-columns-masory') {?>
		<img src="http://placehold.it/525x340" alt="<?php esc_html_e('No image','bebostore')?>">
		<?php }?>
		<?php }?>
	</a>
	<span class="news-description <?php printf('%s', $class_thumb);?>">
		<a href="<?php echo esc_url(get_the_permalink());?>" class="news-title"><?php the_title();?></a>
		<?php
		if ($lengthExc) {
		?>
			<div class="short-desc">
				<?php if (function_exists('bebostore_excerpt')) {
					echo bebostore_excerpt($lengthExc);
				}
				else{
					echo the_excerpt();
				}
				?>
			</div>
		<?php }?>
	</span>
</div><!--End blog-items-->
