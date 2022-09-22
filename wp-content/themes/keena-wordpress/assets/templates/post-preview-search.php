<?php
	$read_more = keena_read_more( get_the_ID() );
?>
<div class="post-preview-search">
	<div class="row">
		<div class="col-12">
			<h6 class="post-parent"><?php echo keena_parent_item( get_the_ID() ); ?></h6>
			<h2 class="post-title">
				<a href="<?php echo $read_more['link']; ?>">
					<?php the_title(); ?>
				</a>
			</h2>
			<div class="post-body">
				<?php the_excerpt(); ?>
			</div>
		</div>
	</div>
</div>
