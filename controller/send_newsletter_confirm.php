<?php

require_once "../customvars.php";

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require_once $path_to_autoloader;

$mail = new PHPMailer(true);    // Passing `true` enables exceptions
try {

    $url = $path_to_confirm;

    if (isset($statusvar)) { //Unsubscribe
	$msg = sprintf(
            "Folge diesem <a href='%s?i=%u&h=%s&s=%s'>Link</a>, wenn Du den Newsletter abbestellen und Deine Email aus dem Verteiler löschen möchtest.",
            $url, $belabouredID, $token, $statusvar
        );
        $mail->Subject = $unsubscribe_subject;
    } else { //Subscribe
        $msg = sprintf(
            "Folge diesem <a href='%s?i=%u&h=%s'>Link</a>, um die Registrierung für den Newsletter zu bestätigen.",
            $url, $belabouredID, $token
        );
        $mail->Subject = $register_subject;
    }
    
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = $mailhost;                     // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $mailusername;                 // SMTP username
    $mail->Password = $mailpwd;                           // SMTP password
    $mail->SMTPSecure = $smtpsecuretype;                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = $mailport;                                    // TCP port to connect to
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );                                  // TCP port to connect to

    //Recipients
    $mail->setFrom($setfrommail, $setfromname);
    $mail->addAddress($newsletter->getNLmail(), 'User');     // Add a recipient

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->CharSet = 'UTF-8';
    $mail->Body    = $msg;
    $mail->send();
} catch (Exception $e) {
    $message = date("Y-m-d H:i:s") . " " . $_SERVER['SCRIPT_NAME'] . " $e\n";
    error_log($message,0);
    header("Location: ../views/error.php?err=500");
    die();
}
?>

