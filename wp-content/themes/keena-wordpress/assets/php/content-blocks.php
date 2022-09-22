<?php

	// add_filter('acf/load_field/name=background_color', function( $input ) {

	// 	$input['choices'] = apply_filters('bm_background_colors', array(
	// 		'default' => 'Default',
	// 		'light-grey' => 'Light Grey',
	// 		'dark-grey' => 'Dark Grey',
	// 		'brand-primary' => 'Brand: Primary',
	// 		'brand-secondary' => 'Brand: Secondary',
	// 	) );

	// 	return $input;

	// });

	add_action( 'acf/render_field', function( $field ) {

		$helper_text = '';

		switch( $field['_name'] ):
			case 'left_content_offset':
				$helper_text = 'Reduces left content width at larger breakpoints and moves content to the right.';
				break;
			case 'right_content_offset':
				$helper_text = 'Reduces right content width at larger breakpoints and moves content to the right.';
				break;
			case 'padding':
				$helper_text = 'The amount of empty space at the top & bottom of this block.';
				break;
			case 'content_width':
				$helper_text = 'Reduce the width of the content in this block.';
				break;
			case 'gallery_type':
				$helper_text = 'Images Only - Images are displayed at 100% width and horizontally centered.<br>Images &amp; Copy - Images are displayed at a reduced width and aligned to the top of the element.';
				break;
			case 'block':
				// this filter runs twice on the "block" field because it uses a "select" and "post_object" type
				// this makes sure it only runs once.
				if ( $field['type'] == 'select' )
					$helper_text = 'Select which reusable block element you would like to include within this page\'s content. All blocks from that will be added into this location.';
				break;
		endswitch;

		if ( !empty( $helper_text ) )
			echo  '<p>'.$helper_text.'</p>';

	}, 10, 1 );

	add_filter( 'acf/prepare_field/name=block_type', function( $field ) {

		if ( get_post_type() == 'block' ) {
			// prevent including blocks in blocks.
			unset( $field['choices']['block'] );
		}

		return $field;
	} );

	add_action( 'init', function() {

		register_post_type(
			'block',
			array(
				'label' => 'Blocks',
				'labels' => array(
					'name' => 'Blocks',
					'singular_name' => 'Reusable Blocks',
					'not_found' => 'No blocks found',
					'add_new' => 'Add new block',
					'add_new_item' => 'Add New Block',
					'edit_item' => 'Edit Reusable Block',
					'new_item' => 'New Reusable Block',
					'view_item' => 'View Reusable Block'
				),
				'public' => false,
				'show_ui' => true,
				'menu_position' => 80,
				'hierarchical' => false,
				'exclude_from_search' => true,
				'menu_icon' => 'dashicons-align-left',
				'supports' => array(
					'title'
				)
			)
		);

	} );

	add_filter( 'acf/load_field/key=field_5d20170d3bbb7', function( $field ) {
		$field['choices'] = array(
	        'primary' => 'Primary',
	        'secondary' => 'Secondary',
	        'success' => 'Success',
	        'warning' => 'Warning',
	        'danger' => 'Danger',
	        'info' => 'Info',
	        'light' => 'Light',
	        'dark' => 'Dark'
	    );
	    return $field;
	});

	add_filter( 'acf/load_field/key=field_5d22a9dfe2f63', function( $field ) {
		$field['choices'] = array(
			'white' => 'White',
	        '100' => '100',
	        '200' => '200',
	        '300' => '300',
	        '400' => '400',
	        '500' => '500',
	        '600' => '600',
	        '700' => '700',
	        '800' => '800',
	        '900' => '900',
	        'black' => 'Black'
	    );
	    return $field;
	});

	// Social media select options
	add_filter( 'acf/load_field/key=field_5cd9b2adefdc2', function( $field ) {
		$field['choices'] = array(
			'facebook' => 'Facebook',
			'twitter' => 'Twitter',
			'linkedin' => 'LinkedIn',
			'yelp' => 'Yelp',
			'youtube' => 'Youtube',
			'instagram' => 'Instagram',
			'pinterest' => 'Pinterest',
	    );
	    return $field;
	});


	// function my_acf_load_field( $field ) {

	//     $field['choices'] = array(
	//         'primary' => 'Primary',
	//         'secondary' => 'Secondary',
	//         'success' => 'Success',
	//         'warning' => 'Warning',
	//         'danger' => 'Danger',
	//         'info' => 'Info',
	//         'light' => 'Light',
	//         'dark' => 'Dark'
	//     );

	//     return $field;

	// }
	// add_filter('acf/load_field/key=field_5d20170d3bbb7', 'my_acf_load_field');
