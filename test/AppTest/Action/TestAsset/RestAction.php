<?php
namespace AppTest\Action\TestAsset;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Action\AbstractRestAction;
use Zend\Diactoros\Response\JsonResponse;

class RestAction extends AbstractRestAction
{
    public function get(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        return new JsonResponse(['result' => true]);
    }

    public function post(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        return new JsonResponse(['result' => true]);
    }
}
