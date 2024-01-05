<?php

namespace model;

class User
{
    private $id;
    private $username;
    private $password;
    private $lastLogin;

    public function __construct()
    {
        $this->lastLogin = date("Y-m-d H:i:s");
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return false|string
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * @param $lastLogin
     */
    public function setLastLogin()
    {
        $this->lastLogin = date("Y-m-d H:i:s");
    }

}
?>
