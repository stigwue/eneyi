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

### Headers

### Auth
Authorization parameters to be used.

### Method

The HTTP request method to make. This will be deduced from the request made to the proxy. A GET will be forwarded on as a GET. Same with POSTs.

### URL

Destination URL is appended to BASE_URL, a constant defined in file *config.php*.

### Data

The data forwarded on to the destination are the parameters provided to the proxy, save for authentication and headers.

## Supported requests

Eneyi supports GETs and POSTs. PUTs, not yet.
