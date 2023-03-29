<?php 

$router->get('/', 'App\Controllers\ProductController@index');
$router->get('/product/(\d+)', 'App\Controllers\ProductController@detail');



//User Route
$router->get('/login', 'App\Controllers\UserController@login');
$router->get('/register', 'App\Controllers\UserController@register');
$router->post('/register','App\Controllers\UserController@signUp');

$router->get('/logout','App\Controllers\UserController@logout');
$router->post('/login', 'App\Controllers\UserController@signIn');

//Cart
$router->get('/cart', 'App\Controllers\CartController@index');
$router->post('/cart-add', 'App\Controllers\CartController@store');
$router->post('/updateqty', 'App\Controllers\CartController@updateqty');

//Order
$router->get('/order', 'App\Controllers\OrderController@index');
$router->post('/proccess', 'App\Controllers\OrderController@process');
