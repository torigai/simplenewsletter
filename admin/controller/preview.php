<?php

  require_once "../../customvars.php";
  require_once 'session_check.php';

  //Load composer's autoloader
  require_once ('../../vendor/autoload.php');

  if (isset($_GET['m'])) {
    $msg = $_GET['m'];
    $logo = $mylogo;
    $mailfooter = $myfooter;
    $info = urlencode($logo . $msg . $mailfooter);
        header("Location: ../views/preview.php?info=".$info);
    die();
  }

  if (isset($_GET['l'])) {
    try {	    
      $newsletterDao = \model\NewsletterDao::getInstance();
      $mailinglistArr = $newsletterDao->getMailinglist();
      $mailinglist = array();
      foreach ($mailinglistArr as $value) {
        array_push($mailinglist, $value["email"]);
      }
      unset($value);
      $info = implode(", ", $mailinglist);
      header("Location: ../views/preview.php?info=".$info);
      die();
    } catch (Exception $e) {
        $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
        error_log($message,0);
        header("Location: ../../views/error/error.php?err=500");
        die();
    }
  }  

  //Locate to error Register Page
  header("Location: ../../views/error/error.php?err=400");
  die();
  

?>
