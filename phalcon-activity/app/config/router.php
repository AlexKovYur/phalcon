<?php

$router = $di->getRouter();

// Define your routes here

$router->handle($_SERVER['REQUEST_URI']);

try {

    /**
     * Setup autoloader
     */
    $paths = [
        'app/controllers/',
        'app/models/',
        'library/',
    ];

    $loader = new \Phalcon\Loader();
    $loader->registerDirs($paths)
        ->register();

    /**
     * Dependency injection
     */
    $di = new \Phalcon\DI();

    // Router
    $di->setShared('router', 'JsonRPC\Router');

    // Dispatcher
    $di->setShared('dispatcher', 'Phalcon\Mvc\Dispatcher');

    // Http\Request
    $di->setShared('request', 'Phalcon\Http\Request');

    // Http\Response
    $di->setShared('response', 'Phalcon\Http\Response');

    // JsonRPC\Request
    $di->setShared('jsonrpcRequest', function() {
        $request = Phalcon\DI::getDefault()->getShared('request');
        $body    = $request->getRawBody();
        $request = JsonRPC\Request::fromString($body);
        return $request;
    });

    // JsonRPC\Response
    $di->setShared('jsonrpcResponse', 'JsonRPC\Response');

    /**
     * magic here
     */
    $router = $di->getShared('router');
    $router->handle();

    /**
     * or different use case
     */
    //$router = $di->getShared('router');
    //$router->handle('{"jsonrpc" : "2.0", "id" : 1, "method" : "tests.index", "params" : {}}');

} catch (\Exception $e) {
    $response = new JsonRPC\Response();
    $response->error = $e;
    echo $response;
}