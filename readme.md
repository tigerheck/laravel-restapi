# Laravel RestApi Wrapper

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tigerheck/laravel-restapi.svg?style=flat-square)](https://packagist.org/packages/tigerheck/laravel-restapi)
[![Total Downloads](https://img.shields.io/packagist/dt/tigerheck/laravel-restapi.svg?style=flat-square)](https://packagist.org/packages/tigerheck/laravel-restapi)


**A Laravel wrapper for RestApi API.**

## Install

Via Composer

``` bash
$ composer require tigerheck/laravel-restapi
```


## Configuration

Laravel RestApi requires connection configuration. To get started, you'll need to publish all vendor assets:

```bash
$ php artisan vendor:publish --provider="TigerHeck\RestApi\RestApiServiceProvider"
```

add Your enviroment configuraiton file
```
RESTAPI_BASE_URL=
RESTAPI_CLIENT_ID=
RESTAPI_SECRET_ID=
RESTAPI_URL_ACCESS_TOKEN="/connect/token"
RESTAPI_SCOPES="********"
RESTAPI_GRANT_TYPE="client_credentials"
```
## Examples with app("restapi")->http()

GET 
```
$response = app("restapi")->http()->get("/api/get/url", [
    'param1' => $param1,
    'param2' => 'param2',
]);
```

POST
```
$response = app("restapi")->http()->post("/api/post/url", [
    'data1'             => $data1,
    'data2'             => $data2,
    'data3'             => $data3,
]);
```

PUT
```
$response = app("restapi")->http()->put("/api/post/url/{$id}", [
    'data1'             => $data1,
    'data2'             => $data2,
    'data3'             => $data3,
]);
```

Delete
```
$response = app("restapi")->http()->delete("/api/delete/url/{$id}");
```
