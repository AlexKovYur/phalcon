<?php
declare(strict_types=1);

use Phalcon\Http\Client\Request;

class IndexController extends ControllerBase
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

        $request = Request::getProvider();
        $request->setBaseUri($baseUri);

        //$request->header->set('Accept', 'application/json');
        $request->header->set('Content-Type', 'application/json');

        //$response = $request->get($baseUri, $params);
        $response = $request->post($params);

        $response = json_decode($response->body, true);

        echo'<pre>';var_dump('$response', $response);echo'</pre>';die();
    }

}

