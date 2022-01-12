<?php

use App\Controllers\JsonRPC\Router;

$router = new Router();

//$router = $di->getRouter();

// Define your routes here

    $router->handle($_SERVER['REQUEST_URI']);
