<?php 

	//needed in views/confirm.php
	$url_of_website = 'http://mycompany.de';

	//needed in controller/send_newsletter_confirm.php and admin/controller/send_newsletter.php
	$path_to_autoloader = $_SERVER['DOCUMENT_ROOT'].'MISSINGDIRSTO/vendor/autoload.php';

	//needed in controller/send_newsletter_confirm.php
	$path_to_confirm = $url_of_website . 'MISSINGDIRSTO/views/confirm.php';

	//Subjects of emails

	$unsubscribe_subject = 'Mycompany: Newsletter abbestellen';
	$register_subject = 'Mycompany: Anmeldung zum Newsletter';

	//Mail config

	$mailhost = 'myhost';
	$mailusername = 'myusername';
	$mailpwd = 'mypwd';
	$smtpsecuretype = 'tls';
	$mailport = 587;
	$setfrommail = 'myfrommail';
	$setfromname = 'myfromname'; 
	$addaddress = 'mymailadress';

	//Logo and footer appearing in every newsletter etc.
	//contoller/send_newsletter.php, controller/preview.php and views/write_newsletter.php

	$myheadertext1 = "Jeden Nachmittag: Partytime 15 - 19 Uhr";
	$myheadertext2 = "Musterstr. 100";
	$path_to_logo = $url_of_website.'MISSINGDIRSTO/logo.png';
	//notice that the logo is included by hand in /controller/send_newsletter.php !!!
	$mylogo = "<div style='padding-top: 1em; padding-bottom: 1.5em; text-align: center;'><img src='".$path_to_logo."' width='20%' hight='5'></div><br>";
		//"<div style='margin-bottom: 2em;'><p style='font-family: Times New Roman'>Mycompany</p><h1 style='color: #198c19'>Newsletter</h1></div>";
	$myfooter = "<div style='margin-top: 2em; margin-bottom: 2em'><p><a href='https://workstation-berlin.org' target='_blank'>Mycompany</a></p></div><div style='font-family: Times New Roman;'><p>ein Projekt von</p><p>Mycompany e.V.</p><p>Projektkoordination: Max Mustermann</p><p>Tel. 000 000 0000</p></div>";
?>
