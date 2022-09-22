<?php

	$row_count = 0;

	function binarym_block_builder() {

		global $row_count;

		if ( have_rows('content_block') ):

			while ( have_rows('content_block') ) : the_row();

				get_template_part( 'assets/templates/blocks/' . get_sub_field( 'block_type' ) );
				$row_count++;

			endwhile;
		else :
			echo '<p>Content unavailable, try again later.</p>';
		endif;

	}

	// i'm pretty meh on this but it gets the job done....
	// should we refactor or just live with it?

	// I think for our custom builds this works great.
	// If we need to use existing front-end code (like a Bootstrap theme) we may need to turn this stuff into
	// raw data (array probs) and pass it to the templates to output these settings individually wherever makes sense.
	function binarym_bg_builder() {

		// Adding an okayish way to apply IDs to blocks. Downside is the ID will change if blocks are rearranged.
		// Using to target blocks with special style requirements...at least until we figure out something better.
		echo 'id="' . get_sub_field('block_type') . '-' . get_row_index() . '" ';

		echo 'class="binarym-block ';

		echo get_sub_field('block_type');

		if ( get_sub_field( 'set_top_bottom_padding' ) == 1 ) {

			echo ' pt-' . get_sub_field( 'top_padding' );
			echo ' pb-' . get_sub_field( 'bottom_padding' );

		} else
			echo ' py-' . get_sub_field('padding');

		if ( get_row_index() == 1 && get_sub_field( 'set_top_bottom_padding' ) != 1 )
			echo ' pt-7';

		if ( get_sub_field('light_text') == 1 )
			echo ' text-white';


		if ( get_sub_field('block_type') == 'gallery' ) {

			$gallery_type = get_sub_field('gallery_type');

			if ( !empty( $gallery_type ) )
				echo ' icon-gallery';
			else
				echo ' image-gallery';

		}

		echo '"'; // close `class` attribute.

		$background_color = get_sub_field( 'background_color' );
		$background_image = get_sub_field( 'background_image_upload' );

		if ( !empty( $background_color ) || !empty( $background_image ) ) {
			echo ' style="';

			if ( !empty( $background_color ) )
				echo 'background-color: ' . $background_color . ';';

			if ( !empty( $background_image ) )
				echo 'background-image: url(' . wp_get_attachment_url( $background_image ) . ');';

			echo '"'; // close `style` attribute.
		}

	}

	function binarym_block_ornament() {

		if ( get_sub_field( 'add_block_ornament' ) != 1 )
			return;


		$background_color = get_sub_field( 'background_color' );

		if ( empty( $background_color ) )
			$background_color = '#ffffff';

		echo '<div class="block-ornament" style="color: ' . $background_color . '"></div>';

	}

	function binarym_bg_image() {

		$bg_image_id = get_sub_field( 'background_image_upload' );

		if ( $bg_image_id > 0 ) {

			$bg_image = wp_get_attachment_image_src( $bg_image_id , 'full' );
			$bg_opacity = get_sub_field( 'background_image_opacity' )/100;
		?>
			<div class="bg-image-container" style="background-image: url(<?php echo $bg_image[0]; ?>);opacity: <?php echo $bg_opacity; ?>"></div>
		<?php
		}
	}

	// function binarym_content_bg_builder( $return = false ) {

	// 	if ( $return == true )
	// 		ob_start();

	// 	$bg_color = get_sub_field('content_background_color');
	// 	$bg_image = get_sub_field('content_background_image');

	// 	if ( isset( $bg_color ) && !empty( $bg_color ) )
	// 		echo ' bg-' . $bg_color;

	// 	if ( isset( $bg_image ) && !empty( $bg_image ) )
	// 		echo ' bg-' . $bg_image;

	// 	if ( $return == true )
	// 		return ob_get_clean();

	// }

	function binarym_before_content_block() {

		$before_content = get_sub_field('above_content_block');

		$content_width = get_sub_field( 'content_width' );

		if ( $content_width < 12 ):
		?>

		<div class="row justify-content-<?php the_sub_field('block_alignment'); ?>">
			<div class="col-md-<?php echo $content_width; ?>">

		<?php
		endif;

		if ( !empty( $before_content ) ):
		?>
		<div class="row">
			<div class="col-12">
				<?php echo $before_content; ?>
			</div>
		</div>
		<?php
		endif;
	}

	function binarym_after_content_block() {

		$after_content = get_sub_field('below_content_block');

		if ( !empty( $after_content ) ):
		?>
		<div class="row">
			<div class="col-12">
				<?php echo $after_content; ?>
			</div>
		</div>
		<?php
		endif;

		$content_width = get_sub_field( 'content_width' );

		if ( $content_width < 12 ):
		?>

			</div><!-- .col-$content_width -->
		</div><!-- .row -->

		<?php
		endif;
	}
