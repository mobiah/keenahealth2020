<div <?php binarym_bg_builder(); ?>>
	<div class="container">
		<?php
			binarym_before_content_block();
		?>
		<div class="row gallery-items">
			<?php

				if ( get_sub_field('gallery_border') == 1 )
					$extra_class = ' border-right';
				else
					$extra_class = '';

				while ( have_rows('gallery_contents') ) : the_row();
				?>
					<div class="col-md gallery-item gallery-item-<?php echo get_row_index() . $extra_class; ?>">
						<div class="gallery-text">
							<?php the_sub_field('column_content'); ?>
						</div>
					</div>
					<?php
					endwhile;
				?>

		</div><!-- .gallery-items -->
		<?php
			binarym_after_content_block();
		?>
	</div>
	<?php binarym_block_ornament(); ?>
</div><!-- .gallery -->
