<?php

namespace Humble\Auth;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class AuthMiddleware
{
    const UNAUTHORIZED = 401;

    private $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function __invoke(
        RequestInterface $request,
        ResponseInterface $response,
        callable $next
    ) {
        if (!$this->auth->offsetExists('id')) {
            return $response->withStatus(self::UNAUTHORIZED)->withHeader('Location', '/login');
        }

        return $next($request, $response);
    }
}
