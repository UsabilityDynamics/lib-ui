<?php
/**
 *
 */
namespace UsabilityDynamics\UI {

  /**
   * Class Style_Editor_Control
   *
   * @package UsabilityDynamics\UI
   */
  class Style_Editor_Control extends \WP_Customize_Control {

    /**
     * @var string
     */
    public $type = 'textarea';

    /**
     * Render Textarea Input
     *
     */
    public function render_content() {

      echo join( '', [
        '<label data-control="style-editor" class="style-editor-control">',
          '<textarea rows="10" style="width:100%;" data-controls="styles">',
            esc_textarea( $this->value() ),
          '</textarea>',
        '</label>'
      ]);

    }

  }

}

