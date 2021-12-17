<?php
declare(strict_types=1);

namespace App\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Http\Client\Request;

class LinkController extends Controller
{
    public function indexAction()
    {
        $baseUri = 'nginx-container-activity';
        $params = [
            'jsonrpc' => '2.0',
            'id' => 1,
            'method' => 'tests.index',
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

        /*$jwtToken = 'abc.def.ghi';

        $request = new Request(
            'POST',
            'https://api.phalcon.io/companies/1',
            'php://memory',
            [
                'Authorization' => 'Bearer ' . $jwtToken,
                'Content-Type'  => 'application/json',
            ]
        );

        $request->withBody('{"jsonrpc" : "2.0", "id" : 1, "method" : "tests.index", "params" : {}}');

        $result = $httpClient->send($request);*/

        /*$di->set('couchdb', function () use($config) {
            $client = \Phalcon\Http\Client\Request::getProvider();
            $client->setBaseUri($config->couchdb->baseUri);
            $client->header->set('Content-Type', 'application/json');
            return $client;
        });*/
    }

}

