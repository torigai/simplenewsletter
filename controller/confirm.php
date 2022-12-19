<?php 

 require_once '../vendor/autoload.php';
 
 if (!empty($_GET['h'])) { //confirmation email received

  $hash = $_GET['h'];
  $id = intval($_GET['i']);

  $newsletterDao = \model\NewsletterDao::getInstance();

  if (isset($_GET['s'])) { //go for unsubscribe

   $NLInfo = $newsletterDao->getNLInfo($id);

   if ($NLInfo["delrequest"] === $hash) {
    $newsletterDao->deleteNL($id);
    $info = "Du hast den Newsletter erfolgreich abbestellt. Deine email wurde aus der Mailingliste gelöscht!";
   } else {
    $info = "Beim Abbestellen des Newsletters ist ein Fehler aufgetreten!";
   }

  } else { //go for subscribe
   
   $NLInfo = $newsletterDao->getNLInfo($id);

   if ($NLInfo["verified"] === $hash) {
    $newsletterDao->activateNL($id);
    $info = "Die Registrierung für den Newsletter ist erfolgreich abgeschlossen!";
   } else {
    $info = "Bei der Registrierung ist ein Fehler aufgetreten!";
   }

  }
 } else {
  $info = (isset($_GET['dN'])) ?
   "Wir haben Dir eine mail mit einem Link geschickt, über den Du noch bestätigen musst, dass Du den Newsletter abbestellen willst." :
   "Wir haben Dir eine mail mit einem Link geschickt, über den Du die Registrierung bestätigen musst.";
 }

?>
