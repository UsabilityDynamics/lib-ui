/**
 * Script Ran on Customizer Side
 *
 * Handles editor and UI.
 *
 */
define( 'ui.wp.editor.style', function styleEditor( require, exports, module ) {
  console.log( module.id, 'initialized from', module.uri );

  return function callbackOfEditor() {
    console.log( 'ui.wp.editor.style in context' );
  };

});
