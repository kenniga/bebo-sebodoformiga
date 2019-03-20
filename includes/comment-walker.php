<?php
/** COMMENTS WALKER */
// return;
if (!class_exists('beau_Theme_walker_comment')) {
	class beau_Theme_walker_comment extends Walker_Comment {

		// init classwide variables
		var $tree_type = 'comment';
		var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );
		function __construct() { ?>

			<!-- <h3 id="comments-title">Comments</h3> -->
		<div class="main-comment">

		<?php }

		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$GLOBALS['comment_depth'] = $depth + 1; ?>
			<div class="sub-comment">
		<?php }

		/** END_LVL
		 * Ends the children list of after the elements are added. */
		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$GLOBALS['comment_depth'] = $depth + 1; ?>
			</div>
		<?php }

		/** START_EL */
		function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0) {
			$depth++;
			$add_below ="";
			$GLOBALS['comment_depth'] = $depth;
			$GLOBALS['comment'] = $comment;
			$parent_class = ( empty( $args['has_children'] ) ? 'main-comment' : '' );

			$reply_args = array(
				'add_below' => $add_below,
				'depth' => $depth,
				'max_depth' => $args['max_depth'] );
		?>
			<div class="title-comment">
				<span class="comment-name"><?php echo get_comment_author_link(); ?></span>
				<span class="comment-posted-in"><?php esc_html_e('Posted','bebostore')?> <?php comment_date(); ?> <?php esc_html_e('at','bebostore') ?><?php comment_time(); ?>  &nbsp; <?php comment_reply_link( array_merge( $args, $reply_args ) );  ?></span>
			</div>
			<div id="comment-body-<?php esc_attr(comment_ID())?>" class="comment-body">
				<span class="comment-message comment" id="comment-content-<?php esc_attr(comment_ID()); ?>">
					<?php if( !$comment->comment_approved ) : ?>
					<em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.','bebostore')?></em>
					<?php else: ?>
					<div class="comment-body"><?php comment_text();?></div><!--End comment-body-->
					<?php endif; ?>
				</span>
				<div class="clearfix"></div>
			</div><!-- /.comment-body -->
		<?php }

		function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>
		<?php }

		/** DESTRUCTOR
		 * I just using this since we needed to use the constructor to reach the top
		 * of the comments list, just seems to balance out :) */
		function __destruct() { ?>

		</div><!-- /#comment-list -->

		<?php }
	}
}
?>