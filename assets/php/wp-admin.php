<?php

	add_action ('login_head', function() {
		echo '<link rel="stylesheet" href="'. get_bloginfo('template_directory') .'/public/css/login.css" type="text/css" media="screen" />';
	});

	//add_action( 'admin_init', function() {
	//	add_editor_style( get_bloginfo('template_directory') . '/public/css/editor.css' );
	//	wp_enqueue_style( 'veem-admin-style', get_template_directory_uri() . '/public/css/wp-admin.css', null );
	//});

	add_filter('login_errors', function ( $error ) {

		$pos = strpos( $error, 'username' );

		if ( is_int( $pos ) )
			$error = 'Incorrect Username/Password';

		return $error;

	});
