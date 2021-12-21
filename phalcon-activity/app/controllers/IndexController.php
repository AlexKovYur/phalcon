<?php
declare(strict_types=1);

namespace App\Controllers;

use Phalcon\Logger;
use Phalcon\Logger\Adapter\Stream;
use App\Controllers\JsonRPC\Response;

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

        $logger->info('Something went wrong Index');

        $response = new Response();
        //echo'<pre>';var_dump('$response 2', $response);echo'</pre>';die();
        //$response = $response->__toString();
        //echo'<pre>';var_dump('$response 3', $response);echo'</pre>';die();
        return $response->__toString();
    }

}

