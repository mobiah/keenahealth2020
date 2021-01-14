<?php

	require_once( 'assets/php/disable-emojis.php' );
	require_once( 'assets/php/frontend-snippets.php' );
	require_once( 'assets/php/frontend-block-snippets.php' );
	require_once( 'assets/php/gravity-forms.php' );
	require_once( 'assets/admin/wp-admin.php' );
	require_once( 'assets/php/images.php' );
	require_once( 'assets/php/posts.php' );
	require_once( 'assets/php/search-optimization.php' );
	require_once( 'assets/php/careers.php' );
	require_once( 'assets/php/schema.php' );
	require_once( 'assets/php/search.php' );
	require_once( 'assets/php/external-js.php' );

	if ( function_exists('acf_add_options_page') )
		require_once( 'assets/php/acf-global-options.php' );

	add_action('wp_enqueue_scripts', function() {

		wp_dequeue_style( 'wp-block-library' );

		wp_enqueue_script( 'binarym_init', get_template_directory_uri(). '/public/js/init.min.js', array('jquery'), filemtime( get_template_directory() .'/public/js/init.min.js' ), true );

		wp_enqueue_style( 'binarym_style', get_template_directory_uri() . '/public/css/style.css', null, filemtime( get_template_directory() . '/public/css/style.css' ) );

		if ( is_singular() && comments_open() )
			wp_enqueue_script( 'comment-reply' );

		if ( is_user_logged_in() ) {

			wp_enqueue_style( 'wp-admin-style', get_template_directory_uri() . '/public/css/wp-admin.css', null, filemtime( get_template_directory() . '/public/css/wp-admin.css' ) );

			// wp_enqueue_script( 'wp-logged-in', get_template_directory_uri(). '/public/js/logged-in.js', array('jquery'), filemtime( get_template_directory() .'/public/js/logged-in.js' ), true );

		}

	} );

	add_action( 'wp_footer', function() {

		wp_dequeue_script( 'wp-embed' );

	} );

	add_action( 'init', function() {
		remove_action( 'rest_api_init', 'wp_oembed_register_route' );
		add_filter( 'embed_oembed_discover', '__return_false' );
		remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
		remove_action( 'wp_head', 'wp_oembed_add_host_js' );
		remove_filter( 'pre_oembed_result', 'wp_filter_pre_oembed_result', 10 );
	} );

	// disable Yoast SEO Redirection functionality.
	// https://kb.yoast.com/kb/how-to-disable-automatic-redirects/
	add_filter('wpseo_premium_post_redirect_slug_change', '__return_true' );
	add_filter('wpseo_premium_term_redirect_slug_change', '__return_true' );
	add_filter('wpseo_enable_notification_post_trash', '__return_false');
	add_filter('wpseo_enable_notification_post_slug_change', '__return_false');
	add_filter('wpseo_enable_notification_term_delete','__return_false');
	add_filter('wpseo_enable_notification_term_slug_change','__return_false');

	// hide Yoast SEO Redirection functionality.
	add_action( 'admin_menu', function() {
		remove_submenu_page( 'wpseo_dashboard', 'wpseo_redirects' );
	}, 9999 );

	add_post_type_support( 'page', array( 'excerpt', 'thumbnail' ) );

	add_action( 'after_setup_theme', function() {

		add_theme_support( 'html5', array( 'comment-list' ) );

		register_nav_menus( array(
			'primary-nav' => 'Primary Navigation',
			'footer-nav' => 'Footer Navigation',
		) );

	} );

	add_action( 'widgets_init', function() {

		register_sidebar( array(
			'name'          => 'Footer',
			'id'            => 'footer_widget_area_1',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => 'Sidebar - Career',
			'id'            => 'sidebar_widget_area_1',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => 'Sidebar - Post',
			'id'            => 'sidebar_widget_area_2',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
	} );

	// https://blog.ripstech.com/2018/wordpress-file-delete-to-code-execution/
	// add_filter( 'wp_update_attachment_metadata', function( $data ) {

	// 	if ( isset( $data['thumb'] ) )
	// 		$data['thumb'] = basename( $data['thumb'] );

	// 	return $data;

	// } );

	// https://stackoverflow.com/questions/3835636/php-replace-last-occurrence-of-a-string-in-a-string
	// function str_lreplace( $search, $replace, $subject ) {

	// 	$pos = strrpos( $subject, $search );

	// 	if ( $pos !== false )
	// 		$subject = substr_replace( $subject, $replace, $pos, strlen( $search ) );


	// 	return $subject;
	// }

	// add_filter('next_posts_link_attributes', function() {
	// 	return 'class="btn btn-block blog-load-more"';
	// });

	// add_filter('pre_get_posts', function( $query ) {

	// 	if ( !is_admin() && $query->is_main_query() ) {

	// 		// limit search to pages & posts.
	// 		if ( $query->is_search() )
	// 			$query->set('post_type', array( 'post', 'page' ) );

	// 		// add filtering to category templates.
	// 		if ( $query->is_category() && isset( $_GET['filter-id'] ) ) {
	// 			$query->set('tax_query', array(
	// 				'relation' => 'and',
	// 				array(
	// 					'taxonomy' => 'post_filter',
	// 					'field' => 'id',
	// 					'terms' => $_GET['filter-id']
	// 				)
	// 			) );
	// 		}

	// 	}

	// 	return $query;

	// });

	// echo '<pre>' . print_r( get_defined_vars(), true ) . '</pre>';
