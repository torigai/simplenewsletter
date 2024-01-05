<?php
require_once "../controller/session.php";
?>

<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSS for login/register/edit form -->
    <link rel="stylesheet" href="../../css/style.css" type="text/css">

    <title>Newsletter | Login</title>
</head>
<body>

<div>
    <img id="logo" class="logo" src="../../logo.png">
</div>
<div class="login-page">
    <div id="title">
            <h1>Login</h1>
    </div>
    <form class="form" action="../controller/login.php" method="post">
        <div class="row">
            <div class="col">
		<input type="text" name="username" placeholder="Name" required/>
            </div>
	</div>
         <div class="row">
            <div class="col">
                <input type="password" name="password" placeholder="Passwort"
                       pattern=".{4,20}" required title="Passwort 4 - 20 Zeichen"/>
            </div>
	</div>
         <div class="row">
            <div class="col">
                <input id="login" type="submit" value="LOGIN">
                <?php if(isset($_GET['error'])){ echo "<p id=\"wrongLogin\">Falsche Eingabe!</p>"; };?>
            </div>
        </div>
    </form>
</div>

</body>
</html>
