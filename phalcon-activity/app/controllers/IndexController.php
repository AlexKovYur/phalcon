<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\JsonRPC\Response;
use App\Includes\CustomLog;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $customLog = new CustomLog();
        $customLog->addLogInfo('Index');

        $response = new Response();

        return $response->__toString();
    }

}

