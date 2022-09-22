<?php
	get_header();
?>
<div class="container">
	<div class="row">
		<div class="col-12 py-5">
			<?php while ( have_posts() ) : the_post(); ?>
				<h1 class="page-title"><?php the_title(); ?></h1>
				<div class="page-body">
					<?php the_content(); ?>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
</div>

<?php
	get_footer();
