<?php
if ( post_password_required() ) {
	return;
}
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
?>
<?php if ( have_comments() ) : ?>
	<div class="comment-list no-border">
		<?php wp_list_comments( array(
	        'walker' 		=> new beau_theme_walker_comment,
	        'callback' 		=> null,
	        'end-callback' 	=> null,
	        'type' 			=> 'all',
	        'page' 			=> null,
	        'avatar_size' 	=> 50
	    ) ); ?>
	</div><!--End comment-list-->
<?php endif; // have_comments() ?>
<div class="book-comment-form">

	<?php
	global $current_user;
	wp_get_current_user();     
	echo get_avatar( $current_user->ID, 80 );
	comment_form(
		array(
	        'label_submit'	=>esc_html__('Submit comment','bebostore'),
	        'title_reply'	=>esc_html__('Leave a reply','bebostore'),
	        'comment_notes_before' =>'<ul class="list-input">',
		    'fields' => array(
	            'author' => '<li class="col-md-6 col-sm-6 col-xs-12 txt-input-1st"><input id="email" class="required  txt-form" name="email" type="text" placeholder="'.esc_html__('Email','bebostore').'' . ( $req ? '*' : '' ) .'" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' /></li>',
	            'email' => '<li class="col-md-6 col-sm-6 col-xs-12 txt-input-2nd">
	            <input id="author" class="required txt-form" name="author" placeholder="'.esc_html__('Name','bebostore').' '. ( $req ? '*' : '' ) .'" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' /></li>',
		    ),
		    'comment_field' => '<li class="col-md-12 col-sm-12 col-xs-12"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" class="required txt-form" placeholder="'.esc_html__('Message *','bebostore').'"></textarea></li></ul>',
				'comment_notes_after' => '',
				'logged_in_as' => ''
		)
	);
	paginate_comments_links();
	previous_comments_link();
	?>
	<?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>
</div>
