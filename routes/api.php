<?php

use Illuminate\Support\Facades\Route;
/*
 * Api Routes
 */

Route::group([
    'namespace' => 'Api',
    'prefix' => 'v1',
], function () {
    includeRouteFiles(__DIR__ . '/api/');
});