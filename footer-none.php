<?php
global $beau_option;
if (!function_exists('beau_pagination')) {
	wp_link_pages(array('before' => '<div class="pagination"><strong>'.esc_html__('Pages', 'bebostore').'</strong> : ', 'after' => '</div>', 'next_or_number' => 'number'));
}
edit_post_link(esc_html__('Edit '.get_post_type(), 'bebostore'), '<div class="edit-link">', '</div>');
?>

<?php if ($beau_option['enable_back_to_top'] != '1'): ?>
	<a href="#" class="back-to-top"></a>
<?php endif ?>

<?php wp_footer();?>
</body>
</html>
