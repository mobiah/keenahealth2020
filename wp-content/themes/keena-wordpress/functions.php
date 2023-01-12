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
		
		register_sidebar( array(
			'name'          => 'Sidebar - ASPubs',
			'id'            => 'sidebar_widget_area_3',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => 'Sidebar - CAPubs',
			'id'            => 'sidebar_widget_area_4',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => 'Sidebar - DAPubs',
			'id'            => 'sidebar_widget_area_5',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => 'Sidebar - IIPubs',
			'id'            => 'sidebar_widget_area_6',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => 'Sidebar - PEPubs',
			'id'            => 'sidebar_widget_area_7',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => 'Sidebar - PHPubs',
			'id'            => 'sidebar_widget_area_8',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => 'Sidebar - SBPubs',
			'id'            => 'sidebar_widget_area_9',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		register_sidebar( array(
			'name'          => 'Sidebar - WEPubs',
			'id'            => 'sidebar_widget_area_10',
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

	/*
 * Function for post duplication. Dups appear as drafts. User is redirected to the edit screen
 */
// function rd_duplicate_post_as_draft(){
// 	global $wpdb;
// 	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
// 	  wp_die('No post to duplicate has been supplied!');
// 	}
// 	/*
// 	 * Nonce verification
// 	 */
// 	if ( !isset( $_GET['duplicate_nonce'] ) || !wp_verify_nonce( $_GET['duplicate_nonce'], basename( __FILE__ ) ) )
// 	  return;
// 	/*
// 	 * get the original post id
// 	 */
// 	$post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
// 	/*
// 	 * and all the original post data then
// 	 */
// 	$post = get_post( $post_id );
// 	/*
// 	 * if you don't want current user to be the new post author,
// 	 * then change next couple of lines to this: $new_post_author = $post->post_author;
// 	 */
// 	$current_user = wp_get_current_user();
// 	$new_post_author = $current_user->ID;
// 	/*
// 	 * if post data exists, create the post duplicate
// 	 */
// 	if (isset( $post ) && $post != null) {
// 	  /*
// 	   * new post data array
// 	   */
// 	  $args = array(
// 		'comment_status' => $post->comment_status,
// 		'ping_status'    => $post->ping_status,
// 		'post_author'    => $new_post_author,
// 		'post_content'   => $post->post_content,
// 		'post_excerpt'   => $post->post_excerpt,
// 		'post_name'      => $post->post_name,
// 		'post_parent'    => $post->post_parent,
// 		'post_password'  => $post->post_password,
// 		'post_status'    => 'draft',
// 		'post_title'     => $post->post_title,
// 		'post_type'      => $post->post_type,
// 		'to_ping'        => $post->to_ping,
// 		'menu_order'     => $post->menu_order
// 	  );
// 	  /*
// 	   * insert the post by wp_insert_post() function
// 	   */
// 	  $new_post_id = wp_insert_post( $args );
// 	  /*
// 	   * get all current post terms ad set them to the new post draft
// 	   */
// 	  $taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
// 	  foreach ($taxonomies as $taxonomy) {
// 		$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
// 		wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
// 	  }
// 	  /*
// 	   * duplicate all post meta just in two SQL queries
// 	   */
// 	  $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
// 	  if (count($post_meta_infos)!=0) {
// 		$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
// 		foreach ($post_meta_infos as $meta_info) {
// 		  $meta_key = $meta_info->meta_key;
// 		  if( $meta_key == '_wp_old_slug' ) continue;
// 		  $meta_value = addslashes($meta_info->meta_value);
// 		  $sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
// 		}
// 		$sql_query.= implode(" UNION ALL ", $sql_query_sel);
// 		$wpdb->query($sql_query);
// 	  }
// 	  /*
// 	   * finally, redirect to the edit post screen for the new draft
// 	   */
// 	  wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
// 	  exit;
// 	} else {
// 	  wp_die('Post creation failed, could not find original post: ' . $post_id);
// 	}
//   }
//   add_action( 'admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft' );
//   /*
//    * Add the duplicate link to action list for post_row_actions
//    */
//   function rd_duplicate_post_link( $actions, $post ) {
// 	if (current_user_can('edit_posts')) {
// 	  $actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=rd_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce' ) . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
// 	}
// 	return $actions;
//   }
//   add_filter('page_row_actions', 'rd_duplicate_post_link', 10, 2);


/*
* Creating a function to create our CPT
*/
  
function insights_post_type() {
  
	// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Insights', 'Post Type General Name', 'keena-wordpress' ),
			'singular_name'       => _x( 'Insight', 'Post Type Singular Name', 'keena-wordpress' ),
			'menu_name'           => __( 'Insights', 'keena-wordpress' ),
			'parent_item_colon'   => __( 'Parent Insight', 'keena-wordpress' ),
			'all_items'           => __( 'All Insights', 'keena-wordpress' ),
			'view_item'           => __( 'View Insight', 'keena-wordpress' ),
			'add_new_item'        => __( 'Add New Insight', 'keena-wordpress' ),
			'add_new'             => __( 'Add New', 'keena-wordpress' ),
			'edit_item'           => __( 'Edit Insight', 'keena-wordpress' ),
			'update_item'         => __( 'Update Insight', 'keena-wordpress' ),
			'search_items'        => __( 'Search Insight', 'keena-wordpress' ),
			'not_found'           => __( 'Not Found', 'keena-wordpress' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'keena-wordpress' ),
		);
		  
	// Set other options for Custom Post Type
		  
		$args = array(
			'label'               => __( 'insights', 'keena-wordpress' ),
			'description'         => __( 'Insight blocks', 'keena-wordpress' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields'),
			// You can associate this CPT with a taxonomy or custom taxonomy. 
			'taxonomies'          => array( 'groups', 'genres' ),
			/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'menu_icon'   => 'dashicons-lightbulb',
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'show_in_rest' => true,
	
		);
		  
		// Registering your Custom Post Type
		register_post_type( 'insights', $args );
	  
	}
	  
	/* Hook into the 'init' action so that the function
	* Containing our post type registration is not 
	* unnecessarily executed. 
	*/
	  
	add_action( 'init', 'insights_post_type', 0 );

	//hook into the init action and call create_book_taxonomies when it fires
  
add_action( 'init', 'create_groups_hierarchical_taxonomy', 0 );
  
//create a custom taxonomy name it groups for your posts
  
function create_groups_hierarchical_taxonomy() {
  
// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI
  
  $labels = array(
    'name' => _x( 'Groups', 'taxonomy general name' ),
    'singular_name' => _x( 'Group', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Groups' ),
    'all_items' => __( 'All Groups' ),
    'parent_item' => __( 'Parent Group' ),
    'parent_item_colon' => __( 'Parent Group:' ),
    'edit_item' => __( 'Edit Group' ), 
    'update_item' => __( 'Update Group' ),
    'add_new_item' => __( 'Add New Group' ),
    'new_item_name' => __( 'New Group Name' ),
    'menu_name' => __( 'Groups' ),
  );    
  
// Now register the taxonomy
  register_taxonomy('groups',array('insights'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'group' ),
  ));
  
}