<div <?php binarym_bg_builder(); ?>>
	<div class="container">
		<?php
			binarym_before_content_block();
		?>
		<div class="row">
			<?php
				$career_types = array( 'full-time', 'internship' );

				foreach( $career_types as $ctype ) {
				?>
					<div class="col-lg column-<?php echo $ctype; ?>">
						<h4 class="career-type-title"><?php echo ucwords( str_replace('-', ' ', $ctype ) ); ?> Openings</h4>

						<?php
							$openings = new WP_Query( array(
								'post_type' => 'career',
								'posts_per_page' => -1,
								'orderby' => 'post_title',
								'order' => 'asc',
								'meta_query' => array(
									array(
										'key' => 'type',
										'value' => $ctype
									)
								)
							) );

							if ( $openings->have_posts() ):
								while ( $openings->have_posts() ) : $openings->the_post();
								?>

								<div class="career">

									<h5 class="job-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
									<p class="job-location"><?php echo get_post_meta( get_the_ID(), 'location', true ); ?></p>
									<a class="job-link" href="<?php the_permalink(); ?>">Learn More</a>

								</div>

								<?php
								endwhile;
								wp_reset_postdata();
							else:
								echo '<p>Sorry, there are no openings at this time. Please check back again later.</p>';
							endif;
						?>
					</div>

				<?php
				}
			?>
		</div>
		<?php
			binarym_after_content_block();
		?>
	</div>
	<?php binarym_block_ornament(); ?>
</div><!-- .gallery -->
