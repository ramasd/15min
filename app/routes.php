<?php

$router->get('', 'HomeController@index');
$router->get('articles', 'ArticlesController@index');
$router->post('articles', 'ArticlesController@store');
$router->post('content', 'ArticlesController@storeContent');
