<?php

namespace Humble\Auth;

class PdoAuthAdapter implements AuthAdapterInterface
{
    private $pdo;

    private $settings = [
        'tableName' => 'users',
        'usernameField' => 'username',
        'passwordField' => 'password',
    ];

    public function __construct(\Pdo $pdo, array $settings = array())
    {
        $this->pdo = $pdo;
        $this->settings = array_merge($this->settings, $settings);
    }

    public function authenticate($username, $password)
    {
        $identity = $this->getIdentity($username);

        if (!$identity) {
            return false;
        }

        if (password_verify($password, $identity[$this->settings['passwordField']])) {
            return $identity;
        }

        return false;
    }

    private function getIdentity($username)
    {
        $sql = vsprintf('SELECT * FROM %s WHERE %s = :username;', [
            $this->settings['tableName'],
            $this->settings['usernameField'],
        ]);

        $query = $this->pdo->prepare($sql);
        $query->bindValue(':username', $username);
        $query->execute();

        return $query->fetch();
    }
}
