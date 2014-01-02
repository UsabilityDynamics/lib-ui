/**
 * Script Ran on Customizer Side
 *
 * Handles editor and UI.
 *
 */
define( 'ui.wp.editor.style', function styleEditor( require ) {
  // console.log( 'styleEditor' );

  // @note current disabled

  return function callbackOfEditor() {
    // console.log( 'callback of scripteditor now in context' );

    // Ace Editor
    var wrapper = jQuery( '#udx-style-editor-wrapper' );

    // WordPress Editor
    var realEditor = jQuery( '#udx-style-editor' );

    if( !wrapper.length || !realEditor.length ) {
      console.log( 'missing elements' );
      return;
    }

    wrapper
      .css( 'position', 'absolute' )
      .css( 'top', wrapper.position().top )
      .css( 'left', wrapper.position().left )
      .css( 'width', '100%' )
      .css( 'height', '100%' );

    require( [ 'ace' ], function() {
      // console.log( 'styleEditor', 'have ace' );

      realEditor.hide();

      // Instantiate Ace. @note Issue do to http://cdn.usabilitydynamics.com/js/ace/1.0.0/css/editor.css being blocked due to CORS
      var editor = require( 'ace' ).edit( "udx-style-editor-wrapper" );

      editor.setTheme( "ace/theme/dawn" );
      editor.getSession().setMode( "ace/mode/css" );
      editor.getSession().setUseWorker( false ); // disable inline checking.
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

    });

  };

});
