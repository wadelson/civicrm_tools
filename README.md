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

## Documentation

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
