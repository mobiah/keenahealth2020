<?php
	get_header();
?>

<div class="container">
	<div class="row">
		<div class="col-12 col-md-3">
			<?php get_sidebar(); ?>
		</div>
		<div class="col-12 col-md-9">
			<div id="post-list" class="post-list">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'assets/templates/post', 'preview' ); ?>
				<?php endwhile; ?>
			</div>
			<div class="py-5">
				<?php echo get_next_posts_link('Load More'); ?>
			</div>
		</div>
	</div>
</div>

<?php
	get_footer();
