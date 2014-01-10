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
define( 'udx.ui.jquery-tabs', function scriptEditor( requires, exports, module ) {
  //console.log( module.id, 'initialized from', module.uri );

  return function callbackOfEditor() {
    // console.log( 'callbackOfEditor() ', module.id, 'in context', this );

    require( 'jquery' )( this ).tabs({
      collapsible: true
    });

  };

});

