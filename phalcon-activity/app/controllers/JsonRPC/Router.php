<?php

namespace App\Controllers\JsonRPC;

use Phalcon;
use App\Includes\CustomLog;

class Router extends Phalcon\Mvc\Router
{

    public function handle($uri): void
    {
        $customLog = new CustomLog();

        $uriData = trim($uri, '/');

        // Get JsonRPC request
        if ($uriData) {
            $request = Request::fromString($uri);
        } else {
            $request = Phalcon\DI::getDefault()->getShared('request');
            $body    = $request->getRawBody();
            $customLog->addLogInfo('post');
            $customLog->addLogInfo($body);
            $request = Request::fromString($body);
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
    }
}