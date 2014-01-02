/**
 * Script Ran within iFrame when using Customizer.
 *
 * Logic here can be used to interact with the site preview in real-time.
 *
 * @author potanin@ud
 */
jQuery( document ).ready( function styleCustomizer() {

  /**
   * Create Element for Hot Swapping Styles
   *
   * @todo Remove actual <link> to app-style.css while editing in preview mode.
   */
  function createStyleContainer() {
    // console.log( 'createStyleContainer' );

    if( jQuery( '#udx-style-preview-container' ).length ) {
      return;
    }

    var _element = jQuery( '<style type="text/css" id="udx-style-preview-container"></style>' );

    // Create New Element and add to <head>
    jQuery( 'head' ).append( _element );

    // console.log( '_element', _element );

  }

  /**
   * Update Dynamic Styles
   *
   * @param style
   */
  function updateStyles( style ) {
    // console.log( 'updateStyles', style );

    // Oue dynamically generated style element
    jQuery( 'head #udx-style-preview-container' ).text( style );

  }

  // Update Styles Live.
  wp.customize( 'custom-style', function( style ) {
    var intent;

    createStyleContainer();

    // Listen for Changes.
    style.bind( function stylesChanged( style ) {
      // console.log( 'stylesChanged', style );

      // Clear Intent
      window.clearTimeout( intent );

      // Pause for Intent Check
      intent = window.setTimeout( function() {
        updateStyles( style );
      }, 200 );

    });

  });

  // Listen for Changes.
  wp.customize( 'custom-style-minify', function( options ) {
    // options.bind( minificationOptionChanged );
  });

});

