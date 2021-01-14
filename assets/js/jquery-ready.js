(function($){

	console.log('does it blend?');

	var window_width = window.innerWidth;

	if ( window_width < 960 ) {
		var $searchbar = $( '#searchbar' );
		var $navbar = $( '#navbarNav' );

		$searchbar.removeClass( 'collapse' );
		$searchbar.appendTo( $navbar );
	}


})(jQuery);