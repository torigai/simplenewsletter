<?php 
    require_once '../controller/session_check.php';
?>

<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../../css/style.css" rel='stylesheet' type='text/css'/>
    <title>Admin | Newsletter</title>
</head>

<body>
<div align="center" class="bottommargin">
    <h2>Emailadressen hinzufügen</h2>
    <p >Bitte füge nur die reinen Emailadressen ein.</p>
    <p class="bottommargin">Falls es mehrere sind, trenne sie mit einem Komma</p>
    <p style="color: green"><?php if (isset($_GET["added"])) {echo "Die Email Adressen wurden hinzugefügt";} ?> </p>
</div>

<div align="center">
    <form action="../controller/add_recipients_controller.php" method="post">
        <div class="bottommargin">
            <label for="recipients">Email-Adressen</label><br>
            <textarea id="recipients" name="recipients" style="width: 50%" rows="10" placeholder="max@mustermann.de, melanie@musterfrau.com, ..." required="required"></textarea>
        </div>
        <div>
            <input class="btn btn-success" type="button" id="cancel" value="Abbrechen" onclick="resetTextarea();">
            <input class="btn btn-success" type="submit" id="ok" value="Speichern">
        </div>
    </form>
</div>

</body>
</html>

<script>

    function resetTextarea() 
    {
        return document.getElementById("recipients").value = "";
    }

    document.getElementById("ok").onclick = function ()
    {
	
        let textareaContent = document.getElementById("recipients").value;
        if (textareaContent.trim() == "") {    
            return false;
        } else {
            return window.confirm("Are you sure?");
        }
    }
</script>

