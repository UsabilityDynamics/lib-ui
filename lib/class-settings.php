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

      public $settings;
      
      public $schema;
    
      /**
       * Constructor
       *
       * @param UsabilityDynamics\Settings object $settings
       * @param array $args
       */
      public function __construct( $settings, $schema ) {
        
        //** Break if settings var is incorrect */
        if( !is_subclass_of( $settings, 'UsabilityDynamics\Settings' ) ) {
          return;
        }
        $this->settings = $settings;
        
        //** Break if schema is incorrect */
        if( !$this->schema = $this->is_valid_schema( $schema ) ) {
          return;
        }
        
        //** Initializes settings UI */
        add_action( 'admin_menu', array( $this, 'admin_menu' ), 100 );
        
      }
      
      /**
       * Multiple actions (action on admin_menu hook):
       * - parse (validate) schema
       * - add settings page to menu
       * - add specific hooks
       *
       */
      public function admin_menu() {
        global $submenu, $menu;
        
        extract( $this->schema[ 'configuration' ] );
        
        $parent_slug = false;
        $capability = 'manage_options';
        
        // Maybe add main menu
        if ( $main_menu && is_string( $main_menu ) ) {
          if ( !isset( $submenu[ $main_menu ] ) ) {
            // Menu must exists if we pass the string.
            return false;
          }
          $parent_slug = $main_menu;
          // Maybe set the same capability for secondary menu as main menu has
          foreach( $menu as $item ) {
            if( $item[2] == $main_menu ) {
              $capability = $item[1];
              break;
            }
          }
        }  elseif ( $main_menu && is_array( $main_menu ) ) {
          extract( $main_menu = wp_parse_args( $main_menu, array(
            'page_title' => '',
            'menu_title' => '',
            'capability' => $capability,
            'menu_slug' => false,
            'icon_url' => '',
            'position' => 61,
          ) ) );
          add_menu_page( $page_title, $menu_title, $capability, $menu_slug, array( $this, 'render' ), $icon_url, $position );
          $parent_slug = $menu_slug;
        } else {
          return false;
        }
        
        //Maybe add secondary menu
        if ( $main_menu && is_array( $secondary_menu ) && isset( $parent_slug ) ) {
          extract( $secondary_menu = wp_parse_args( $secondary_menu, array(
            'parent_slug' => $parent_slug,
            'page_title' => '',
            'menu_title' => '',
            'capability' => $capability,
            'menu_slug' => '',
          ) ) );
          add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, array( $this, 'render' ) );
        }
        
      }
      
      /**
       * Render Settings page
       * 
       */
      public function render() {
        wp_enqueue_script( 'accordion' );
        
        $this->get_template_part( 'main' );
      }
      
      /**
       * Renders template part.
       * 
       */
      public function get_template_part( $name, $data = array() ) {
        if( is_array( $data ) ) {
          extract( $data );
        }
        $path = dirname( __DIR__ ) . '/templates/admin/' . $name . '.php';
        //echo "<pre>"; print_r( $path ); echo "</pre>"; die();
        if( file_exists( $path ) ) {
          include( $path );
        }
      }
      
      /**
       * 
       *
       */
      public function get( $key, $type = 'settings', $default = null ) {
        switch( $type ) {
          case 'settings':
            return $this->settings->get( $key, $default );
            break;
          case 'schema':
            // Resolve dot-notated key.
            if( strpos( $key, '.' ) ) {
              return $this->parse_schema( $key, $default );
            }
            // Return value or default.
            return isset( $this->schema[ $key ] ) ? $this->schema[ $key ] : $default;
            break;
        }
        return false;
      }
      
      /**
       * 
       *
       */
      public function get_fields( $v = false, $group = 'section' ) {
        return array();
      }
      
      /**
       * Validates schema
       * @todo: implement schema validator
       */
      private function is_valid_schema( $schema ) {
        return $schema;
      }
      
      /**
       * Resolve dot-notated key.
       *
       * @source http://stackoverflow.com/questions/14704984/best-way-for-dot-notation-access-to-multidimensional-array-in-php
       *
       * @param       $a
       * @param       $path
       * @param null  $default
       *
       * @internal param array $a
       * @return array|null
       */
      private function parse_schema( $path, $default = null ) {
        $current = $this->schema;
        $p = strtok( $path, '.' );
        while( $p !== false ) {
          if( !isset( $current[ $p ] ) ) {
            return $default;
          }
          $current = $current[ $p ];
          $p = strtok( '.' );
        }
        return $current;
      }
    
    }

  }

}