/**
 * Script Ran on Customizer Side
 *
 * Handles editor and UI.
 *
 */
define( function scriptEditor( require, exports, module ) {
  //console.log( 'scriptEditor', typeof require, typeof exports, typeof module );

  //console.log( 'module.id', module.id );
  //console.log( 'module.exports', module.exports );
  //console.log( 'module.config', module.config );
  //console.log( 'module.uri', module.uri);

  return function callbackOfEditor() {
    console.log( 'callback of scripteditor now in context' );
  };

  /*
  // Ace Editor
  var wrapper = jQuery( '#udx-script-editor-wrapper' );

  // WordPress Editor
  var realEditor = jQuery( '#udx-script-editor' );

  wrapper
    .css( 'position', 'absolute' )
    .css( 'top', wrapper.position().top )
    .css( 'left', wrapper.position().left )
    .css( 'width', '100%' )
    .css( 'height', '100%' );

  // Instantiate Ace.
  var editor = ace.edit( "udx-script-editor-wrapper" );

  editor.setTheme( "ace/theme/dawn" );
  editor.getSession().setMode( "ace/mode/javascript" );
  editor.getSession().setUseSoftTabs( true );
  editor.setHighlightActiveLine( false );
  editor.setShowPrintMargin( false );
  editor.getSession().setTabSize( 2 );

  // Get initial content.
  editor.setValue( realEditor.text() );

  // Trigger changes in actual editor.
  editor.on( 'change', function() {
    realEditor.text( editor.getValue() );
    realEditor.trigger( 'change' );
  });

  */

});
