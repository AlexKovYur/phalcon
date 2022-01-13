<?php


namespace App\Controllers;


use App\Controllers\JsonRPC\Response;
use App\Models\FollowLinks;
use Phalcon\Paginator\Adapter\QueryBuilder;

class AdminController extends ControllerBase
{
    public function activityAction($param = null)
    {
        $builder = $this
            ->modelsManager
            ->createBuilder()
            ->columns('count(id) as counter, url, max(date) as date')
            ->from(FollowLinks::class)
            ->orderBy('url')
            ->groupBy('url');

        $paginator = new QueryBuilder(
            [
                'builder' => $builder,
                'limit'   => 3,
                'page'  => $param ?? 1,
            ]
        );

        $paginate = $paginator->paginate();

        $response = new Response();

        $response->result = json_encode($paginate, JSON_FORCE_OBJECT);

        return $response->__toString();
    }
}