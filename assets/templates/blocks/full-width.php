<div <?php binarym_bg_builder(); ?>>
	<div class="container">
		<div class="row justify-content-<?php the_sub_field('block_alignment'); ?>">
			<div class="col-md-<?php the_sub_field( 'content_width' ); ?>">
				<?php the_sub_field('primary_content'); ?>
			</div>
		</div>
	</div>
	<?php binarym_block_ornament(); ?>
</div>
