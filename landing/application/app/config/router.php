<?php

$router = $di->getRouter();

// Define your routes here

$router->handle($_SERVER['REQUEST_URI']);

$router->add(
    '/{link:[a-z]+}',
    [
        'controller' => 'view',
        'action' => 'index'
    ]
);
