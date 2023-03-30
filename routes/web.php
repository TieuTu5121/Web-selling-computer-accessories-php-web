<?php 

$router->get('/', 'App\Controllers\ProductController@index');
$router->get('/product/(\d+)', 'App\Controllers\ProductController@detail');

// Cart route
$router->post('/product/(\d+)', 'App\Controllers\CartController@addCart');



//User Route
$router->get('/register', 'App\Controllers\UserController@register');
$router->post('/register','App\Controllers\UserController@signUp');

$router->get('/logout','App\Controllers\UserController@logout');

$router->get('/login', 'App\Controllers\UserController@login');
$router->post('/login', 'App\Controllers\UserController@signIn');

$router->get('/order', 'App\Controllers\OrderController@index');
$router->post('/proccess', 'App\Controllers\OrderController@process');

