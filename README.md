# CiviCRM API

Nothing more than a CiviCRM API wrapper.
The code is originally extracted from the 
[CiviCRM Entity](http://drupal.org/project/civicrm_entity) module
and is subject to evolve by  
- implementing other methods like _clone_, _getTokens_, _getSingle_, ...
- defining API version (currently v3)
- providing syntactic sugar over the API for complex relations
- providing default exception handlers.

It has started as a separation of concern, because in some situations 
the Drupal entities may not be necessary.

## Documentation

The API is available as a Drupal service.

```
// Prefer dependency injection.
$civiCrmApi = \Drupal::service('civicrm_api');
```

### Get 

```
$params = [
  'email' => 'donald@example.com',
];
$result = $civicrmApi->get('Contact', $params);
```

### Create

```
$params = [
  'first_name' => 'Elijah',
  'last_name' => 'Baley',
  'contact_type' => 'Individual',
]
$result = $civicrmApi->create('Contact', $params);
```

### Delete

```
$params = [
  'id' => 42,
];
$result = $civicrmApi->delete('Contact', $params);
```
