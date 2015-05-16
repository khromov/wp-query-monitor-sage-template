<?php
/**
 * Plugin Name: Query Monitor: Sage Template
 * Description: Shows the active Sage Template in use. (Base and main)
 * Version: 1.0
 * Author: khromov
 * GitHub Plugin URI: khromov/wp-query-monitor-sage-template
 */

add_action('plugins_loaded', function() {
  /**
   * Register collector, only if Query Monitor is enabled.
   */
  if(class_exists('QM_Collectors')) {
    include 'classes/QM_Collector_SageTemplate.class.php';

    QM_Collectors::add( new QM_Collector_SageTemplate() );
  }

  /**
   * Register output. The filter won't run if Query Monitor is not
   * installed so we don't have to explicity check for it.
   */
  add_filter( 'qm/outputter/html', function(array $output, QM_Collectors $collectors) {
    include 'classes/QM_Output_SageTemplate.class.php';
    if ( $collector = QM_Collectors::get( 'sage_template' ) ) {
      $output['sage_template'] = new QM_Output_SageTemplate( $collector );
    }
    return $output;
  }, 101, 2 );
});
