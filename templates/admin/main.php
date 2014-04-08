<?php
/**
 * Settings page main template
 */
?>
<div class="wrap">
  <h2><?php echo $this->get( 'configuration.secondary_menu.page_title', 'schema' ); ?></h2>
  <div class="settings-content">
    <form id="uis_form" action="" method="post" >
      <?php wp_nonce_field( 'ui_settings' ); ?>
      <?php if( $this->get( 'menu', 'schema', false ) ) : ?>
        <div class="tabs-wrap">
          <?php foreach( $this->get( 'menu', 'schema' ) as $menu ) : ?>
            <?php $this->get_template_part( 'tab', array( 'menu' => $menu ) ); ?>
          <?php endforeach; ?>
        </div>
      <?php else : ?>
        <div class="no-tabs">
          <?php $this->get_template_part( 'tab', array( 'menu' => false ) ); ?>
        </div>
      <?php endif; ?>
      <?php submit_button( __( 'Submit' ), 'button' ); ?>
    </form>
  </div>
</div>