<div <?php binarym_bg_builder(); ?>>
    <div class="container">
        <?php
			binarym_before_content_block();
		?>
        <div class="row">
            <div class="col-md">

                <?php
				$content_blocks = array( 'left_content', 'right_content' );
				$primary_content_width = get_sub_field('column_width');
				$count = 1;
				$reversed = get_sub_field('reversed');

				foreach( $content_blocks as $block ) {

					if ( $block == 'left_content' )
						$columns = $primary_content_width;
					else
						continue;

					// get potential offset & modify column width
					$offset = get_sub_field( $block . '_offset' );

					if ( $offset > 0 ) {
						$columns = $columns-$offset;

						$block_class = 'col-md-6';
					}

					if ( $reversed == 1 )
						$block_class .= ' order-md-last';
			?>

                <div class="left-right-item <?php echo $block_class; ?>">
                    <?php the_sub_field( $block ); ?>
                </div>
                <?php
					$reversed = 0;
				}
				?>



                <?php
				$career_types = array( 'full-time-employment-opportunities', 'contractor-opportunities');

				foreach( $career_types as $ctype ) {
				?>
                <div class="column-<?php echo $ctype; ?>">
                    <h4 class="career-type-title basic-btn basic-green">
                        <?php echo ucwords( str_replace('-', ' ', $ctype ) ); ?>
                    </h4>

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
								$excerpt = get_the_excerpt();
								$excerpt = substr($excerpt, 0, 200);
								$result = substr($excerpt, 0, strrpos($excerpt, ' '));
								?>

                    <div class="career">

                        <h5 class="job-title mb-0"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                        <p class="job-location">
                            <strong><?php echo get_post_meta( get_the_ID(), 'location', true ); ?></strong>
                        </p>
                        <?php echo '<p>' . $result . '...</p>';?>
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

$images = get_sub_field('careers_gallery');
$size = 'full'; // (thumbnail, medium, large, full or custom size)
if( $images ): ?>

            <div class="col-md">
                <div id="careers-collage">

                    <?php foreach( $images as $image ): ?>

                    <div class="careers-collage-img"
                        style="background-image:url(<?php echo esc_url($image['sizes']['large']); ?>);">
                    </div>

                    <?php endforeach; ?>
                    </ul>
                </div>


            </div>
            <?php endif; ?>

        </div>
        <?php
			binarym_after_content_block();
		?>
    </div>
    <?php binarym_block_ornament(); ?>
</div><!-- .gallery -->