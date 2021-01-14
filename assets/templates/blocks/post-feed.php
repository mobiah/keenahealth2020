<div <?php binarym_bg_builder(); ?>>
	<div class="container">
		<div class="row justify-content-<?php the_sub_field('block_alignment'); ?>">
			<div class="col-md-<?php the_sub_field( 'content_width' ); ?>">
				<div class="row">
				<?php

					$cat = get_sub_field( 'category' );

					$posts = get_posts( array(
						'cat' => $cat->ID,
						'posts_per_page' => 3,
					));

					foreach ( $posts as $item ) :
						$author_name = get_the_author_meta( 'display_name', $item->post_author );
						$author_image = get_field( 'profile_picture', 'user_' . $item->post_author );
						$author_position = get_field( 'job_title', 'user_' . $item->post_author );
						$title = $item->post_title;
						$excerpt = $item->post_excerpt;
						$read_more = keena_read_more( $item->ID );

					?>
						<div class="col-lg">
							<div class="featured-post">
								<div class="badge badge-info"><?php echo $cat->name ?></div>
								<div class="author-group">
									<?php if ( $author_image ) : ?>
									<div class="author-image">
										<img src="<?php echo $author_image['sizes']['thumbnail']; ?>" alt="<?php echo $author_name; ?>&rsquo;s Avatar">
									</div>
									<?php endif; ?>
									<div class="author-details">
										<span class="author-name">By <?php echo $author_name; ?></span>
										<?php if ( $author_name ) : ?>
											<span class="author-position"><?php echo $author_position; ?></span>
										<?php endif ?>
									</div>
								</div>
								<h3 class="post-title"><a href="<?php echo $read_more['link']; ?>"><?php echo $title; ?></a></h3>
								<p class="post-excerpt"><?php echo $excerpt; ?></p>
								<p class="read-more">
									<a class="btn btn-link" href="<?php echo $read_more['link']; ?>"><?php echo $read_more['text']; ?></a>
								</p>
							</div>
						</div>
					<?php endforeach; ?>
				</div><!-- .row -->
			</div>
		</div>
	</div>
	<?php binarym_block_ornament(); ?>
</div>
