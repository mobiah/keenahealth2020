<div class="post-preview-search border-bottom p-5">
	<div class="row">
		<div class="col-12 col-md-8">
			<h4><?php echo keena_parent_item( get_the_ID() ); ?></h4>
			<h2 class="post-title">
				<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
				</a>
			</h2>
			<div class="post-body">
				<?php the_excerpt(); ?>
			</div>
		</div>
	</div>
</div>
