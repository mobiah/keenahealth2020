<?php

	add_filter('wpseo_schema_organization', function( $schema ) {

		$phone = get_option('option_phone_number');
		$email = get_option('option_email_address');

		if ( empty( $phone ) || empty( $email ) )
			return $schema;

		$schema['ContactPoint'] = array(
			'telephone' => $phone,
			'contactType' => 'General',
			'email' => $email
		);

		return $schema;

	});
