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
       * @param UsabilityDynamics\Settings object $settings
       * @param array $args
       */
      public function __construct( $settings, $args = false ) {
        
        $args = wp_parse_args( $args, array(
          'schema' => array(),
        ) );
        
        //** Break if settings var is incorrect */
        if( !is_subclass_of( $settings, 'UsabilityDynamics\Settings' ) ) {
          return;
        }
        //** Break if schema is not valid */
        if( !$this->parse_schema( $args[ 'schema' ] ) ) {
          return;
        }
        
        //** Now initialize settings UI. */
        
      }
      
      /**
       * Parse schema:
       * - Validates schema
       * - Adds Settings Menu
       *
       */
      private function parse_schema( $schema = array() ) {
        
        //echo "<pre>"; print_r( $schema ); echo "</pre>"; die();
        
        try {
        
          if( empty( $schema[ 'configuration' ] ) ) {
            throw new Exception( 'configuration data is not set' );
          } else if ( empty( $schema[ 'fields' ] ) ) {
            throw new Exception( 'fields data is not set' );
          }
          
          if( !$this->add_menu( $schema[ 'configuration' ] ) ) {
            throw new Exception( 'menu could not be added' );
          }
        
        } catch ( Exception $e ) {
          // @todo: log to console (firebug)
          return false;
        }
        
        return true;
        
      }
      
      /**
       *
       *
       */
      private function add_menu( $config ) {
        
        $config = wp_parse_args( $config, array(
          'menu' => false,
        ) );
        
        return false;
      }
    
    }

  }

}