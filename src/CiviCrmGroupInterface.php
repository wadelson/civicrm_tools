<?php

namespace Drupal\civicrm_tools;

/**
 * Interface CiviCrmGroupInterface.
 */
interface CiviCrmGroupInterface {

  /**
   * Get all groups for a contact.
   *
   * @param int $contact_id
   *   CiviCRM contact id.
   * @param bool $load
   *   Load the CiviCRM Group.
   *
   * @return array
   *   List of groups id's.
   */
  public function getGroupsFromContact($contact_id, $load);

}
