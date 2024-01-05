<?php

namespace model;

use model\Connect\Connection;
use model\User;
use PDO;
use PDOException;

class UserDao
{
    private static $instance;
    private $pdo;

    const CHECK_LOGIN = "SELECT id, username, password FROM users WHERE username = ? AND password = ?";

    const SET_LAST_LOGIN = "UPDATE users SET last_login = ? WHERE username = ?";

    private function __construct()
    {
        $this->pdo = Connection::getInstance()->getConnection();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new UserDao();
        }
        return self::$instance;
    }

    /**
     * Check if login is correct.
     * @param User $user - user object
     * @return bool|int - user's ID.
     */
    function checkLogin(User $user)
    {
        $statement = $this->pdo->prepare(self::CHECK_LOGIN);
        $statement->execute(array(
            $user->getUsername(),
            $user->getPassword()));

        if ($statement->rowCount()) {
            $userId = $statement->fetch();
            return (int)$userId['id'];
        } else {
            return false;
        }
    }

    /**
     * Set time of last login
     * @param User $user - user's login time and username.
     */
    function setLastLogin(User $user)
    {

        $statement = $this->pdo->prepare(self::SET_LAST_LOGIN);
        $user->setLastLogin();
        $statement->execute(array(
            $user->getLastLogin(),
            $user->getUsername()));
    }
}
?>
