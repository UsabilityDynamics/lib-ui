<?php
/**
 * Settings User Interface
 *
 * @author peshkov@UD
 */
namespace UsabilityDynamics\UI {

  if( !class_exists( 'UsabilityDynamics\UI\Settings' ) ) {

    /**
     * Class Settings
     *
     */
    class Settings {

      /**
       * Constructor
       *
       */
      public function __construct( $settings, $args = false ) {
        
        //is_subclass_of 
        
        $args = wp_parse_args( $args, array(
          'schema' => array(),
        ) );
        
      }
    
    }

  }

}