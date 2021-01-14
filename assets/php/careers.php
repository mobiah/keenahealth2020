<?php

	add_action( 'init', function() {

		register_post_type(
			'career',
			array(
				'label' => 'Careers',
				'labels' => array(
					'name' => 'Careers',
					'singular_name' => 'Career',
					'not_found' => 'No careers found',
					'add_new' => 'Add new career',
					'add_new_item' => 'Add New Career',
					'edit_item' => 'Edit Career',
					'new_item' => 'New Career',
					'view_item' => 'View Career'
				),
				'public' => true,
				'show_ui' => true,
				'show_in_menu' => 'edit.php?post_type=page',
				'show_in_admin_bar' => false,
				'hierarchical' => false,
				'exclude_from_search' => true,
				'supports' => array(
					'title',
					'editor',
				),
				'rewrite' => array(
					'slug' => 'careers',
					'feeds' => false
				)
			)
		);

	} );
