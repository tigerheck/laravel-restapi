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

Add `RESTAPI_BASE_URL=` and `RESTAPI_API_KEY=` to your enviroment configuraiton file

## Examples with \Http::restapi()

GET 
```
$response = \Http::restapi()->get("/api/get/url", [
    'param1' => $param1,
    'param2' => 'param2',
]);
```

POST
```
$response = \Http::restapi()->post("/api/post/url", [
    'data1'             => $data1,
    'data2'             => $data2,
    'data3'             => $data3,
]);
```

PUT
```
$response = \Http::restapi()->put("/api/post/url/{$id}", [
    'data1'             => $data1,
    'data2'             => $data2,
    'data3'             => $data3,
]);
```

Delete
```
$response = \Http::restapi()->delete("/api/delete/url/{$id}");
```
