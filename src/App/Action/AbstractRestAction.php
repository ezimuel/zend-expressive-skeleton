<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Exception;

class AbstractRestAction
{
    const HTTP_METHODS = [ 'get', 'post', 'put', 'patch', 'delete' ];

    /**
     * @var array
     */
    protected $availableMethods;

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next = null)
    {
        $method = strtolower($request->getMethod());
        if (method_exists($this, $method)) {
            return $this->$method($request, $response, $next);
        }
        $response = $response->withStatus(405, 'Method not allowed');
        $response = $response->withHeader('Allow', strtoupper(
            implode(',', $this->getAvailableMethods([ $method ]))
        ));
        return $response;
    }

    /**
     * Get the available http methods implemented in the class
     *
     * @param $exclude array
     * @return array
     */
    public function getAvailableMethods($exclude = [])
    {
        if (!isset($this->availableMethods)) {
            $this->availableMethods = [];
            $methods = array_diff(self::HTTP_METHODS, $exclude);
            foreach ($methods as $method) {
              if (method_exists($this, $method)) {
                  $this->availableMethods[] = $method;
              }
            }
        }
        return $this->availableMethods;
    }
}
