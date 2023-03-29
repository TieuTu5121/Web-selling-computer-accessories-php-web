<?php 

$router->get('/', 'App\Controllers\ProductController@index');
$router->get('/product/(\d+)', 'App\Controllers\ProductController@detail');
$router->post('/cart-add', 'App\Controllers\CartController@store');




//User Route
$router->get('/register', 'App\Controllers\UserController@register');
$router->post('/register','App\Controllers\UserController@signUp');
$router->get('/login', 'App\Controllers\UserController@login');
$router->get('/logout','App\Controllers\UserController@logout');

