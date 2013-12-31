

wp.customize( 'customized_css', function( value ) {

  if( !jQuery ) {
    return;
  }

  //console.log( 'got ya' );

  //console.log( 'customized_css:', value );

  //var overlay = jQuery( document.body ).children( '.wp-full-overlay' );
  //overlay.toggleClass( 'collapsed' ).toggleClass( 'expanded' );
  // console.log( 'overlay', overlay );
  //console.log( 'value', value );

  value.bind( function( newval ) {
    //console.log( newval );
  });

});

