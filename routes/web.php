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

$app->get('/swagger', function() { return view('swagger/index'); });

$app->group(['prefix' =>'/api'], function() use ($app){
    //Root api endpoint
    $app->get('/', 'ApiController@api_root');
    
    //products endpoint
    $app->get('products', 'ApiController@get_all_products');
    
    //products (specific item) endpoint
    $app->get('products/{id}',   'ApiController@get_product');
    $app->delete('products/{id}','ApiController@delete_product');
    $app->put('products',        'ApiController@create_new_product');
    $app->patch('products', 'ApiController@update_product');

    //products endpoint for testing
    $app->get('tests', 'ApiController@get_all_products');
    
    //product (specific item) endpoint for testing
    $app->get('tests/{id}',   'ApiController@get_product');
    $app->delete('tests/{id}','ApiController@delete_product');
    $app->put('tests',        'ApiController@create_new_product');
    $app->patch('tests', 'ApiController@update_product');
});