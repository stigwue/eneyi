# Eneyi

Eneyi is a simple PHP application to forward on requests to an endpoint.

## Setup
### 1. Clone
```
git clone https://github.com/stigwue/eneyi.git
```
### 2. Composer
```
cd eneyi && composer install
```
### 3. Configure
```
nano config.php #BASE_URL value
```

### Launch

Carry on with your application! See parameters for details.

## Parameters

Note that Eneyi, as a proxy, will assume that parameters with a *__* prefix is solely for it and will strip them from the onward parameters.

### url (__url)

Destination URL is appended to *BASE_URL*, a constant defined in *config.php*. You might set BASE_URL to an empty string and define URL per request.

### authorization (__authorization)

**Not yet implemented**. Authorization parameters to be used.

### method (__method)

The HTTP request method to make. This can also be deduced from the request made to the proxy: a GET will be forwarded on as a GET. Same with POSTs.

### Data

The data forwarded on to the destination are the parameters provided to the proxy, save for *__* prefixed ones. This includes headers. Note that a POST request will read supplied POST parameters. Same goes for a GET.

## Supported requests

Eneyi supports GETs and POSTs. PUTs and DELETEs, not yet.

## TODO

- Add support for PUT requests.

- Add support for DELETE requests.

- Add support for authorization? Or allowed to be supplied as header?

- Add some phpunit testing?
