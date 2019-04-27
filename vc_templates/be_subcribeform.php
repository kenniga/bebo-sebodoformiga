<?php
$subcribe_title = $subcribe_description = $subcribe_type = '';
extract(shortcode_atts(array(
    'subcribe_title' => '',
    'subcribe_type' => '',
    'subcribe_description' => '',
), $atts));
?>
<?php if ($subcribe_type == 'ahalf'): ?>
<div class="subcribe-half col-md-12 col-sm-12 col-xs-12">
	<div class="form-subcrible col-md-8 col-sm-8 col-xs-12 pull-left">
		<div class="subcribe-message-title">
			<span class="subcribe-title"><?php printf('%s', $subcribe_title)?></span>
			<span class="subcribe-message"><?php printf('%s', $subcribe_description)?></span>
		</div><!--Subcribe message-->
		<div class="book-subcribe-form">
			<form method="post" id="bookstore-subcribe" class="book-short-form bebostore-subcribe">
				<input type="email" name="email-subcribe" class="txt-subcrible-text" id="mc4wp_email"  value="" placeholder="<?php esc_html_e('Email address', 'bebostore')?>">
				<input type="submit" name="book-btn-subcribe" value="<?php esc_html_e('Go','bebostore')?>">
			</form>
		</div><!--End book-subcribe-form-->
	</div><!--End form-subcribe-->
</div><!--End mc4wp-form-1-->
<?php endif ?>

<?php if ($subcribe_type == 'full_layout' || $subcribe_type != 'ahalf'):?>
<div class="sc-subscribe-form subcribe-half col-md-12 col-sm-12 col-xs-12">
	<div class="form-subcrible col-md-8 col-sm-8 col-xs-12 pull-left">
		<div class="subcribe-message-title">
			<span class="subcribe-title"><?php printf('%s', $subcribe_title)?></span>
			<span class="subcribe-message"><?php printf('%s', $subcribe_description)?></span>
		</div><!--Subcribe message-->
		<div class="book-subcribe-form">
			<div id="bookstore-subcribe" class="bebostore-subcribe">
				<?php if( function_exists( 'mc4wp_show_form' ) ) {
					mc4wp_show_form();
				} ?>
			</div>
		</div>
	</div>
</div>
	<script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/b6f246e8b345782bb0393197a/4c3214fc56231265b89097bb9.js");</script>
<?php endif?>