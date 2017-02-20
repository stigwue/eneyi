# Eneyi

Eneyi is a simple PHP application to forward on requests to an endpoint.

## Parameters

### Provided

*Headers*

*Auth*

Authorization parameters to be used.

### Deduced

*Method*

The HTTP request method to make. Will be deduced from

```php
$_SERVER['REQUEST_METHOD']
```

*URL*

Constant provided in file *config.php*.

*Data*

The data forwarded on to the destination.

## Supported requests

Eneyi supports GETs and POSTs. PUTs, not yet.
