<?php

	add_action( 'wp_enqueue_editor', function() {

		wp_deregister_script( 'wplink' );
		wp_register_script( 'wplink',  get_bloginfo('template_directory') . '/assets/admin/js/nofollow.js', array('jquery'), '1.07', 1 );
		wp_enqueue_script( 'wplink');

		wp_localize_script( 'wplink', 'wpLinkL10n', array(
			'title' => __('Insert/edit link'),
			'update' => __('Update'),
			'save' => __('Add Link'),
			'noTitle' => __('(no title)'),
			'labelTitle' => __( 'Title' ),
			'noMatchesFound' => __('No results found.'),
			'noFollow' => __(' Add <code>rel="nofollow"</code> to link', 'title-and-nofollow-for-links')
		));

	}, 99999 );

	add_action('admin_enqueue_scripts', function() {

		if ( ! wp_script_is( 'wplink', 'registered' ) )
			return;

		wp_deregister_script( 'wplink' );
		wp_register_script( 'wplink',  get_bloginfo('template_directory') . '/assets/admin/js/nofollow.js', array('jquery', 'wp-a11y'), '1.07', 1 );

		wp_localize_script('wplink', 'wpLinkL10n', array(
			'title' => __('Insert/edit link'),
			'update' => __('Update'),
			'save' => __('Add Link'),
			'noTitle' => __('(no title)'),
			'labelTitle' => __( 'Title' ),
			'noMatchesFound' => __('No results found.'),
			'noFollow' => __(' Add <code>rel="nofollow"</code> to link', 'title-and-nofollow-for-links')
	    ));

	}, 99999 );

	add_action ('login_head', function() {
		echo '<link rel="stylesheet" href="'. get_bloginfo('template_directory') .'/public/css/login.css" type="text/css" media="screen" />';
		echo '<link rel="shortcut icon" href="'. get_bloginfo('template_directory') . '/dist/images/favicons/favicon-32x32.png">';
	});

	add_action( 'admin_init', function() {
		add_editor_style( get_bloginfo('template_directory') . '/public/css/editor.css' );
		wp_enqueue_style( 'keena-admin-style', get_template_directory_uri() . '/public/css/wp-admin.css', null );
	});

	add_filter('login_errors', function ( $error ) {

		$pos = strpos( $error, 'username' );

		if ( is_int( $pos ) )
			$error = 'Incorrect Username/Password';

		return $error;

	});

	// add "Formats" & "Buttons" to TinyMCE
	add_filter( 'mce_buttons_2', function ( $buttons ) {

		$new_buttons = array( 'styleselect', 'removeformat', 'binary_button', 'binary_customize' );
		$remove_buttons = array( 'removeformat', 'charmap' );

		foreach( $buttons as $button ) {

			if ( in_array( $button, $remove_buttons ) )
				continue;

			$new_buttons[] = $button;

		}

		return $new_buttons;
	});

	function bootstrap_tinymce_helper() {

		$spacing_array = array(
			'm' => 'Margin',
			'p' => 'Padding'
		);

		$sides_array = array(
			'g' => 'Global',
			'y' => 'Vertical',
			'x' => 'Horizontal',
			't' => 'Top',
			'r' => 'Right',
			'b' => 'Bottom',
			'l' => 'Left'
		);

		$helper_output = array();

		foreach( $spacing_array as $space => $space_name ) {

			$type = array();
			$type['title'] = $space_name;
			$type['items'] = array();

			foreach( $sides_array as $side => $side_name ) {

				$spacing_array = array();
				$spacing_array['items'] = array();
				$spacing_array['title'] = $side_name;

				// remove array key for 'Global' option.
				if ( $side == 'g' )
					$side = '';

				for( $s = 0; $s <= 5; $s++ ) {

					array_push( $spacing_array['items'], array(
						'title' => $s,
						'classes' =>  $space . $side . '-' . $s ,
						'selector' => '*',
						'wrapper' => true,
						'exact' => true
					) );

				}

				array_push( $type['items'], $spacing_array );

			}

			array_push( $helper_output, $type );

		}

		return $helper_output;

	}

	// https://www.tiny.cloud/docs-3x/reference/configuration/Configuration3x@formats/
	add_filter( 'tiny_mce_before_init', function ( $init_array ) {

		// Define the style_formats array
		$style_formats = array(
			array(
				'title' => 'Faux Headers',
				'items' => array(
					array(
						'title' => 'Heading 1',
					//	'inline' => 'span',
						'classes' => 'h1',
						'selector' => 'h1,h2,h3,h4,h5,h6,p,ul,ol',
						'wrapper' => true,
						'exact' => true
					),
					array(
						'title' => 'Heading 2',
					//	'inline' => 'span',
						'classes' => 'h2',
						'selector' => 'h1,h2,h3,h4,h5,h6,p,ul,ol',
						'wrapper' => true,
						'exact' => true
					),
					array(
						'title' => 'Heading 3',
					//	'inline' => 'span',
						'classes' => 'h3',
						'selector' => 'h1,h2,h3,h4,h5,h6,p,ul,ol',
						'wrapper' => true,
						'exact' => true
					),
					array(
						'title' => 'Heading 4',
					//	'inline' => 'span',
						'classes' => 'h4',
						'selector' => 'h1,h2,h3,h4,h5,h6,p,ul,ol',
						'wrapper' => true,
						'exact' => true
					),
					array(
						'title' => 'Heading 5',
					//	'inline' => 'span',
						'classes' => 'h5',
						'selector' => 'h1,h2,h3,h4,h5,h6,p,ul,ol',
						'wrapper' => true,
						'exact' => true
					),
					array(
						'title' => 'Heading 6',
					//	'inline' => 'span',
						'classes' => 'h6',
						'selector' => 'h1,h2,h3,h4,h5,h6,p,ul,ol',
						'wrapper' => true,
						'exact' => true
					),
				)
			),
			array(
				'title' => 'Text Colors',
				'items' => array(
					array(
						'title' => 'Keena Blue',
						'inline' => 'span',
						'classes' => 'text-primary',
						'wrapper' => true,
						'exact' => false
					),
					array(
						'title' => 'Keena Orange',
						'inline' => 'span',
						'classes' => 'text-secondary',
						'wrapper' => true,
						'exact' => false
					),
					array(
						'title' => 'Keena Green',
						'inline' => 'span',
						'classes' => 'text-info',
						'wrapper' => true,
						'exact' => false
					),
					array(
						'title' => 'Keena Yellow',
						'inline' => 'span',
						'classes' => 'text-warning',
						'wrapper' => true,
						'exact' => false
					),
					array(
						'title' => 'White',
						'inline' => 'span',
						'classes' => 'text-white',
						'wrapper' => true,
						'exact' => false
					),
				),
			),
			array(
				'title' => 'Misc Formatting',
				'items' => array(
					array(
						'title' => 'Uppercase',
						'inline' => 'span',
						'classes' => 'text-uppercase',
						'wrapper' => true,
						'exact' => false
					),
					array(
					 	'title' => 'Next Steps',
					 	'classes' => 'next-steps',
					 	'selector' => 'p'
					),
					array(
						'title' => 'Small Divider',
						'classes' => 'small-divider',
						'selector' => 'hr',
					),
					array(
						'title' => 'Extra Small Divider',
						'classes' => 'small-divider-xs',
						'selector' => 'hr',
					),
					array(
						'title' => 'Centered Block',
						'classes' => 'text-center',
						'block' => 'div',
						'wrapper' => true,
					),
					array(
						'title' => 'Remove List Styling',
						'classes' => 'list-unstyled',
						'selector' => 'ul,ol',
					)
				)
			)
		);

		$bootstrap_spacing_array = bootstrap_tinymce_helper();

		foreach( $bootstrap_spacing_array as $bootstrap_spacing ) {
			array_push( $style_formats, $bootstrap_spacing );
		}

		// Insert the array, JSON ENCODED, into 'style_formats'
		$init_array['style_formats'] = json_encode( $style_formats );

		return $init_array;

	} );

	add_filter( 'mce_external_plugins', function ( $plugin_array ) {
		$plugin_array['binary_button'] = get_bloginfo('template_directory') . '/assets/admin/js/tinymce-button.js?' . filemtime( get_template_directory() . '/assets/admin/js/tinymce-button.js' );
		return $plugin_array;
	} );
