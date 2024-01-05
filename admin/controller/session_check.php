<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['loggedUser'])) {
    header("Location: ../../views/error.php?err=400");
    die();
}

?>
