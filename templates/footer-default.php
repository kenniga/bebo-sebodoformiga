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
					if($numshow > 0){
						if (function_exists("dynamic_sidebar")) {
							for ($i=1; $i <= $numshow; $i++) {
								if ( is_active_sidebar( 'sidebar-footer-'.$i ) ){
									dynamic_sidebar( 'sidebar-footer-'.$i );
								}
							}
						}
					}
				?>
			</div>
		</div>
	</div><!--End top footer-->
</footer>
