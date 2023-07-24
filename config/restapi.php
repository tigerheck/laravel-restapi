<?php

return [

    /*
     * RestApi Base Url
     */
    'base_url' => env('RESTAPI_BASE_URL'),

    /*
    * the clientId is set from the portal to identify the application
    */
    'clientId' => env('RESTAPI_CLIENT_ID'),

    /*
    * set the application secret
    */

    'clientSecret' => env('RESTAPI_SECRET_ID'),

    /*
    set the token url
    */
    'urlAccessToken' => env('RESTAPI_URL_ACCESS_TOKEN', '/connect/token'),

    /*
    set the scopes to be used,
    */
    'scopes' => env('RESTAPI_SCOPES', 'api.cdcs api.nddr'),

    /*
    set the grant type
    */
    'grant_type' => env('RESTAPI_GRANT_TYPE', 'client_credentials'),

    /*
    set the access request data
    */
    'access_request_data' => [],
];
