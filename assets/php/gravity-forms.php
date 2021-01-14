<?php

	// Populate hidden field with job ID.
	add_filter( 'gform_field_value_job_id', function( $value ) {

		if ( isset( $_GET['ref'] ) )
			$page_id = $_GET['ref'];

		if ( isset( $page_id ) && is_page( 304 ) )
			$value = get_field( 'job_id', $page_id );

		return $value;
		
	} );

	// Populate hidden field with job loction.
	add_filter( 'gform_field_value_job_location', function( $value ) {

		if ( isset( $_GET['ref'] ) )
			$page_id = $_GET['ref'];

		if ( isset( $page_id ) && is_page( 304 ) )
			$value = get_field( 'job_location', $page_id );

		return $value;

	} );
