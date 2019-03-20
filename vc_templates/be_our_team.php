<?php
$title_team = $number_team = "";
extract(shortcode_atts(array(
    'title_team' 			=> '',
    'number_team' 			=> '4'
), $atts));
?>
<section>
	<div class="container">
		<div class="our-team">
			<div class="title-box book-center"><span><?php print($title_team); ?></span></div>
			<div class="details-team">
			<?php
				$args = array(
					'post_type'=> 'team','posts_per_page' => $number_team,
				);
				$loop = new WP_Query( $args);
				wp_reset_postdata();
				?>
				<?php while ( $loop->have_posts() ) : $loop->the_post();?>
					<?php
					$team_avatar = get_post_meta( get_the_ID(),'_beautheme_type_image', TRUE);
					// $teamAvatar_ID 	= beau_get_attachment_id_from_url($team_avatar);
					// $team_avatar 		= wp_get_attachment_image( $teamAvatar_ID,'full');
					$team_job = get_post_meta( get_the_ID(),'_beautheme_team_job', TRUE);
					$team_fb = get_post_meta( get_the_ID(),'_beautheme_team_facebook', TRUE);
					$team_tt = get_post_meta( get_the_ID(),'_beautheme_team_twitter', TRUE);
					$team_gg = get_post_meta( get_the_ID(),'_beautheme_team_google', TRUE);
					if (!$team_avatar) {
						$team_avatar = '<img src="http://placehold.it/245x245" alt="No author avatar">';
					} else {
                        $team_avatar = '<img src="'.$team_avatar.'" alt="No author avatar">';
                    }

					?>
                    <?php
                        $single_class = 'col-lg-3 col-md-3 col-sm-3 col-xs-12';
                        $col = 12 / $number_team;
                        if($col >= 3) {
                            $single_class = 'col-lg-'.$col.' col-xs-12';
                        }
                    ?>
					<div class="<?php echo $single_class; ?>">
						<div class="person-team">
							<div class="img-team">
								<?php print($team_avatar); ?>
							</div>
							<div class="info-person">
								<div class="name"><?php the_title();?></div>
								<div class="job"><?php print($team_job); ?></div>
								<div class="social">
									<ul>
										<?php if ($team_fb) {
										?>
										<li><a href="<?php echo esc_url($team_fb); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
										<?php
										} ?>
										<?php if ($team_tt) {
										?>
										<li><a href="<?php echo esc_url($team_tt); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
										<?php
										} ?>
										<?php if ($team_gg) {
										?>
										<li><a href="<?php echo esc_url($team_gg); ?>" target="_blank"><i class="fa fa-rss"></i></a></li>
										<?php
										} ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
            <div class="clearfix"></div>

		</div>
	</div>
</section>
