<?php
declare(strict_types=1);

namespace App\Controllers;

use Phalcon\Http\Client\Request;

use Phalcon\Logger;
use Phalcon\Logger\Adapter\Stream;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $adapter = new Stream(APP_PATH . '/logs/application.log');
        $logger  = new Logger(
            'messages',
            [
                'main' => $adapter,
            ]
        );

        $logger->info('Something went wrong landing');


//        $baseUri = 'nginx-container-activity';
//        $params = [
//            'jsonrpc' => '2.0',
//            'id' => 1,
//            'method' => 'index.index',
//            'params' => []
//        ];
//
//        $request = Request::getProvider();
//        $request->setBaseUri($baseUri);
//
//        //$request->header->set('Accept', 'application/json');
//        $request->header->set('Content-Type', 'application/json');
//
//        //$response = $request->get($baseUri, $params);
//        $response = $request->post($params);
//
//        $response = json_decode($response->body, true);
//
//        echo'<pre>';var_dump('$response', $response);echo'</pre>';die();
    }

}

