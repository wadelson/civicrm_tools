<?php

namespace Drupal\civicrm_tools;

/**
 * Interface CiviCrmContactInterface.
 */
interface CiviCrmContactInterface {

  /**
   * Get all contacts from a single Smart Groups.
   *
   * @param string $group_id
   *   CiviCRM smart group id.
   * @param array $params
   *   Optional parameters.
   *
   * @return array
   *   List of values.
   */
  public function getFromSmartGroup($group_id, array $params);

  /**
   * Get all contacts from a list of Groups.
   *
   * @param array $groups
   *   CiviCRM list of Group id's.
   *
   * @return array
   *   List of contacts.
   */
  public function getFromGroups(array $groups);

}
