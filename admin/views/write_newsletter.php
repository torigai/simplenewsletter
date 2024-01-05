<?php 
	require_once '../controller/session_check.php';
	require_once '../../customvars.php';
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
    <h2>Newsletters</h2>
    <p style="color: green"><?php if (isset($_GET["sent"])) {echo "Der Newsletter wurde versendet";} ?> </p>
</div>

<div align="center" class="bottommargin">
    <form action="../controller/write_newsletter.php" method="post">
        <div class="bottommargin">
            <label for="subject">Subject of mail</label><br>
            <input id="subject" name="subject" type="text" placeholder="Newsletter">
	</div>
	 <div class="bottommargin">
            <label for="mailhead">Header of mail</label><br>
	    <textarea id="mailhead" name="mailhead" style="width: 50%" rows="4"><b><p style='color: gold; font-size: 1.5em;'><?php echo $myheadertext1 ?></p><p><?php echo $myheadertext2 ?></p></b></textarea>
        </div>
        <div class="bottommargin">
            <label for="nl-content">Content</label><br>
	    <textarea id="nl-content" name="nl-content" style="width: 50%" rows="10" required="required" placeholder="Raw HTML"></textarea>
        </div>
        <div>
            <a class="btn btn-success" id="preview" target="_blank">Preview</a>
            <a class="btn btn-success" href="../controller/preview.php?l" target="_blank">Mailinglist</a>
            <input class="btn btn-success" type="submit" id="ok" value="Send">
        </div>
    </form>
</div>

<div align="center">
    <p>
        Hier kannst du dem Newsletter <a href="add_recipients.php" target="_blank">Emailadressen hinzufügen</a>
    </p>
</div>

</body>
</html>

<script>
    let prevtag = document.getElementById("preview");

    prevtag.onclick = function () 
    {
	let content = document.getElementById("nl-content").value;
	let mailhead = document.getElementById("mailhead").value;
        return prevtag.href = "../controller/preview.php?m=" + mailhead + content;
    }

    document.getElementById("ok").onclick = function ()
    {
        return window.confirm("Are you sure?");
    }
</script>

