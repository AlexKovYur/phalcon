<?php
namespace JsonRPC;

use Phalcon;

class Router extends Phalcon\Mvc\Router
{

    public function handle($uri): void
    {
        // Get JsonRPC request
        if ($uri) {
            $request = Request::fromString($uri);
        } else {
            $request = $this->getDI()->getShared('jsonrpcRequest');
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