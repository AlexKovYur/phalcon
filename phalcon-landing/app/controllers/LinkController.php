<?php
declare(strict_types=1);

namespace App\Controllers;

use Phalcon\Http\Client\Request;

class LinkController extends ControllerBase
{
    public function indexAction()
    {
        $baseUri = 'nginx-container-activity';
        $params = [
            'jsonrpc' => '2.0',
            'id' => 1,
            'method' => 'index.index',
            'params' => []
        ];

        $params = json_encode($params);

        $request = Request::getProvider();
        $request->setBaseUri($baseUri);

        $request->header->set('Content-Type', 'application/json');

        $response = $request->post('', $params);

        $response = json_decode($response->body, true);

        echo'<pre>';var_dump('$response', $response);echo'</pre>';die();
    }

}

