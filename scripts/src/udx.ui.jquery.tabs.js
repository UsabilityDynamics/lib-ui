/**
 * Script Ran on Customizer Side
 *
 * Handles editor and UI.
 *
 * We use jQuery.ui.tabs( options, element ) instead of jQuery().tabs( options ).
 *
 */
define( 'udx.ui.jquery.tabs', function scriptEditor( require, exports, module ) {
  module.log( 'Module loaded.' );
  // module.debug( 'module debug' );
  // module.error( 'module error' );

  return function callbackOfEditor() {
    module.log( 'callbackOfEditor', 'Module initialized.' );

    if( !jQuery.fn.tabs ) {
      return module.error( 'jQuery.fn.tabs not defined' );;
    }

    // console.log( jQuery.fn.tabs );
    var _tabs = jQuery( this ).tabs({
      collapsible: true
    });

    return _tabs;

  };

});

