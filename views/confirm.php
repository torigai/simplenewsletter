<?php
 require_once "../controller/confirm.php";
 require_once "../customvars.php";
?>

<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="refresh" content="5; url=<?php echo $url_of_website ?>">
    <link href="../css/style.css" rel='stylesheet' type='text/css'/>
    <title>Newsletter</title>
</head>

<body>
    <div>
        <img id="logo" class="logo" src="../logo.png">
    </div>
    <div class="login-page">
        <p><?php echo $info ?></p>
        <p>In wenigen Sekunden wirst Du auf die Startseite umgeleitet</p>
    </div>
</body>
</html>


