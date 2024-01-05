<?php 

 namespace model;

 use model\Connect\Connection;
 use model\Newsletter;
 use PDO;
 use PDOException;

 class NewsletterDao
 {
    //Make Singleton
    private static $instance;
    private $pdo;

    //Statements defined as constants
    const GET_NL_INFO_MAIL = "SELECT * FROM newsletter WHERE email = ?";
    const GET_NL_INFO_ID = "SELECT * FROM newsletter WHERE id = ?";
    const ADD_NEW_NL = "INSERT INTO newsletter (email, verified, created_at) VALUES (?, ?,?)";
    const ADD_CONFIRMED_MAIL = "INSERT INTO newsletter (email, created_at) VALUES (?,?)";
    const DELETE_NL = "DELETE FROM newsletter WHERE id = ?";
    const ACTIVATE_NL = "UPDATE newsletter SET verified = NULL WHERE id = ?";
    const NEW_VERIF_CODE = "UPDATE newsletter SET verified = ? WHERE id = ?";
    const NEW_DELREQ_CODE = "UPDATE newsletter SET delrequest = ? WHERE id = ?";
    const ALTER_MAIL = "UPDATE newsletter SET email = ? WHERE id = ?";
    const GET_MAILINGLIST = "SELECT email FROM newsletter WHERE verified IS NULL";

    //Get connection in construct
    private function __construct()
    {
        $this->pdo = Connection::getInstance()->getConnection();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new NewsletterDao();
        }
        return self::$instance;
    }

    function getNLInfo ($var)
    {
        //Returns the result if newsletter for $var exists, else false
        (is_int($var)) ?
        $statement = $this->pdo->prepare(self::GET_NL_INFO_ID) :
        $statement = $this->pdo->prepare(self::GET_NL_INFO_MAIL);
        $statement->execute(array($var));
        if ($statement->rowCount()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result[0];
        } else {
            return false;
        }
    }

    function getMailinglist ()
    {
        $statement = $this->pdo->prepare(self::GET_MAILINGLIST);
        $statement->execute();
        if ($statement->rowCount()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return false;
        }
    }


    function addNL ($email, $verified, $created_at)
    {
        $this->pdo->beginTransaction();
        try {
            $statement = $this->pdo->prepare(self::ADD_NEW_NL);
            $statement->execute(array($email, $verified, $created_at));
            $lastInsertId = $this->pdo->lastInsertId();
            $this->pdo->commit();
            return $lastInsertId; 
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n"; error_log($message,0);
                header("Location: ../views/error.php?err=500");
                die();
        }
    }

    function addConfirmedNL ($email, $created_at)
    {
        $this->pdo->beginTransaction();
        try {
            $statement = $this->pdo->prepare(self::ADD_CONFIRMED_MAIL);
            $statement->execute(array($email, $created_at));
            $lastInsertId = $this->pdo->lastInsertId();
            $this->pdo->commit();
            return $lastInsertId; 
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n"; error_log($message,0);
                header("Location: ../views/error.php?err=500");
                die();
        }
    }

    function deleteNL ($id)
    {
        $this->pdo->beginTransaction();
        try {
            $statement = $this->pdo->prepare(self::DELETE_NL);
            $statement->execute(array($id));
            $this->pdo->commit();
            return true; 
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
                error_log($message,0);
                header("Location: ../views/error.php?err=500");
                die();
        }
    }

    function activateNL ($id)
    {
        $this->pdo->beginTransaction();
        try {
            $statement = $this->pdo->prepare(self::ACTIVATE_NL);
            $statement->execute(array($id));
            $this->pdo->commit();
            return true; 
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
                error_log($message,0);
                header("Location: ../views/error.php?err=500");
                die();
        }  
    }

    function newVerification ($verified, $id)
    {
        $this->pdo->beginTransaction();
        try {
            $statement = $this->pdo->prepare(self::NEW_VERIF_CODE);
            $statement->execute(array($verified, $id));
            $this->pdo->commit();
            return $id; 
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
            error_log($message,0);
            header("Location: ../views/error.php?err=500");
            die();
        }
    }

    function newDelrequest ($delrequest, $id)
    {
        $this->pdo->beginTransaction();
        try {
            $statement = $this->pdo->prepare(self::NEW_DELREQ_CODE);
            $statement->execute(array($delrequest, $id));
            $this->pdo->commit();
            return $id; 
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
            error_log($message,0);
            header("Location: ../views/error.php?err=500");
            die();
        }
    }

    function alterMail ($email, $id)
    {
        $this->pdo->beginTransaction();
        try {
            $statement = $this->pdo->prepare(self::ALTER_MAIL);
            $statement->execute(array($email, $id));
            $this->pdo->commit();
            return true; 
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
            error_log($message,0);
            header("Location: ../views/error.php?err=500");
            die();
        } 
    }
 }
?>
