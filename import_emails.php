<?php

/*
	With this script you can add email adresses to your database that need not be
	confirmed. Just insert the emails you want to add to your database into $mails array. After insertion, the file rights of this script should be set to 600!!!
*/

require_once './vendor/autoload.php';
require_once './admin/controller/session_check.php';

//insert your commaseparated emails into $str:
$str = htmlspecialchars("email_1, email_2,...");

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
//print_r($mailinglist);

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
    echo "done";
    die();
    } catch (PDOException $e) {
       	$message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
       	error_log($message,0);
       	die();
    }
?>