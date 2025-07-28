<?php

use App\Core\Router;

$router = new Router();

// Shopping List Routes
$router->add('GET', '/api/items', 'ItemController@index');
$router->add('POST', '/api/items', 'ItemController@store');
$router->add('PUT', '/api/items', 'ItemController@update');
$router->add('DELETE', '/api/items', 'ItemController@destroy');
$router->add('PATCH', '/api/items/toggle', 'ItemController@toggle');

return $router;
