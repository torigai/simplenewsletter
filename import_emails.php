<?php

/*
	With this script you can add email adresses to your database that need not be
	confirmed. Just insert the emails you want to add to your database into $mails array. After insertion, the file rights of this script should be set to 600!!!
*/

require_once './vendor/autoload.php';
require_once './admin/controller/session_check.php';

//Insert mailinglist - commasepareted - into mails array:
$mails = array('newmail_1', 'newmail_2', '...');
$mailinglist = array_unique($mails);

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