/**
 * Script Ran on Customizer Side
 *
 * Handles editor and UI.
 *
 * @note if there are inline deps in the define() method then (require, exports and module) won't be available.
 *
 * $.fn.tabs === jQuery.tabs
 * $ === jQuery.init
 *
 */
define( 'udx.ui.jquery.tabs', [ 'jquery', 'jquery.ui' ], function scriptEditor( jQuery ) {
  //console.log( module.id, 'initialized from', module.uri );
  console.log( 'jQuery inline', jQuery );
  console.log( 'jQuery.init inline', jQuery.init );
  console.log( 'jQuery.fn inline', jQuery.fn );

  return function callbackOfEditor() {
    // console.log( 'callbackOfEditor() ', module.id, 'in context', this );


    var jQuery = require( 'jquery' );

    console.log( 'jQuery', jQuery );
    console.log( 'jQuery.init', jQuery.init );
    console.log( 'jQuery.fn', jQuery.fn );

    return;
    // console.log( "JQUERY DEBUG", typeof require( 'jquery' ).fn.tabs );

    if( !jQuery || !jQuery.fn ) {
      return console.error( 'jQuery not available.' );
    }

    if( !jQuery.fn.tabs ) {
      return console.error( 'jQuery.fn.tabs not available.' );
    }

    jQuery( this ).tabs({
      collapsible: true
    });

  };

});

