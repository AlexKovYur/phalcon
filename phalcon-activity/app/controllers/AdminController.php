<?php


namespace App\Controllers;


use App\Controllers\JsonRPC\Response;
use App\Includes\CustomLog;
use App\Models\FollowLinks;

class AdminController extends ControllerBase
{
    public function activityAction()
    {
        $customLog = new CustomLog();

        $follow = FollowLinks::find();

        $countFollow = count($follow);

        $customLog->addLogInfo(count($follow));
        $customLog->addLogInfo(json_encode($follow));

        $results = [
            'rows' => $follow,
            'count' => count($follow),
            'response' => $countFollow ? true : false
        ];

        $response = new Response();

        $response->result = json_encode($results, JSON_FORCE_OBJECT);

        $customLog->addLogInfo($response->result);

        return $response->__toString();
    }
}