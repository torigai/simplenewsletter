<?php 

	require_once '../vendor/autoload.php';
	
	if (!empty($_POST['email'])) {

		$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		if (!(filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($email) > 3 && strlen($email) < 254)) {
		    //Locate to error Register Page
		    header("Location: ../views/error.php?err=400");
		    die();
		}

		//Create user's object
		$newsletter = new \model\Newsletter();
		$newsletter->setNLmail(htmlentities($email));

		//Try to accomplish connection with the database
		try {

		    $newsletterDao = \model\NewsletterDao::getInstance();

		    $NLInfo = $newsletterDao->getNLInfo(htmlentities($email));

		    if ($NLInfo !== false) { //email is registered for newsletter
		    	$token = md5(date("YmdHis") . $email);
		    	$newsletter->setNLdelrequest($token);
		    	$newsletter->setNLid($NLInfo["id"]);
		    	$belabouredID = $newsletterDao->newDelrequest(
		    		$newsletter->getNLdelrequest(), 
		    		$newsletter->getNLid()
		    	);

		    	//Send confirmation mail for delete
		    	$statusvar = "delete";
		    	require_once 'send_newsletter_confirm.php';	    
		    	header("Location: ../views/confirm.php?dN");
		    	die();
		    } else {
		    	//email is not registered: locate to error Register Page
            	header("Location: ../views/register.php?errorNotRegistered");
            	die();
		    }

		} catch (PDOException $e) {
        	$message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
        	error_log($message,0);
        	header("Location: ../views/error.php?err=500");
        	die();
    	}
    } else {
    	//Locate to error Register Page
    	header("Location: ../views/error.php?err=400");
    	die();
    }

?>