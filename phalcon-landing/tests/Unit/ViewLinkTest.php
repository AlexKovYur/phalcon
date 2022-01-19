<?php


namespace Tests\Unit;


use Phalcon\Http\Client\Request;

class ViewLinkTest extends AbstractUnitTest
{
    private $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = Request::getProvider();
    }

    public function testLink() {
        $baseUri = 'nginx-container-activity';
        $link = 'link';

        $params = [
            'jsonrpc' => '2.0',
            'method' => 'url.followLinks',
            'params' => ['url' => $link]
        ];

        $params = json_encode($params);

        $this->request->setBaseUri($baseUri);

        $this->request->header->set('Content-Type', 'application/json');

        $result = $this->request->post('', $params);

        $result = json_decode($result->body, true);

        $this->assertIsString($result['id']);
        $this->assertEquals($result['jsonrpc'], '2.0');
        $this->assertEquals($result['result'], true);
    }

    public function testActivityHistory()
    {
        $baseUri = 'nginx-container-activity';
        $params = [
            'jsonrpc' => '2.0',
            'method' => 'admin.activity',
            'params' => [
                'page' => 1
            ]
        ];
        $params = json_encode($params);

        $this->request->setBaseUri($baseUri);
        $this->request->header->set('Content-Type', 'application/json');
        $result = $this->request->post('', $params);

        $data = json_decode($result->body, true);
        $results = json_decode($data['result'], true);

        $this->assertEquals($data['jsonrpc'], '2.0');
        $this->assertIsArray($results['items']);
        $this->assertIsInt($results['total_items']);
        $this->assertEquals($results['limit'], 3);
        $this->assertIsInt($results['first']);
        $this->assertIsInt($results['previous']);
        $this->assertIsInt($results['current']);
        $this->assertIsInt($results['next']);
        $this->assertIsInt($results['last']);
    }
}