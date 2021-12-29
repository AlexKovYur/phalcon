<?php
declare(strict_types=1);

namespace App\Controllers;

use Phalcon\Http\Client\Request;
use Phalcon\Url;

class LinkController extends ControllerBase
{
    public function indexAction($params)
    {
        $baseUri = 'nginx-container-activity';
        $link = $params ?? '';

        $params = [
            'jsonrpc' => '2.0',
            //'id' => 1,
            'method' => 'url.followLinks',
            'params' => ['url' => $link]
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

