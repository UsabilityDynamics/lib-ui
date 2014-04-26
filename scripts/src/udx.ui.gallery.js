/**
 * Gallery
 *
 * @todo Add imagesloaded module so Isotope isn't bound too early.
 *
 * @author potanin@UD
 */
define( 'udx.ui.gallery', [ 'jquery.isotope', 'jquery.fancybox' ], function Gallery() {
  // console.debug( 'udx.ui.gallery', 'loaded' );

  document.addEventListener( 'DOMContentLoaded', function() {
    // console.debug( 'DOMContentLoaded' );
  });

  /**
   * Bind Fancybox.
   *
   */
  function bindFancybox( element, options ) {
    // console.debug( 'udx.ui.gallery', 'bindFancybox', options );

    // data-fancybox-group

    jQuery( 'a', element ).fancybox( options );

  }

  /**
   * Bind Isotpe.
   *
   */
  function bindIsotope( element, options ) {
    // console.debug( 'udx.ui.gallery', 'bindIsotope', options );

    var isotope = require( 'jquery.isotope' );

    if( !require( 'jquery.isotope' ) ) {
      console.error( 'udx.ui.gallery', 'isotope not available as expected' );
      return;
    }

    jQuery( element ).each( function eachElement() {

      new isotope( this, options );

    });

  }

  /**
   * Execute on DOM Ready.
   *
   * @todo Remove ghetto timeouts and make binding triggered when images are ready.
   */
  return function domnReady() {
    // console.debug( 'udx.ui.gallery', 'ready' );

    var self = this;

    // Set default optiosn.
    this.options = jQuery.extend( this.options, {
      isotope: {
        cellsByColumn: {
          columnWidth: 240,
          rowHeight: 360
        }
      },
      fancybox: {
        speedIn: 600,
        speedOut: 200,
        helpers:  {
          title : {
            type : 'inside'
          },
          overlay : {
            showEarly : false
          }
        }
      }
    });

    if( this.options.isotope ) {
      window.setTimeout( function() {
        bindIsotope( jQuery( self ), self.options.isotope );
      }, 100 )
    }

    if( this.options.fancybox ) {
      window.setTimeout( function() {
        bindFancybox( jQuery( self ), self.options.fancybox );
      }, 200 );
    }

    return this;

  }

});

