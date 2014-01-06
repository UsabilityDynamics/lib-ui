/**
 * Script Ran on Customizer Side
 *
 * Handles editor and UI.
 *
 */
define( 'ui.wp.editor.script', function scriptEditor( require, exports, module ) {
  console.log( module.id, 'initialized from', module.uri );

  return function callbackOfEditor() {
    console.log( module.id, 'in context' );
  };

});
