<?php

namespace Drupal\civicrm_tools;

use Drupal\Core\Database\Database;

/**
 * Class CiviCrmGroup.
 */
class CiviCrmDatabase implements CiviCrmDatabaseInterface {

  /**
   * {@inheritdoc}
   */
  public function execute($query) {
    // @todo add placeholders
    // @todo test database settings
    // Get a connection to the CiviCRM database.
    Database::setActiveConnection('civicrm');
    $db = Database::getConnection();
    // @todo check possible security issue here
    $query = $db->query($query);
    $result = $query->fetchAll();
    // Switch back to the default database.
    Database::setActiveConnection();
    return $result;
  }

}
