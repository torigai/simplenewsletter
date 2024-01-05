<?php

require_once "../../customvars.php";
require_once 'session_check.php';

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require_once $path_to_autoloader;

$mail = new PHPMailer(true);    // Passing `true` enables exceptions
try {
    
    //Server settings
    $mail->SMTPDebug = 0;                  // Disable verbose debug output, set to 0
    $mail->isSMTP();                       // Set mailer to use SMTP
    $mail->Host = $mailhost;               // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                // Enable SMTP authentication
    $mail->Username = $mailusername;       // SMTP username
    $mail->Password = $mailpwd;            // SMTP password
    $mail->SMTPSecure = $smtpsecuretype;   // Enable TLS encryption, `ssl` also accepted
    $mail->Port = $smtpport;               // TCP port to connect to
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );                                  // TCP port to connect to

    //Recipients
    $mail->setFrom($setfrommail, $setfromname);

    $mail->AddAddress($addaddress, 'Newsletter');
    foreach($mailinglist as $mailaddress)
    {
        $mail->AddBCC($mailaddress, 'User');
    }
    unset($mailaddress);

    //Content
    $mail->addEmbeddedImage('../../logo.png', 'image_cid');
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->CharSet = 'UTF-8';
    $logo = '<div style="padding-top: 1em; padding-bottom: 1.5em; text-align: center;"><img src="cid:image_cid" width="20%" hight="5"></div><br>';
    $mailfooter = $myfooter;
    $mail->Body    = $logo . '<div style="padding-left: 1em">'. $mailhead . $msg . $myfooter . '</div>';
    $mail->Subject = $subject;
    $mail->send();

} catch (Exception $e) {
    $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
    error_log($message,0);
    header("Location: ../../views/error.php?err=500");
    die();
}
?>
