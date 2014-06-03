<?php
/**
 * Panel
 *
 * @author potanin@UD
 */
namespace UsabilityDynamics\UI {

  if( !class_exists( 'UsabilityDynamics\UI\Panel' ) ) {

    /**
     * Class Panel
     *
     */
    class Panel {

      public static $headers = array(
        'name' => 'Name',
        'description' => 'Description',
        'group' => 'Group',
        'version' => 'Version',
        'author' => 'Author'
      );

      private $_settings;

      /**
       * Create Panel.
       *
       * @param null  $id
       * @param array $settings
       */
      public function __construct( $id = null, $settings = array() ) {

        $this->_settings = array(
          '_id' => $id,
          'paths' => null,
          'data' => null
        );

        $this->_settings[ '_id' ]     = $this->_settings[ '_id' ] ? $this->_settings[ '_id' ] : $id;
        $this->_settings[ '_path' ]   = $this->resolve_path( $settings[ 'paths' ] );
        $this->_settings[ 'data' ]    = $this->get_file_data();
        $this->_settings[ 'params' ]  = array();

        $this->set(array(
          '_id' => $this->_settings[ '_id' ],
          '_path' => $this->_settings[ '_path' ]
        ));

      }

      /**
       * Get File Data from first found file.
       *
       * @param array $paths
       *
       * @return array
       */
      private function get_file_data( $paths = array() ) {

        foreach( (array) ( $paths ? $paths : $this->_settings[ '_path' ] ) as $path ) {

          if( !is_file( $path ) ) {
            continue;
          }

          $_data = get_file_data( $path, self::$headers );

          if( $_data[ 'name' ] ) {
            return array_filter( $_data );
          }

        }

        return array();

      }

      /**
       * Resolve / Verify Paths.
       *
       * @param array $paths
       *
       * @return array
       */
      private function resolve_path( $paths = array() ) {

        foreach( (array) $paths as $path ) {

          if( is_dir( $path ) ) {

            $absolute_path = wp_normalize_path( trailingslashit( $path ) . $this->_settings[ '_id' ] . '.php' );

            if( is_file( $absolute_path ) ) {
              return $absolute_path;
            }

          }

        }

      }

      /**
       * Prepare Parametrs for Template
       *
       * @param array $args
       *
       * @return object
       */
      private function set( $args = array() ) {

        return $this->_settings[ 'params' ] = (object) array_merge_recursive( (array) $this->_settings[ 'params' ], (array) $args );

      }

      /**
       * Parameter Lookup
       * 
       * @param null $key
       *
       * @return mixed
       */
      private function get( $key = null ) {
        return $key ? $this->_settings[ 'params' ]->{$key} : $this->_settings[ 'params' ];
      }

      /**
       * JSON Output
       *
       * @param null $extra
       */
      public function json( $extra = null ) {
        $this->set( $extra );

        echo '<pre>';
        echo json_encode( $this->get() );
        echo '</pre>';
      }

      /**
       * Standard HTML5 Render
       * @param null $extra
       */
      public function render( $extra = null ) {
        $this->set( $extra );

        echo '<section data-panel="' . $this->get( '_id' ) . '">';
        include( $this->_settings[ '_path' ] );
        echo '</section>';

      }

      /**
       * Metabox Render
       *
       * @param null $args
       */
      public function meta_box( $args = null ) {

        $this->set( $extra );

        echo '<div data-panel="' . $this->get( '_id' ) . '">';
        include( $this->_settings[ '_path' ] );
        echo '</div>';

      }

    }

  }

}