<?php

namespace Drupal\civicrm_api;

use Drupal\civicrm\Civicrm;

/**
 * Class CiviCRM API.
 */
class CiviCrmApi implements CiviCrmApiInterface {

  /**
   * The CiviCRM service.
   *
   * @var \Drupal\civicrm\Civicrm
   */
  protected $civicrm;

  /**
   * Constructs a CiviCrmApi object.
   *
   * @param \Drupal\civicrm\Civicrm $civicrm
   *   The CiviCRM service.
   */
  public function __construct(Civicrm $civicrm) {
    $this->civicrm = $civicrm;
  }

  /**
   * {@inheritdoc}
   */
  public function get($entity_id, array $params = []) {
    $this->initialize();
    $result = civicrm_api3($entity_id, 'get', $params);
    return $result['values'];
  }

  /**
   * {@inheritdoc}
   */
  public function delete($entity_id, array $params) {
    $this->initialize();
    $result = civicrm_api3($entity_id, 'delete', $params);
    return $result['values'];
  }

  /**
   * {@inheritdoc}
   */
  public function create($entity_id, array $params) {
    $this->initialize();
    $result = civicrm_api3($entity_id, 'create', $params);
    return $result;
  }

  /**
   * {@inheritdoc}
   */
  public function save($entity_id, array $params) {
    return $this->create($entity_id, $params);
  }

  /**
   * {@inheritdoc}
   */
  public function getFields($entity_id, $action = '') {
    $this->initialize();
    $result = civicrm_api3($entity_id, 'getfields', [
      'sequential' => 1,
      'action' => $action,
    ]);
    return $result['values'];
  }

  /**
   * {@inheritdoc}
   */
  public function getOptions($entity_id, $field_name) {
    $this->initialize();
    $result = civicrm_api3($entity_id, 'getoptions', ['field' => $field_name]);
    return $result['values'];
  }

  /**
   * Ensures that CiviCRM is loaded and API function available.
   */
  protected function initialize() {
    if (!function_exists('civicrm_api3')) {
      $this->civicrm->initialize();
    }
  }

}
