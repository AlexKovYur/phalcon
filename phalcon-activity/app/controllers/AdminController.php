<?php


namespace App\Controllers;


use App\Controllers\JsonRPC\Response;
use App\Includes\CustomLog;
use App\Models\FollowLinks;
use Phalcon\Paginator\Adapter\Model as Paginator;

class AdminController extends ControllerBase
{
    public function activityAction($param = null)
    {
        $customLog = new CustomLog();
        $customLog->addLogInfo($param);

        $follow = FollowLinks::find([
            'columns' => 'count(id) as counter, url, max(date) as date',
            'group' => 'url'
        ]);

        $paginator = new Paginator(
            [
                'model' => FollowLinks::class,
                'parameters' => [
                    'columns' => 'count(id) as counter, url, max(date) as date',
                    'group' => 'url',
                    'order' => 'url'
                ],
                'limit' => 2,
                'page'  => $param ?? 1,
            ]
        );

        $page = $paginator->paginate();

        $countFollow = count($follow);

        $customLog->addLogInfo(count($follow));
        $customLog->addLogInfo(json_encode($follow));

        $results = [
            'page' => $page,
            'count' => count($follow),
            'response' => $countFollow ? true : false
        ];

        $response = new Response();

        $response->result = json_encode($results, JSON_FORCE_OBJECT);

        $customLog->addLogInfo($response->result);

        return $response->__toString();
    }
}