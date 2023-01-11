<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Ingrese aquí la página de pago de Flow
    |--------------------------------------------------------------------------
    |
    | Ejemplo:
    | Sitio de pruebas = https://sandbox.flow.cl/api
    | Sitio de producción = https://www.flow.cl/api
    |
    */

    'url' => env('FLOW_URL', 'https://sandbox.flow.cl/api'),

    /*
    |--------------------------------------------------------------------------
    | Ingrese aquí su llave APIKey
    |--------------------------------------------------------------------------
    */

    'api_key' => env('FLOW_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Ingrese aquí su llave SecretKey
    |--------------------------------------------------------------------------
    */

    'secret_key' => env('FLOW_SECRET_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Ingrese aquí la url de retorno luego del pago
    |--------------------------------------------------------------------------
    |
    | Valores posibles
    | 'http://www.sitioweb.cl/flow/return',
    | ['url' => 'flow/return'],
    | ['route' => 'flow.return'],
    */

    'url_return' => ['route' => 'flow.return'],

    /*
    |--------------------------------------------------------------------------
    | Ingrese aquí la url de confirmación de flow
    |--------------------------------------------------------------------------
    |
    | Valores posibles
    | 'http://www.sitioweb.cl/flow/confirmation',
    | ['url' => 'flow/confirmation'],
    | ['route' => 'flow.confirmation'],
    */

    'url_confirmation' => ['url' => 'flow/confirmation'],
];
