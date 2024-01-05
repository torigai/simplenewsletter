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
		    
		    $NLInfo = $newsletterDao->getNLInfo($newsletter->getNLmail());

		    if ($NLInfo !== false) {
		    	if (is_null($NLInfo["verified"])) {
		    		//email is already registered: locate to error Register Page
            		header("Location: ../views/register.php?errorEmail");
            		die();
            	} else {
            		//Email exists but is not verified: update newsletter table
            		$token = md5(date("YmdHis") . $email);
		    		$newsletter->setNLverified($token);
		    		$newsletter->setNLid($NLInfo["id"]);

		    		$belabouredID = $newsletterDao->newVerification(
		    			$newsletter->getNLverified(), 
		    			$newsletter->getNLid()
		    		);
            	}
            } else {
            	//New email: insert into newsletter table
		    	$token = md5(date("YmdHis") . $email);
		    	$newsletter->setNLverified($token);
   		
	    		$belabouredID = $newsletterDao->addNL(
	    			$newsletter->getNLmail(), 
	    			$newsletter->getNLverified(),
	    			$newsletter->getNLCreatedAt()
	    		);	
			}    	

		    //Send confirmation mail
		    require_once 'send_newsletter_confirm.php';	    
		    header("Location: ../views/confirm.php");
		    die();

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
