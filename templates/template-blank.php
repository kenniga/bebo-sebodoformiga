<?php
/*
* Template Name: Template blank
*/
get_header();
?>
<?php if( has_post_thumbnail() ) { ?>
<section class="bg-top">
	<?php echo get_the_post_thumbnail(); ?>
</section>
<?php } ?>
<?php
while ( have_posts() ) : the_post();
	the_content();
 endwhile;
?>
<?php
get_footer();
?>