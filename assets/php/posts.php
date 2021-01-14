<?php

	function keena_read_more( $post_id ) {

		$read_more_text = 'Read More';
		$read_more_link = get_the_permalink( $post_id );

		if ( get_post_meta( $post_id, 'customize_read_more', true ) == 1 ) {

			$read_more_link = get_post_meta( $post_id, 'read_more_link', true );

			$maybe_read_more_text = get_post_meta( $post_id, 'read_more_text', true );

			if ( !empty( $maybe_read_more_text ) )
				$read_more_text = $maybe_read_more_text;

		}

		return array(
			'text' => $read_more_text,
			'link' => $read_more_link
		);

	}
