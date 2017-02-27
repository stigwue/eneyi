# Eneyi

Eneyi is a simple PHP application to forward on requests to an endpoint.

## Setup
### 1. Clone
```
git clone https://github.com/stigwue/eneyi.git fake_api
```
### 2. Composer
```
cd fake_api && composer install
```
### 3. Configure
```
nano config.php #BASE_URL value
```

### Launch

Carry on with your application! See parameters for details.

## Parameters

Note that Eneyi, as a proxy, will assume that parameters with a *__* prefix is solely for it and will strip them from the onward parameters.

### Headers
Any desired headers to be used for the request.

### Auth
Authorization parameters to be used.

### Method

The HTTP request method to make. This will be deduced from the request made to the proxy. A GET will be forwarded on as a GET. Same with POSTs.

### URL

Destination URL is appended to BASE_URL, a constant defined in file *config.php*. You might set BASE_URL to an empty string and define URL per request.

### Data

The data forwarded on to the destination are the parameters provided to the proxy, save for *__* prefixed ones.

## Supported requests

Eneyi supports GETs and POSTs. PUTs and DELETEs, not yet.

## TODO

Add support for PUT and DELETE requests. Add some phpunit testing.
