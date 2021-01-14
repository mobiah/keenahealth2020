<?php
	$read_more = keena_read_more( get_the_ID() );
?>
<div class="post-preview border-bottom py-5">
	<div class="row">

		<?php if ( has_post_thumbnail() ) : ?>

		<div class="post-thumbnail col-12 col-md-4 mb-3 mb-md-0">
			<a href="<?php echo $read_more['link']; ?>">
				<?php the_post_thumbnail( 'medium', array( 'class' => 'img-fluid' ) ); ?>
			</a>
		</div>

		<?php endif; ?>

		<div class="col-12 col-md-8">
			<h2 class="post-title">
				<a href="<?php echo $read_more['link']; ?>">
					<?php the_title(); ?>
				</a>
			</h2>
			<div class="post-body">
				<?php the_excerpt(); ?>
			</div>
			<div class="post-footer">
				<a class="btn btn-primary" href="<?php echo $read_more['link']; ?>"><?php echo $read_more['text']; ?></a>
			</div>
		</div>
	</div>
</div>
