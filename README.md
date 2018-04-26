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
