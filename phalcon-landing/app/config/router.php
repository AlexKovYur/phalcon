<?php

use Phalcon\Loader;

$router = $di->getRouter();

// Define your routes here

$router->handle($_SERVER['REQUEST_URI']);

$router->setDefaultController('index');
$router->setDefaultAction('index');

$router->add(
    '/{link:[a-z0-9]+}',
    [
        'namespace'  => 'App\Controllers',
        'controller' => 'link',
        'action' => 'index'
    ]
);