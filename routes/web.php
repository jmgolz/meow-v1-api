<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->group(['prefix' =>'api'], function() use ($app){
    $app->get('/', 'ApiController@api_root');
    
    //products endpoint
    $app->get('products', 'ApiController@get_all_products');
    
    //product (specific) endpoint
    $app->get('product/{id}',   'ApiController@get_product');
    $app->put('product',        'ApiController@create_new_product');
    $app->patch('product/{id}',      'ApiController@update_product');
    $app->delete('product/{id}',     'ApiController@delete_product');
});