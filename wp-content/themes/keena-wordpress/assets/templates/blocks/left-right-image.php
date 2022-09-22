<?php
	$layout = get_sub_field( 'layout' );
?>

<div <?php binarym_bg_builder(); ?>>
	<?php binarym_bg_image(); ?>
	<?php
		$edge_to_edge = get_sub_field( 'edge_to_edge' );
		if ( $edge_to_edge && $edge_to_edge == false ) {
	?>
		<div class="container edge-to-edge-false">
	<?php } ?>

		<?php binarym_before_content_block(); ?>

		<div class="row no-gutters vertical-center layout-<?php echo $layout; ?>">
			<?php
				$content = get_sub_field( 'primary_content' );
				$image = get_sub_field( 'testimonial_image' )['sizes']['large'];
				$left_col_width = get_sub_field('column_width');
				$right_col_width = 12 - $left_col_width;
			?>

			<div class="left-right-block-column left-column col-md-<?php echo $left_col_width; ?>">

				<?php if ( $layout == 'img-left' ) { ?>
					<div class="img-cover" style="background-image: url( <?php echo $image; ?> );"></div>
				<?php } else { ?>
					<div class="content-wrap"><?php echo $content; ?></div>
				<?php } ?>

			</div><!-- .col -->

			<div class="left-right-block-column right-column col-md-<?php echo $right_col_width; ?>">

				<?php if ( $layout == 'img-right' ) { ?>
					<div class="img-cover" style="background-image: url( <?php echo $image; ?> );"></div>
				<?php } else { ?>
					<div class="content-wrap"><?php echo $content; ?></div>
				<?php } ?>

			</div><!-- .col -->
		</div><!-- .row -->

		<?php binarym_after_content_block(); ?>

	<?php if ( $edge_to_edge == false ) { ?>
		</div><!-- .container -->
	<?php } ?>

</div>
