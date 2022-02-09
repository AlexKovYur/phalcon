<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    [
        $config->application->modelsDir
    ]
)->register();

$loader->registerNamespaces(
    [
        'App\Controllers' => APP_PATH . '/controllers/',
        'App\Controllers\JsonRPC' => APP_PATH . '/controllers/JsonRPC/',
        'App\Exceptions' => APP_PATH . '/exceptions/',
        'App\Includes' => APP_PATH . '/includes/',
        'App\Models' => APP_PATH . '/models/'
    ]
)->register();


