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

        $response = new Response();

        $response->result = $countFollow ? true : false;

        return $response->__toString();
    }
}