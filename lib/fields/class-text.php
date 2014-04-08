<?php

namespace UsabilityDynamics\UI {

  if ( ! class_exists( 'UsabilityDynamics\UI\Field_Text' ) ) {
  
    class Field_Text extends Field {
    
      /**
       * Get field HTML
       *
       * @param mixed  $value
       * @param array  $field
       *
       * @return string
       */
      static function html( $value, $field ) {
        return sprintf(
          '<input type="text" class="sui-text" name="%s" id="%s" value="%s" placeholder="%s" size="%s" %s>%s',
          $field[ 'field_name' ],
          $field[ 'id' ],
          $value,
          $field[ 'placeholder' ],
          $field[ 'size' ],
          !$field[ 'datalist' ] ?  '' : "list='{$field[ 'datalist' ][ 'id' ]}'",
          self::datalist_html( $field )
        );
      }

      /**
       * Normalize parameters for field
       *
       * @param array $field
       *
       * @return array
       */
      static function normalize_field( $field ) {
        $field = wp_parse_args( $field, array(
          'size'        => 30,
          'datalist'    => false,
          'placeholder' => '',
        ) );
        return $field;
      }

      /**
       * Create datalist, if any
       *
       * @param array $field
       *
       * @return array
       */
      static function datalist_html( $field ) {
        if( !$field[ 'datalist' ] ) {
          return '';
        }
        $datalist = $field['datalist'];
        $html = sprintf( '<datalist id="%s">', $datalist[ 'id' ] );

        foreach( $datalist[ 'options' ] as $option ) {
          $html.= sprintf( '<option value="%s"></option>', $option );
        }

        $html .= '</datalist>';

        return $html;
      }
      
    }
    
  }

}
