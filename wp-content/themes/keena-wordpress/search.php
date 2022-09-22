<?php
	get_header();
?>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-10">
			<div id="post-list" class="post-list search-results">
				<?php
					if ( have_posts() ):

						while ( have_posts() ) : the_post();
							get_template_part( 'assets/templates/post-preview', 'search' );
						endwhile;

					else:

						$search_value = keena_search_value();

						if ( empty( $search_value ) )
							$search_message = 'Search for something.';
						else
							$search_message = 'Sorry, nothing found for ' . $search_value;
					?>
						<h1>Search</h1>
						<p><?php echo $search_message; ?>
					<?php
					endif;
				?>
			</div>
			<div class="load-more-btn">
				<?php echo get_next_posts_link('Load More'); ?>
			</div>
		</div>
	</div>
</div>

<?php
	get_footer();
