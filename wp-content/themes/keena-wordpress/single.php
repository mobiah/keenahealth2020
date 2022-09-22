<?php
	get_header();
	// the_post();

	$author_name = get_the_author_meta( 'display_name', $post->post_author );
	$author_bio = get_the_author_meta( 'description', $post->post_author );
	$author_image = get_field( 'profile_picture', 'user_' . $post->post_author );
	$author_position = get_field( 'job_title', 'user_' . $post->post_author );
	// $title = $item->post_title;
	// $excerpt = $item->post_excerpt;
?>

<div class="container pt-7 pb-6">
	<div class="row">
		<div class="col-md-8 pr-md-6">
			<?php while ( have_posts() ) : the_post(); ?>

				<div class="post-body">
					<?php
						// $experience = get_post_meta( get_the_ID(), 'experience', true );

						// if ( !empty( $experience ) ) {
						// 	echo '<span class="badge badge-info">' . $experience . '</span>';
						// }
					?>

					<div class="post-categories mb-3">

							<?php
								foreach( get_categories() as $category ) : ?>
								<!-- <a href="<?php echo get_category_link( $category->term_id ); ?>" class="badge badge-info"> -->
									<span class="badge badge-info"><?php echo $category->name; ?></span>
								<!-- </a> -->
							<?php endforeach; ?>
						</div>

					<?php the_content(); ?>


					<div class="post-meta py-5">
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
								<div class="author-bio mt-3">
									<?php echo $author_bio; ?>
								</div>
							</div>
						</div>
					</div><!-- .post-meta -->
				</div>

			<?php endwhile; ?>
		</div>

		<div class="sidebar col-md-4">

			<?php
				if ( is_active_sidebar( 'sidebar_widget_area_2' ) ) :
					dynamic_sidebar( 'sidebar_widget_area_2' );
				endif;
			?>

		</div>
	</div>
</div>

<?php
	get_footer();
