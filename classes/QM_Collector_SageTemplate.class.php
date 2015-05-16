<?php
/**
 * Data collector class
 */
class QM_Collector_SageTemplate extends QM_Collector {

  public $id = 'sage_template';
  public $data = array();

  public function name() {
    return __( 'Sage template', 'sage_template' );
  }

  public function process() {
    if(class_exists('\Roots\Sage\Wrapper\SageWrapping')) {
      global $template;

      $this->data['template_full_path'] = \Roots\Sage\Wrapper\SageWrapping::$main_template;
      $this->data['template'] = basename($this->data['template_full_path']);

      $this->data['template_base_full_path'] = (string)$template;
      $this->data['template_base'] = basename($this->data['template_base_full_path']);
    }
    else {
      $this->data['template'] = false;
    }
  }
}