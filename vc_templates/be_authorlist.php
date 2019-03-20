<?php
$title_box = $perpage = "";
extract(shortcode_atts(array(
    'title_box'		=> '',
    'perpage'		=> '',

), $atts));
$args = array(
	'post_type' 		=> 'authorbook',
	'posts_per_page' 	=> $perpage,
);
$loop = new WP_Query( $args);
wp_reset_postdata();
?>
<!-- List author -->
<div class="list-author-name list-author-full">
<?php if ($title_box): ?>
	<div class="title-box title-feature">
		<span><?php print($title_box);?></span>
	</div>
<?php endif ?>
	<div class="list-name-author">

		<?php if ($loop->have_posts()) {?>
		<ul class="list-author-name">
			<?php while ($loop->have_posts()) { $loop ->the_post();?>
			<?php
				$author_avatar = get_post_meta( get_the_ID(),'_beautheme_type_image', TRUE);
				// $authorAvatar_ID 	= beau_get_attachment_id_from_url($author_avatar);
				// $author_avatar 		= wp_get_attachment_image( $authorAvatar_ID );
				if (!$author_avatar) {
					$author_avatar = '<img src="http://placehold.it/120x120" alt="No author avatar">';
				} else {
                    $author_avatar = '<img src="'.$author_avatar.'" alt="No author avatar">';
                }
			?>
			<li class="col-sm-6 col-xs-6">
				<a href="<?php echo esc_url(the_permalink()); ?>"><?php printf('%s',$author_avatar);?></a>
				<?php the_title('<p>', '</p>', TRUE ); ?>
			</li>
		<?php }?>
		</ul>
		<?php }?>
	</div><!--End author-list-avatar-->
</div>
