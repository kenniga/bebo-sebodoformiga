<?php
$popup_target = $popup_title = $popup_image = "";
extract(shortcode_atts(array(
    'popup_target'			=> '',
    'popup_title'			=> '',
    'popup_image'			=> '',
), $atts));

?>

<div class="sc-popup-register modal fade " id="<?php echo esc_attr( $popup_target ); ?>" tabindex="-1" role="dialog"
	aria-labelledby="<?php echo esc_attr( $popup_target ); ?>" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<div class="modal-body d-flex align-items-center">
				<div class="row flex-fill align-items-center">
					<div class="col-xs-12 col-md-6 text-center">
						<h3>
							<?php esc_html_e( $popup_title ); ?>
						</h3>
						<?php 
						if ( !empty( $popup_image ) ) { 
							echo '<img src="' . wp_get_attachment_image_src( $popup_image, 'medium' )[0] .  '  " class="img-responsive" />'; 
						}  ?>
					</div>
					<div class="col-xs-12 col-md-6">
						<div id="mc_embed_signup">
							<form
								action="https://gmail.us20.list-manage.com/subscribe/post?u=b6f246e8b345782bb0393197a&amp;id=d97b65f9ae"
								method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form"
								class="validate" target="_blank" novalidate>
								<div id="mc_embed_signup_scroll">
									<div class="indicates-required">
										<span>
											wajib diisi
											<span class="asterisk">*</span> 
										</span>
									</div>
									<div class="mc-field-group form-group row justify-content-end">
										<label for="mce-NAME" class="col-md-4 col-form-label">
											<span>
												Nama Lengkap <span class="asterisk">*</span>
											</span>
										</label>
										<div class="col-sm-8">
											<input type="text" value="" name="NAME" class="required form-control" id="mce-NAME">
										</div>
									</div>
									<div class="mc-field-group form-group row justify-content-end">
										<label for="mce-EMAIL" class="col-md-4 col-form-label">
										<span>
											Email 
											<span class="asterisk">*</span>
										</span>	
										</label>
										<div class="col-md-8">
											<input type="email" value="" name="EMAIL" class="required email form-control" id="mce-EMAIL">
										</div>
									</div>
									<div class="mc-field-group form-group row">
										<label for="mce-SCHOOL" class="col-md-4 col-form-label">Asal Sekolah </label>
										<div class="col-md-8">
											<input type="text" value="" name="SCHOOL" class="form-control" id="mce-SCHOOL">
										</div>
									</div>
									<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
									<div style="position: absolute; left: -5000px;" aria-hidden="true"><input
											type="text" name="b_b6f246e8b345782bb0393197a_d97b65f9ae" tabindex="-1"
											value=""></div>
									<div class="form-group-row">
									<div class="col-md-8 offset-md-4">
										<input type="submit" value="Submit" name="subscribe"
											id="mc-embedded-subscribe" class="button"></div>
									</div>
									<div id="mce-responses" class="clear">
										<div class="response" id="mce-error-response" style="display:none"></div>
										<div class="response" id="mce-success-response" style="display:none"></div>
									</div>
								</div>
							</form>
						</div>
						<script type='text/javascript'
							src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script>
						<script type='text/javascript'>
							(function ($) {
								window.fnames = new Array();
								window.ftypes = new Array();
								fnames[1] = 'NAME';
								ftypes[1] = 'text';
								fnames[0] = 'EMAIL';
								ftypes[0] = 'email';
								fnames[2] = 'SCHOOL';
								ftypes[2] = 'text';
							}(jQuery));
							var $mcj = jQuery.noConflict(true);
							/**
								To customize your embedded form validation messages, place this code before the closing script tag.
							*/
							$mcj.extend($mcj.validator.messages, {
								required: "Wajib diisi.",
								email: "Format email kurang tepat."
							});
						</script>
						<!--End mc_embed_signup-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>