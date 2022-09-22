<?php

	add_action( 'after_setup_theme', function() {

		add_theme_support( 'post-thumbnails' );

		// we probably don't need all these sizes but srcset should
		// make this work pretty well.....
		add_image_size( 'leader-xl', 315, 315, true);
		add_image_size( 'leader-l', 255, 255, true);
		add_image_size( 'leader-m', 210, 210, true);

	});

	// do we want this running here? 
	//add_filter( 'get_image_tag_class', function( $class ) {
	//	$class .= ' img-fluid';
	//	return $class;
	//});
