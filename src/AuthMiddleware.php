<?php

namespace Humble\Auth;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class AuthMiddleware
{
    const LOGIN_PAGE = '/login';
    const FOUND = 302;

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
        // BEFORE

        $response = $next($request, $response);

        // AFTER

        return $response;
    }
}
