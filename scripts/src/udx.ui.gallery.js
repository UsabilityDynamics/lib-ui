/**
 * Gallery
 *
 */
define( 'udx.ui.gallery', [ 'jquery.isotope', 'jquery.fancybox' ], function Gallery() {
  console.debug( 'udx.ui.gallery', 'loaded' );

  return function domnReady() {
    console.debug( 'udx.ui.gallery', 'ready' );

    var element = jQuery( this );

    element.isotope( {
      cellsByColumn: {
        columnWidth: 240,
        rowHeight: 360
      }
    } );

    jQuery( "a", element ).fancybox( {
      'transitionIn': 'elastic',
      'transitionOut': 'elastic',
      'speedIn': 600,
      'speedOut': 200,
      'overlayShow': false
    } );

    return element;

  };

});

