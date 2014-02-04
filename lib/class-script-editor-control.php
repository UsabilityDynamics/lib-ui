<?php
/**
 * Script Editor Customizer
 *
 * @version 1.0.0
 */
namespace UsabilityDynamics\UI {

  /**
   * Class Script_Editor_Control
   *
   * @package UsabilityDynamics\UI
   */
  class Script_Editor_Control extends \WP_Customize_Control {

    /**
     * @var string
     *
     */
    public $type = 'textarea';

    /**
     * Render Textarea Input
     *
     */
    public function render_content() {

      echo join( '', array(
        '<div id="udx-script-editor-wrapper" class="udx-customization-editor" data-require="ui.wp.editor.script"></div>',
        '<textarea id="udx-script-editor" rows="15" style="width:100%;" ',
        $this->get_link(),
        '>',
        esc_textarea( $this->value() ),
        '</textarea>',
      ));

    }

  }

}

