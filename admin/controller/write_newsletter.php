<?php
//Load composer's autoloader
require_once ('../../vendor/autoload.php');
require_once 'session_check.php';

if (!empty($_POST["nl-content"])) {
	$msg = $_POST['nl-content'];
	$mailhead = $_POST['mailhead'];
	$subject = (empty($_POST["subject"])) ? "Newsletter" : "Newsletter: " . $_POST["subject"];
	try {
		$newsletterDao = \model\NewsletterDao::getInstance();
		$mailinglistArr = $newsletterDao->getMailinglist();
		$mailinglist = array();
		foreach ($mailinglistArr as $value) {
			array_push($mailinglist, $value["email"]);
		}
		unset($value);	
		require_once 'send_newsletter.php';
		header("Location: ../views/write_newsletter.php?sent");
		die();

	} catch (Exception $e) {
	    $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
	    error_log($message,0);
	    header("Location: ../../views/error.php?err=500");
	    die();
	}
} else {
	//Locate to error Register Page
	header("Location: ../../views/error.php?err=400");
	die();
}
?>
