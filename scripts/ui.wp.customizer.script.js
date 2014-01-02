/**
 * Script Ran within iFrame when using Customizer.
 *
 * Logic here can be used to interact with the site preview in real-time.
 *
 * @author potanin@ud
 */
define( "ui.customizer.script", function scriptCustomizer() {

  //jQuery( document ).ready( function scriptCustomizer() {});

  // Do Something Live...?
  wp.customize( 'custom-script', function( script ) {

    // Listen for Changes.
    script.bind( function scriptsChanged( script ) {
      console.log( 'scriptsChanged', script );
    });

  });

  // Minify Script.
  wp.customize( 'custom-script-minify', function( options ) {
  });

  // Cache Script.
  wp.customize( 'custom-script-cache', function( options ) {
  });

  // Show in Footer.
  wp.customize( 'custom-script-footer', function( options ) {
  });


});

