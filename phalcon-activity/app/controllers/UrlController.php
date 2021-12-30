<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\JsonRPC\Response;
use App\Includes\CustomLog;
use App\Models\FollowLinks;

class UrlController extends ControllerBase
{

    public function followLinksAction($params)
    {
        $customLog = new CustomLog();
        $customLog->addLogInfo($params);

        $followLinks = new FollowLinks();

        $followLinks->url = $params;

        $result = $followLinks->save();

        $response = new Response();

        $response->id = $followLinks->id;

        $response->result = $result;

        return $response->__toString();
    }

}

