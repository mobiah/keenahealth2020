<div <?php binarym_bg_builder(); ?>>
	<div class="container">
		<?php binarym_before_content_block(); ?>
		<div class="row<?php echo ( get_sub_field('vertical_centered') == 1 ? ' d-flex align-items-center' : '' ); ?>">
			<?php
				$reversed = get_sub_field('reversed');
				$content_blocks = array( 'left_content', 'right_content' );
				$primary_content_width = get_sub_field('column_width');
				$count = 1;

				if ( $reversed == 1 )
					$content_blocks = array_reverse( $content_blocks );

				foreach( $content_blocks as $block ) {

					if ( $block == 'left_content' )
						$columns = $primary_content_width;
					else
						$columns = 12-$primary_content_width;

					// set default column widths
					$block_class = 'col-md';
					$block_class .= ' col-lg-' . $columns;
					$block_class .= ' left-right-content-' . $count;
					$count++;

					// get potential offset & modify column width
					$offset = get_sub_field( $block . '_offset' );

					if ( $offset > 0 ) {
						$columns = $columns-$offset;

						$block_class = 'col-md-'. $columns . ' offset-md-' . $offset;
					}

					if ( $reversed == 1 )
						$block_class .= ' order-md-last';
					?>

					<div class="left-right-item <?php echo $block_class; ?>">
						<?php the_sub_field( $block ); ?>
					</div>
					<?php
					$reversed = 0;
				}
			?>
		</div>
		<?php binarym_after_content_block(); ?>
	</div>
	<?php binarym_block_ornament(); ?>
</div>
