<?php

namespace UsabilityDynamics\UI {

  if (!class_exists('UsabilityDynamics\UI\Field_Checkbox_Advanced')) {

    class Field_Checkbox_Advanced extends Field_Checkbox {

      /**
       * Get field HTML
       *
       * @param mixed $meta
       * @param array $field
       *
       * @return string
       */
      static public function html($meta, $field) {
        $desc = $field->desc ? "<span id='{$field->id}_description' class='description'>{$field->desc}</span>" : '';
        return sprintf(
          '<label><input type="hidden" name="%s" value="0"><input type="checkbox" class="uisf-checkbox" data-extra="%s" name="%s" id="%s" value="1" %s> %s</label>',
          $field->field_name,
          $field->extra,
          $field->field_name,
          $field->id,
          checked(!empty($meta), 1, false),
          $desc
        );
      }

    }
  }
}
