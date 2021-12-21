<?php

namespace App\Controllers\JsonRPC;

use Phalcon;
use Phalcon\Logger;
use Phalcon\Logger\Adapter\Stream;

class Router extends Phalcon\Mvc\Router
{

    public function handle($uri): void
    {
        $adapter = new Stream(APP_PATH . '/logs/application.log');
        $logger  = new Logger(
            'messages',
            [
                'main' => $adapter,
            ]
        );

        //$logger->info($uri);

        $request = Phalcon\DI::getDefault()->getShared('request');
        $body    = $request->getRawBody();
        //$logger->info($body);
        $request = Request::fromString($body);
        //$logger->info($request);

        // Get JsonRPC request
        if ($uri) {
            //$request = Request::fromString($uri);
        } else {
            //$request = $this->getDI()->getShared('jsonrpcRequest');
        }

        // Parse method name
        $method = explode('.', $request->method);

        $controller = null;
        if (!empty($method[0])) {
            $controller = $method[0];
        }

        $action = null;
        if (!empty($method[1])) {
            $action = $method[1];
        }

        // Setup variables
        $this->controller = $controller;
        $this->action     = $action;
        $this->params     = $request->params;
        //echo'<pre>';var_dump('$this', $this);echo'</pre>';die();
    }
}