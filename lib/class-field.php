<?php
/**
 * Settings User Interface
 *
 * @author peshkov@UD
 */
namespace UsabilityDynamics\UI {

  if( !class_exists( 'UsabilityDynamics\UI\Field' ) ) {

    class Field {
    
      /**
       * Add actions
       *
       * @return void
       */
      static function add_actions() {}

      /**
       * Enqueue scripts and styles
       *
       * @return void
       */
      static function admin_enqueue_scripts( $field, $saved ) { 
        return null; 
      }

      /**
       * Show field HTML
       *
       * @param array $field
       * @param bool  $saved
       *
       * @return string
       */
      static function show( $field, $saved ) {
      
        call_user_func( array( get_called_class(), 'admin_enqueue_scripts' ), $field,  $saved );

        $group = '';	// Empty the clone-group field
        $type = $field['type'];
        $id   = $field['id'];

        $begin = call_user_func( array( get_called_class(), 'begin_html' ), $field[ 'value' ], $field );

        // Apply filter to field begin HTML
        // 1st filter applies to all fields
        // 2nd filter applies to all fields with the same type
        // 3rd filter applies to current field only
        $begin = apply_filters( 'ud::ui::field::begin_html', $begin, $field, $field[ 'value' ] );
        $begin = apply_filters( "ud::ui::field::{$type}_begin_html", $begin, $field, $field[ 'value' ] );
        $begin = apply_filters( "ud::ui::field::{$id}_begin_html", $begin, $field, $field[ 'value' ] );

        // Separate code for cloneable and non-cloneable fields to make easy to maintain

        // Cloneable fields
        if ( $field['clone'] )
        {
          if ( isset( $field['clone-group'] ) )
            $group = " clone-group='{$field['clone-group']}'";

          $field[ 'value' ] = (array) $field[ 'value' ];

          $field_html = '';

          foreach ( $field[ 'value' ] as $index => $sub_meta )
          {
            $sub_field = $field;
            $sub_field['field_name'] = $field['field_name'] . "[{$index}]";
            if ( $field['multiple'] )
              $sub_field['field_name'] .= '[]';

            // Wrap field HTML in a div with class="uisf-clone" if needed
            $input_html = '<div class="uisf-clone">';

            // Call separated methods for displaying each type of field
            $input_html .= call_user_func( array( get_called_class(), 'html' ), $sub_meta, $sub_field );

            // Apply filter to field HTML
            // 1st filter applies to all fields with the same type
            // 2nd filter applies to current field only
            $input_html = apply_filters( "ud::ui::field::{$type}_html", $input_html, $field, $sub_meta );
            $input_html = apply_filters( "ud::ui::field::{$id}_html", $input_html, $field, $sub_meta );

            // Add clone button
            $input_html .= self::clone_button();

            $input_html .= '</div>';

            $field_html .= $input_html;
          }
        }
        // Non-cloneable fields
        else
        {
          // Call separated methods for displaying each type of field
          $field_html = call_user_func( array( get_called_class(), 'html' ), $field[ 'value' ], $field );

          // Apply filter to field HTML
          // 1st filter applies to all fields with the same type
          // 2nd filter applies to current field only
          $field_html = apply_filters( "ud::ui::field::{$type}_html", $field_html, $field, $field[ 'value' ] );
          $field_html = apply_filters( "ud::ui::field::{$id}_html", $field_html, $field, $field[ 'value' ] );
        }

        $end = call_user_func( array( get_called_class(), 'end_html' ), $field[ 'value' ], $field );

        // Apply filter to field end HTML
        // 1st filter applies to all fields
        // 2nd filter applies to all fields with the same type
        // 3rd filter applies to current field only
        $end = apply_filters( 'ud::ui::field::end_html', $end, $field, $field[ 'value' ] );
        $end = apply_filters( "ud::ui::field::{$type}_end_html", $end, $field, $field[ 'value' ] );
        $end = apply_filters( "ud::ui::field::{$id}_end_html", $end, $field, $field[ 'value' ] );

        // Apply filter to field wrapper
        // This allow users to change whole HTML markup of the field wrapper (i.e. table row)
        // 1st filter applies to all fields with the same type
        // 2nd filter applies to current field only
        $html = apply_filters( "ud::ui::field::{$type}_wrapper_html", "{$begin}{$field_html}{$end}", $field, $field[ 'value' ] );
        $html = apply_filters( "ud::ui::field::{$id}_wrapper_html", $html, $field, $field[ 'value' ] );

        // Display label and input in DIV and allow user-defined classes to be appended
        $classes = array( 'uisf-field', "uisf-{$type}-wrapper" );
        if ( 'hidden' === $field['type'] )
          $classes[] = 'hidden';
        if ( !empty( $field['required'] ) )
          $classes[] = 'required';
        if ( !empty( $field['class'] ) )
          $classes[] = $field['class'];

        printf(
          $field['before'] . '<div class="%s"%s>%s</div>' . $field['after'],
          implode( ' ', $classes ),
          $group,
          $html
        );
      }

      /**
       * Get field HTML
       *
       * @param mixed $value
       * @param array $field
       *
       * @return string
       */
      static function html( $value, $field ) {
        return '';
      }

      /**
       * Show begin HTML markup for fields
       *
       * @param mixed $value
       * @param array $field
       *
       * @return string
       */
      static function begin_html( $value, $field ) {
        if ( empty( $field[ 'name' ] ) ) {
          return '<div class="uisf-input">';
        }

        return sprintf(
          '<div class="uisf-label">
            <label for="%s">%s</label>
          </div>
          <div class="uisf-input">',
          $field['id'],
          $field['name']
        );
      }

      /**
       * Show end HTML markup for fields
       *
       * @param mixed $value
       * @param array $field
       *
       * @return string
       */
      static function end_html( $value, $field ) {
        $id = $field[ 'id' ];

        $button = '';
        if ( $field[ 'clone' ] )
          $button = '<a href="#" class="uisf-button button-primary add-clone">' . __( '+' ) . '</a>';

        $desc = !empty( $field[ 'desc' ] ) ? "<p id='{$id}_description' class='description'>{$field['desc']}</p>" : '';

        // Closes the container
        $html = "{$button}{$desc}</div>";

        return $html;
      }

      /**
       * Add clone button
       *
       * @return string $html
       */
      static function clone_button() {
        return '<a href="#" class="uisf-button button remove-clone">' . __( '&#8211;' ) . '</a>';
      }

      /**
       * Normalize parameters for field
       *
       * @param array $field
       *
       * @return array
       */
      static function normalize_field( $field ) {
        return $field;
      }
      
    }
    
  }

}