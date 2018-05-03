<?php

namespace Drupal\civicrm_tools;

use Drupal\civicrm\Civicrm;

/**
 * Class CiviCrmContact.
 */
class CiviCrmContact implements CiviCrmContactInterface, CiviCrmEntityFormatInterface {

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
   * Constructs a new CiviCrmContact object.
   */
  public function __construct(Civicrm $civicrm, CiviCrmApiInterface $civicrm_tools_api) {
    $this->civicrm = $civicrm;
    $this->civicrmToolsApi = $civicrm_tools_api;
  }

  /**
   * {@inheritdoc}
   */
  public function getFromSmartGroup($group_id, array $params) {
    // @todo fix naming single / multiple
    // Set as SmartGroup with value 1.
    $params['group'] = [$group_id => 1];
    return $this->civicrmToolsApi->getAll('Contact', $params);
  }

  /**
   * {@inheritdoc}
   */
  public function getFromGroups(array $groups) {
    $params['group'] = [
      'IN' => $groups,
    ];
    return $this->civicrmToolsApi->getAll('Contact', $params);
  }

  /**
   * {@inheritdoc}
   */
  public function getFromUserId($uid) {
    $result = [];
    $matches = $this->civicrmToolsApi->get('UFMatch', ['uf_id' => $uid]);
    if (!empty($matches)) {
      reset($matches);
      $contactId = $matches[key($matches)]['contact_id'];
      $contact = $this->civicrmToolsApi->get('Contact', ['contact_id' => $contactId]);
      if (!empty($contact)) {
        reset($contact);
        $result = $contact[key($contact)];
      }
    }
    return $result;
  }

  /**
   * {@inheritdoc}
   */
  public function getFromLoggedInUser() {
    $uid = \Drupal::currentUser()->id();
    return $this->getFromUserId($uid);
  }

  /**
   * {@inheritdoc}
   */
  public function labelFormat(array $values) {
    $result = [];
    foreach ($values as $key => $value) {
      $result[$key] = $value['display_name'];
    }
    return $result;
  }

}
