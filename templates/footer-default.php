<?php 
 global $beau_option;
?>
<footer class="">
	<div class="top-footer">
		<div class="container">
			<div class="row">
				<?php
					global $beau_option;
					if (isset($beau_option['footer-widget-number'])) {
						$numshow = intval($beau_option['footer-widget-number']);
					}else{
						$numshow = 4;
					}

					$columns = intval(12/$beau_option['footer-widget-number']);
					if($numshow > 0){
						if (function_exists("dynamic_sidebar")) {
							for ($i=1; $i <= $numshow; $i++) {
								?>

								<div class="col-12 col-md-<?php echo $columns ?> ">
									<div class="row">
							
								<?php 
								if ( is_active_sidebar( 'sidebar-footer-'.$i ) ){
									dynamic_sidebar( 'sidebar-footer-'.$i );
								}
								?>
								</div>
								</div>
								<?php
							}
						}
					}
				?>
			</div>
		</div>
	</div><!--End top footer-->
</footer>
<div id="search-modal" class="modal modal-search" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<div class="modal-body">
				<form action="<?php echo esc_url(home_url( '/' ));?>" method="get">
					<input type="text" name="s" value="" placeholder="<?php esc_html_e('Search by title book', 'bebostore'); ?>">
					<input type="hidden" name="post_type" value="product" />
					<select name="product_types" class="custom-dropdown">
						<option value="" selected><?php esc_html_e('Product','bebostore'); ?> <i class="fa fa-chevron-down"></i></option>
						<?php
							if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
							$args = array(
								'orderby'   => 'title',
								'order'     => 'ASC',
								'hide_empty'          => FALSE,
							);
							$product_categories = get_terms( 'product_types', $args );
							$count = count($product_categories);
							if (class_exists('WC()')) {
								# code...
							}
							if ( $count > 0 ){
								foreach ( $product_categories as $product_category ) {
									echo '<option value="' .  $product_category->slug . '">' . $product_category->name . '</option>';
								}
							}
						}
						?>
					</select>
						<button type="submit">Search</button>
				</form>
			</div>
		</div>
	</div>
</div>