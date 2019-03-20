<?php
/*
* Template Name: Page author
*/
get_header();
$page_cover = get_post_meta(get_the_ID(), '_beautheme_archive_custom_cover', TRUE);
?>
<?php if ($page_cover):
$style  = ' style="background: url('.$page_cover.') no-repeat; background-size: cover;"';
?>
<section class="header-page header-author" <?php printf('%s', $style); ?>>
	<div class="container">
		<?php
		$args = array('post_type'=> 'authorbook','posts_per_page' => -1,);
		$loop = new WP_Query( $args);
		wp_reset_postdata();
		?>
		<div class="title-page"><?php echo get_the_title(); ?> <span>(<?php print($loop->post_count) ?>)</span></div>
	</div>
</section>
<?php endif;
get_template_part('templates/author', 'list');
the_content();
get_footer();
?>