<?php

use App\Controllers\JsonRPC\Router;

$router = new Router();

$router->handle($_SERVER['REQUEST_URI']);
