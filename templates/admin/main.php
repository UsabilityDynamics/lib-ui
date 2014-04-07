<?php
/**
 * Settings page main template
 */
?>
<div class="wrap">
  <h2><?php echo $this->get( 'configuration.secondary_menu.page_title', 'schema' ); ?></h2>
  <div class="settings-content">
    <?php if( $this->get( 'menu', 'schema', false ) ) : ?>
      <?php foreach( $this->get( 'menu', 'schema' ) as $menu ) : ?>
        <?php $this->get_template_part( 'tab', array( 'menu' => $menu ) ); ?>
      <?php endforeach; ?>
    <?php else : ?>
      <div class="no-tabs">
        <?php foreach( $this->get( 'sections', 'schema', array() ) as $section ) : ?>
          <?php $this->get_template_part( 'section', array( 'section' => $section ) ); ?>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>