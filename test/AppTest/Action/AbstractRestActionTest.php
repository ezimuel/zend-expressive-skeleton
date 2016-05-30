<?php

namespace AppTest\Action;

use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;
use AppTest\Action\TestAsset\RestAction;

class AbstractRestActionTest extends \PHPUnit_Framework_TestCase
{
    public function getValidMethods()
    {
        return [
            [ 'GET' ],
            [ 'POST' ]
        ];
    }

    public function getNotValidMethods()
    {
        return [
            [ 'PUT' ],
            [ 'PATCH' ],
            [ 'DELETE' ]
        ];
    }

    /**
     * @dataProvider getValidMethods
     */
    public function testInvokeMethod($method)
    {
        $testRest = new RestAction();
        $request = new ServerRequest(['/']);
        $request = $request->withMethod($method);

        $response = $testRest($request, new Response(), function(){});
        $json = json_decode((string) $response->getBody());

        $this->assertTrue($response instanceof Response);
        $this->assertTrue($response instanceof Response\JsonResponse);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue(isset($json->result));
        $this->assertTrue($json->result);
    }

    /**
     * @dataProvider getNotValidMethods
     */
    public function testInvokeMethodNotAllowed($method)
    {
        $testRest = new RestAction();
        $request = new ServerRequest(['/']);
        $request = $request->withMethod($method);

        $response = $testRest($request, new Response(), function(){});

        $this->assertTrue($response instanceof Response);
        $this->assertEquals(405, $response->getStatusCode());
        $allow = $response->getHeader('Allow');
        $this->assertNotEmpty($allow);
        $this->assertEquals('GET,POST', $allow[0]);
    }
}
