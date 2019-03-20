<?php
/*
* Template Name: Template Home 07
*/
get_header();
while ( have_posts() ) : the_post();
?>
<section>
	<div class="full-layout">
		<?php the_content(); ?>
	</div>
</section>
<?php
 endwhile;
get_footer();
?>