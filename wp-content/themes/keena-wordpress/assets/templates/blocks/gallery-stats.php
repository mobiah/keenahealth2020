<div <?php binarym_bg_builder(); ?>>
	<div class="container">
		<!-- <?php
			binarym_before_content_block();
		?> -->
		<div class="row stat-items">
			<?php
				while ( have_rows('stats_content') ) : the_row();
				?>
					<?php
						if ( isset( $divider ) )
							echo '<div class="stat-divider"></div>';
						else
							$divider = true;
					?>

					<div class="stat-item">
						<span class="stat-value"><?php the_sub_field('stat'); ?></span>
						<span class="stat-description"><?php the_sub_field('label'); ?></span>
					</div>

				<?php

				endwhile;
			?>
		</div>
	</div>
	<?php binarym_block_ornament(); ?>
</div><!-- .stats-gallery -->
