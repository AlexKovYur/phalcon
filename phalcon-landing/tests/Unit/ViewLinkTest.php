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
        $link = $params ?? '';

        $params = [
            'jsonrpc' => '2.0',
            //'id' => 1,
            'method' => 'url.followLinks',
            'params' => ['url' => $link]
        ];

        $params = json_encode($params);

        $this->request->setBaseUri($baseUri);

        $this->request->header->set('Content-Type', 'application/json');

        $result = $this->request->post('', $params);

        $result = json_decode($result->body, true);

        $this->assertEquals(
            $result['jsonrpc'],
            "2.0",
            "This will pass"
        );
    }
}