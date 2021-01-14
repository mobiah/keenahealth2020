<?php

	function keena_parent_item( $post_id ) {

		$post_type = get_post_type( $post_id );

		if ( $post_type == 'page' ) {

			$ancestors = get_post_ancestors( $post_id );

			if ( empty( $ancestors ) )
				return get_bloginfo( 'name' );

			return get_the_title( $ancestors['0'] );

		} elseif ( $post_type == 'post' ) {

			$categories = get_the_category( $post_id );

			return $categories['0']->name;

		}

		return $post_type;

	}

	function keena_search_value() {
		if ( !isset( $_GET['s'] ) )
			return;

		return preg_replace("/[^a-z A-Z0-9]+/", '', $_GET['s'] );
	}

	// extend search to postmeta table.
	add_filter('posts_join', function( $join ) {
		global $wpdb;

		if ( is_search() ) {
			$join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
		}

		return $join;
	} );

	// extend search to meta_value fields
	add_filter( 'posts_where', function( $where ) {
		global $pagenow, $wpdb;

		if ( is_search() ) {
		    $where = preg_replace(
	            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
	            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );

			// exclude posts that are set to noindex
			$where .= ' AND ' . $wpdb->posts . '.ID not in ( select post_id from '.$wpdb->postmeta.' where meta_key = \'_yoast_wpseo_meta-robots-noindex\' and meta_value = 1 )' ;
		}

		return $where;
	} );

	add_filter( 'posts_distinct', function( $where ) {
		global $wpdb;

		if ( is_search() ) {
	      	return "DISTINCT";
		}

		return $where;
	} );
