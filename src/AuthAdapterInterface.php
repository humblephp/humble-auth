<?php

namespace Humble\Auth;

interface AuthAdapterInterface
{
    public function authenticate($username, $password);
}
