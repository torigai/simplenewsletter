<?php

require_once '../../vendor/autoload.php';
require_once 'session_check.php';

if (!empty($_POST["recipients"])) {
 //insert your commaseparated emails into $str:
 $str = htmlspecialchars($_POST["recipients"]);
 
 $inputArr = explode(",", $str);

 function puremailaddress ($mail)
 {
  $mail = trim($mail);
  $pattern = "/\S+@\S+.[a-z]+/";
  preg_match($pattern, $mail, $match);
  $result = str_replace("&gt", "", str_replace("&lt;", "", $match[0]));
  return $result;
 }
 $mails = array_map('puremailaddress', $inputArr);
 $mailinglist = array_unique($mails);
# print_r($mailinglist);

 $newsletter = new \model\Newsletter();

 try {
  $newsletterDao = \model\NewsletterDao::getInstance();
     
     foreach($mailinglist as &$email) {
      $newsletter->setNLmail(htmlentities($email));
      $NLInfo = $newsletterDao->getNLInfo($email);

      if ($NLInfo === false) { //email does not yet exist in database
       $newID = $newsletterDao->addConfirmedNL(
        $newsletter->getNLmail(),
        $newsletter->getNLCreatedAt()
       ); 
      }
     }
     unset($email);
     header("Location: ../views/add_recipients.php?added");
     die();
     } catch (PDOException $e) {
         $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
         error_log($message,0);
         die();
     }
} else {
 //Locate to error Register Page
 header("Location: ../../views/error.php?err=400");
 die();
}



?>
