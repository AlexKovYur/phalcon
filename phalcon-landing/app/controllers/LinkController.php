<?php
declare(strict_types=1);

namespace App\Controllers;

use Phalcon\Http\Client\Request;
use Phalcon\Url;
use Phalcon\Http\Response;

class LinkController extends ControllerBase
{
    public function indexAction($params)
    {
        $baseUri = 'nginx-container-activity';
        $link = $params ?? '';

        $params = [
            'jsonrpc' => '2.0',
            'method' => 'url.followLinks',
            'params' => ['url' => $link]
        ];

        $params = json_encode($params);

        $request = Request::getProvider();
        $request->setBaseUri($baseUri);

        $request->header->set('Content-Type', 'application/json');

        $result = $request->post('', $params);

        $result = json_decode($result->body, true);

        $response = new Response();

        if (empty($result['result'])) {
            $response->redirect('/')->send();
        }

        $this->view->pick('link/' . $link);
    }

}

