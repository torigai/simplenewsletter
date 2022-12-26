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
    <h2>Newsletters</h2>
    <p style="color: green"><?php if (isset($_GET["sent"])) {echo "Der Newsletter wurde versendet";} ?> </p>
</div>

<div align="center">
    <form action="../controller/write_newsletter.php" method="post">
        <div class="bottommargin">
            <label for="subject">Subject of mail</label><br>
            <input id="subject" name="subject" type="text" placeholder="Subject">
        </div>
        <div class="bottommargin">
            <label for="nl-content">Content</label><br>
            <textarea id="nl-content" name="nl-content" style="width: 50%" rows="10" placeholder="Raw HTML" required="required"></textarea>
        </div>
        <div>
            <a class="btn btn-success" id="preview" target="_blank">Preview</a>
            <a class="btn btn-success" href="../controller/preview.php?l" target="_blank">Mailinglist</a>
            <input class="btn btn-success" type="submit" id="ok" value="Send">
        </div>
    </form>
</div>

</body>
</html>

<script>
    let prevtag = document.getElementById("preview");

    prevtag.onclick = function () 
    {
        let content = document.getElementById("nl-content").value;
        return prevtag.href = "../controller/preview.php?m=" + content;
    }

    document.getElementById("ok").onclick = function ()
    {
        return window.confirm("Are you sure?");
    }
</script>
