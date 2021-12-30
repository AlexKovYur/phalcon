<?php


namespace App\Controllers;


use Phalcon\Http\Client\Request;

class AdminController extends ControllerBase
{
    public function activityAction()
    {
        $baseUri = 'nginx-container-activity';

        $params = [
            'jsonrpc' => '2.0',
            'method' => 'admin.activity',
        ];

        $params = json_encode($params);

        $request = Request::getProvider();
        $request->setBaseUri($baseUri);

        $request->header->set('Content-Type', 'application/json');

        $result = $request->post('', $params);

        $result = json_decode($result->body, true);
        echo'<pre>';var_dump('$result', $result);echo'</pre>';die();
    }
}