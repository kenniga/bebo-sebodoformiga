<?php
$short_title = $title_paragraph = $style_padding = $maxheight = $small_image = $big_image = $style = "";
extract(shortcode_atts(array(
    'short_title' 		=> '',
    'title_paragraph' 	=> '',
    // 'content' => '',
    'maxheight' 		=>'',
    'small_image' 		=>'',
    'big_image' 		=>'',
    'style_padding' 	=>'',
), $atts));
// $have_image = $image1.$image2;
if ($maxheight) { $style = 'style="max-height:'.intval($maxheight).'px"';}
?>
<div class="section-blog-detail section-landing-view blogs-detail-full no-border">
	<div class="left-cols book-center col-md-8 col-sm-11 col-xs-12">
		<div class="page-blogs-grid blogs-detail section-landing-view">
			<div class="news-title"><?php printf('%s',$title_paragraph);?></div>
			<div class="news-content no-border <?php printf('%s', $style_padding)?>">
				<p><?php printf('%s', $content);?></p>
				<?php
					if ($small_image || $big_image) {
					$ima1 = wp_get_attachment_image_src($small_image,'images-history');
					$ima2 = wp_get_attachment_image_src($big_image,'images-history1');
				?>
				<div class="images-absolute">
					<img class="imgleft col-xs-12" src="<?php printf('%s', $ima1[0])?>" alt="<?php printf('%s', $ima1[1])?>">
					<img class="imgright col-xs-12" src="<?php printf('%s', $ima2[0])?>" alt="<?php printf('%s', $ima2[1])?>">
				</div><!--End images-absolute-->
				<?php }?>
			</div><!--End news-content-->
		</div><!--End blog-list-->
	</div><!--End left-cols-->
</div><!--End section-blog-detail-->