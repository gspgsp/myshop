$( function () {
	//set the width of back
	var left = $( ".left" ),
		center = $( ".center" ),
		topBack = $( ".back" ),
		w = Math.ceil($( document ).width() - left.width() - center.width());	
	topBack.width( w );
	$( window ).resize( function () {
		w = Math.ceil($( document ).width() - left.width() - center.width());
		topBack.width( w );
	} );
	
} );