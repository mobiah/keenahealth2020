<?php
	get_header();
?>
<div class="container pt-7 pb-6">
	<div class="row">
		<div class="col-md-8 pr-md-6">
			<?php while ( have_posts() ) : the_post(); ?>

				<div class="page-body">
					<?php
						$experience = get_post_meta( get_the_ID(), 'experience', true );

						if ( !empty( $experience ) ) {
							echo '<span class="badge badge-info">' . $experience . '</span>';
						}
					?>

					<?php the_content(); ?>

					<p class="pt-3 m-0"><a href="<?php echo esc_url( add_query_arg( 'ref', get_the_ID(), get_permalink( 304 ) ) ); ?>" class="btn btn-secondary d-block d-md-inline-block">Apply Now</a></p>
				</div>

			<?php endwhile; ?>
		</div>

		<div class="sidebar col-md-4">

			<?php
				if ( is_active_sidebar( 'sidebar_widget_area_1' ) ) :
					dynamic_sidebar( 'sidebar_widget_area_1' );
				endif;
			?>

		</div>
	</div>
</div>

<?php
	get_footer();
