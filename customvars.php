<?php 

	//needed in views/confirm.php
	$url_of_website = 'www.mycompany.de';

	//needed in controller/send_newsletter
	$path_to_autoloader = $_SERVER['DOCUMENT_ROOT'].'/ADD_MISSING_DIRS_TO/newsletter/vendor/autoload.php';

	//needed in controller/send_newsletter_confirm
	$url_of_newsletter = $url_of_website.'ADD_MISSING_DIRS_TO/newsletter';

	//Subjects of emails

	$unsubscribe_subject = 'Newsletter abbestellen';
	$register_subject = 'Anmeldung zum Newsletter';

	//Mail config

	$mailhost = 'myhost';
	$mailusername = 'mail@mycompany.de';
	$mailpwd = 'mypwd';
	$smtpsecuretype = 'tls';
	$mailport = 587;
	$setfrommail = 'mail@mycompany.de';
	$setfromname = 'mycompany'; 
	$addaddress = 'mail@mycompany.de';

	//Logo appearing in every newsletter (could also be an image or nothing)
	//contoller/send_newsletter.php

	$mylogo = "<div style='margin: 1.5em 0'><h1 style='font-size: 2.7em; font-weight: 400; color: #EF7D25; font-family: \"Roboto Slab\", serif;'>My<span style='color: #333'>Company - Newsletter</span></h1></div>";
?>