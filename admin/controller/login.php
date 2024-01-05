<?php
require_once '../../vendor/autoload.php';
require_once 'session.php';

//Validation
if (!empty($_POST['username']) &&
    !empty($_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (strlen($username) > 3 &&
        strlen($username) < 20 &&
        strlen($password) >= 4 &&
        strlen($password) <= 12) {

        //Get user's object
        $user = new \model\User();

        //Try to accomplish connection with the database
        try {
            $userDao = \model\UserDao::getInstance();
            
            $user->setUsername(htmlentities($username));
            $user->setPassword(sha1($password));

            $result = $userDao->checkLogin($user);

            if ($result) {
                $_SESSION['loggedUser'] = $result;
                $userDao->setLastLogin($user);
                header("Location: ../views/write_newsletter.php");
                die();
            } else {
                header("Location: ../views/login.php?error");
                die();
            }
        } catch (PDOException $e) {
            $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
            error_log($message,0);
            header("Location: ../../views/error.php?err=500");
            die();
        }
    } else {
        header("Location: ../views/login.php?error");
        die();
    }
} else {
    header("Location: ../../views/error.php?err=400");
    die();
}
