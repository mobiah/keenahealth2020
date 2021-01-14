<?php

	add_filter('robots_txt', function( $robots ) {

		$robots .= "\n" .
				'Sitemap: ' . get_home_url() . '/sitemap_index.xml';

		return $robots;
	});
