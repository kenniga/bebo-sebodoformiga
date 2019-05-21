<?php 
 global $beau_option;
?>
<footer class="">
	<div class="top-footer">
		<div class="container">
			<div class="row">
				<?php
					global $beau_option;
					sebodo_debug($beau_option['footer-widget-number']);
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
