<?php

namespace Drupal\civicrm_tools;

use Drupal\civicrm\Civicrm;

/**
 * Class CiviCrmGroup.
 */
class CiviCrmGroup implements CiviCrmGroupInterface, CiviCrmEntityFormatInterface {

  /**
   * Drupal\civicrm\Civicrm definition.
   *
   * @var \Drupal\civicrm\Civicrm
   */
  protected $civicrm;

  /**
   * Drupal\civicrm_tools\CiviCrmApiInterface definition.
   *
   * @var \Drupal\civicrm_tools\CiviCrmApiInterface
   */
  protected $civicrmToolsApi;

  /**
   * Constructs a new CiviCrmGroup object.
   */
  public function __construct(Civicrm $civicrm, CiviCrmApiInterface $civicrm_tools_api) {
    $this->civicrm = $civicrm;
    $this->civicrmToolsApi = $civicrm_tools_api;
  }

  /**
   * {@inheritdoc}
   */
  public function labelFormat(array $values) {
    // TODO: Implement labelFormat() method.
    return [];
  }

}
