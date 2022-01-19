<?php


namespace App\Controllers;


use Phalcon\Http\Client\Request;
use Phalcon\Http\Response;

class AdminController extends ControllerBase
{
    public function activityAction($page = null)
    {
        $baseUri = 'nginx-container-activity';
        $params = [
            'jsonrpc' => '2.0',
            'method' => 'admin.activity',
            'params' => [
                'page' => $page
            ]
        ];
        $params = json_encode($params);

        $request = Request::getProvider();
        $request->setBaseUri($baseUri);
        $request->header->set('Content-Type', 'application/json');
        $result = $request->post('', $params);

        $data = json_decode($result->body, true);
        $results = json_decode($data['result'], true);

        $response = new Response();

        if (empty($data['result'])) {
            $response->redirect('/')->send();
        }

        $this->view->setVars([
            'paginate' => $results
        ]);
    }
}