<?php

namespace Humble\Auth;

class Auth implements \ArrayAccess
{
    const STORAGE_KEY = 'auth';

    private $storage;
    private $adapter;

    public function __construct(\ArrayAccess $storage, AuthAdapterInterface $adapter)
    {
        $this->storage = $storage;
        $this->adapter = $adapter;
    }

    public function authenticate($username, $password)
    {
        $identity = $this->adapter->authenticate($username, $password);

        if (!$identity) {
            return false;
        }

        $this->storage->offsetSet(self::STORAGE_KEY, $identity);

        return true;
    }

    public function offsetExists($offset)
    {
        return isset($this->storage->offsetGet(self::STORAGE_KEY)[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->storage->offsetGet(self::STORAGE_KEY)[$offset] ?? null;
    }

    public function offsetSet($offset, $value)
    {
        $this->storage->offsetSet(self::STORAGE_KEY, array($offset => $value));
    }

    public function offsetUnset($offset)
    {
        $auth = $this->storage->offsetGet(self::STORAGE_KEY);
        unset($auth[$offset]);
        $this->storage->offsetSet(self::STORAGE_KEY, $auth);
    }
}
