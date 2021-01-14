(function($){

	// Helpers for mobile nav experience
	var $nav_items = $( '#menu-primary' ).children( '.nav-item' );

	$( '#primary-nav-toggle, #primary-nav-close' ).click( function() {

		// Disable background scrolling while mobile nav is active.
		$( 'body' ).toggleClass( 'overflow-hidden' );

		// Reset nav items when mobile nav is closed.
		// $nav_items.removeClass( 'inactive' );
	});

	$( '#menu-primary' ).find( '.dropdown-toggle' ).click( function() {
		var $this = $(this);
		var $parent = $(this).parent();

		// Hide other nav items when a submenu is displayed mobile.
		$nav_items.not( $parent ).toggleClass( 'inactive' );
	});

})(jQuery);
