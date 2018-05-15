<?php

namespace Drupal\civicrm_tools;

/**
 * Interface CiviCrmDatabaseInterface.
 */
interface CiviCrmDatabaseInterface {

  /**
   * Executes a query straight from the CiviCRM database.
   *
   * Sets the connection to the CiviCRM database, that
   * must be declared as $databases['civicrm']['default'] in settings.php.
   * Example:
   *    $databases['civicrm']['default'] = [
   *      'database' => 'my_civicrm',
   *      'username' => 'root',
   *      'password' => 'root',
   *      'prefix' => '',
   *      'host' => '127.0.0.1',
   *      'port' => '3306',
   *      'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
   *      'driver' => 'mysql',
   *    ];
   *
   * @param string $query
   *   Query to execute.
   *   Example "SELECT * FROM {civicrm_contact} LIMIT 100;".
   *
   * @return array
   *   List of rows.
   */
  public function execute($query);

}
