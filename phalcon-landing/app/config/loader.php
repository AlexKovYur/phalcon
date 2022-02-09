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
        'App\Controllers' => __DIR__ . '/../controllers/',
        'Phalcon' => APP_PATH . '/library/'
    ]
)->register();