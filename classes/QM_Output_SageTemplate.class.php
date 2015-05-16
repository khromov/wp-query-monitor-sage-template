<?php
/**
 * Output class
 *
 * Class QM_Output_IncludedFiles
 */
class QM_Output_SageTemplate extends QM_Output_Html {

  public function __construct( QM_Collector $collector ) {
    parent::__construct( $collector );

    add_filter( 'qm/output/menus', array( $this, 'admin_menu' ), 101 );
    add_filter( 'qm/output/title', array( $this, 'admin_title' ), 101 );
    add_filter( 'qm/output/menu_class', array( $this, 'admin_class' ) );
  }

  /**
   * Outputs data in the footer
   */
  public function output() {
    $data = $this->collector->get_data();
    ?>

    <!-- Print stats for included files -->
    <div class="qm" id="<?php echo esc_attr($this->collector->id())?>">
      <table cellspacing="0">
        <thead>
        <tr>
          <th scope="col">
            <?php echo __('Sage - main template:','query-monitor'); ?>
          </th>
          <th scope="col">
            <?php echo __('Sage - base template:','query-monitor'); ?>
          </th>
        </tr>
        </thead>
        <tbody>
          <tr>
            <td class="qm-ltr">
              <?php echo esc_html($data['template_full_path']); ?>
            </td>
            <td class="qm-ltr">
              <?php echo esc_html($data['template_base_full_path']); ?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <?php
  }

  /**
   * Adds data to top admin bar
   *
   * @param array $title
   *
   * @return array
   */
  public function admin_title( array $title ) {
    $data = $this->collector->get_data();

    if($data['template']) {
      $title[] = sprintf(
        _x( '<small>Sage template: </small>%s', 'sage template', 'sage_template' ),
        $data['template']
      );
    }

    return $title;
  }

  /**
   * @param array $class
   *
   * @return array
   */
  public function admin_class( array $class ) {
    $class[] = 'qm-sage_template';
    return $class;
  }

  public function admin_menu( array $menu ) {

    $data = $this->collector->get_data();
    if($data['template']) {
      $menu[] = $this->menu( array(
        'id'    => 'qm-sage_template',
        'href'  => '#qm-sage_template',
        'title' => sprintf( __( 'Sage main template: (%s)', 'query-monitor' ), $data['template'])
      ));

      $menu[] = $this->menu( array(
        'id'    => 'qm-sage_template',
        'href'  => '#qm-sage_template',
        'title' => sprintf( __( 'Sage base template: (%s)', 'query-monitor' ), $data['template_base'])
      ));
    }

    return $menu;
  }
}