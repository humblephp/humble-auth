# humble-auth

[![Latest Version](https://img.shields.io/github/release/humblephp/humble-auth.svg)](https://github.com/humblephp/humble-auth/releases)
[![Software License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE.md)
[![Build Status](https://api.travis-ci.org/humblephp/humble-auth.svg?branch=master)](https://travis-ci.org/humblephp/humble-auth)

HUMBLE Auth

## Install

Via Composer

``` bash
$ composer require humble/auth
```

## Usage

Get PHP Auth with Pdo Adapter.
```
$adapter = new \Humble\Auth\PdoAdapter($pdo);
$auth = new \Humble\Auth\Auth($adapter, $session);
```

Authenticate credentials.
```
$auth->authenticate([
    'username' => 'tester@test.com',
    'password' => 'secret'
]);
```

Get authenticated user data.
```
$auth->get();
```

Remove authenticated user.
```
$auth->logout();
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
