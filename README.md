# CiviCRM Tools

Currently nothing more than a CiviCRM API wrapper for Drupal 8.
The code is originally extracted from the 
[CiviCRM Entity](http://drupal.org/project/civicrm_entity) module.
It has started as a separation of concern and is subject to evolve by  
- implementing other methods like _clone_, _getTokens_, _getSingle_, ...
- defining API version (currently v3)
- providing pagination helpers
- providing syntactic sugar over the API for complex relations
- providing default exception handlers.

## API Documentation

The API is available as a Drupal service.

```
// Prefer dependency injection.
$civiCrmApi = \Drupal::service('civicrm_tools.api');
```

### Get 

```
$params = [
  'email' => 'donald@example.com',
];
$result = $civiCrmApi->get('Contact', $params);
```

### Create

```
$params = [
  'first_name' => 'Elijah',
  'last_name' => 'Baley',
  'contact_type' => 'Individual',
]
$result = $civiCrmApi->create('Contact', $params);
```

### Delete

```
$params = [
  'id' => 42,
];
$result = $civiCrmApi->delete('Contact', $params);
```

## Syntactic sugar

Some other services are on their way.

### Contact

```
// Prefer dependency injection.
$civiCrmContact = \Drupal::service('civicrm_tools.contact');
$civiCrmContact->getFromSmartGroup(42, []);
$civiCrmContact->getFromGroups([1,2]);
// User id and domain id
$civiCrmContact->getFromUserId(1, 1);
// Domain id
$civiCrmContact->getFromLoggedInUser(1);
// Contact id and domain id
$civiCrmContact->getUserFromContactId(1, 1);
```

### Group

```
// Prefer dependency injection.
$civiCrmGroup = \Drupal::service('civicrm_tools.group');
// Contact id, load: get the full group array or only the group id
$civiCrmGroup->getGroupsFromContact(1, TRUE);
```

### Database

Prerequisite: add the CiviCRM database reference in your Drupal _settings.php_

```
$databases['civicrm']['default'] = array (
  'database' => 'civicrm_db_name',
  'username' => 'civicrm_db_user',
  'password' => 'civicrm_db_password',
  'prefix' => '',
  'host' => '127.0.0.1',
  'port' => '3306',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver' => 'mysql',
);
```

Then

```
// Prefer dependency injection.
$civiCrmDatabase = \Drupal::service('civicrm_tools.database');
$query = 'SELECT * FROM {civicrm_log}';
$result = $civiCrmDatabase->execute($query);
```

Or

```
// Switch to a custom CiviCRM database.
Database::setActiveConnection('civicrm');
$db = Database::getConnection();
$query = $db->query("SELECT group_id FROM {civicrm_group_contact} WHERE contact_id = :contact_id AND status = :status", [
  ':contact_id' => $contact_id,
  ':status' => 'Added',
]);
$queryResult = $query->fetchAll();
// Switch back to the default database (Drupal).
Database::setActiveConnection();
```


## Expose CiviCRM and Drupal related entities via REST

The _CiviCRM Tools REST_ sub module aims to provide several endpoints for 
CiviCRM and Drupal entities.
It could also make use of entity Normalizer, ... to provide fields for JSON API, and core REST.

Currently, the only available endpoint gets Drupal users by CiviCRM group.

Possible use cases:

- a callback for a Single Sign On application, that provides a set of permissions based on the CiviCRM Group.
- a decoupled application
- ...

### Get Drupal users by CiviCRM group

**/api/civicrm_tools/users/group/{group_id}**

Authenticate with BasicAuth.
The authenticated user needs the permission to view user profiles.

Usage

```
curl --include --request GET --user admin:admin --header 'Content-type: application/json' http://example.com/api/civicrm_tools/users/group/42
```
