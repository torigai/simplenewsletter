<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../css/style.css" rel='stylesheet' type='text/css'/>
    <title>Newsletter</title>
</head>

<body>
    <div>
	<img id="logo" class="logo" src="../logo.png">
    </div>
    <div class="login-page">
        <div id="title">
            <h1>Newsletter</h1>
        </div>
	<form class="form" action="../controller/register.php" method="post">
            <div class="row">
                <div class="col">
                    <input type="email" name="email" placeholder="Email" required/>
                    <p class="wrongInput" <?= (!isset($_GET['errorEmail'])) ?:"style='display: block;'"?>>
                        <span>Die email ist bereits registriert!</span>
                    </p>
                    <p class="wrongInput" <?= (!isset($_GET['errorNotRegistered'])) ?:"style='display: block;'"?>>
                        <span>Die email ist nicht registriert!</span>
                    </p>
                    <p class="wrongInput" <?= (!isset($_GET['errorSendEmail'])) ?:"style='display: block;'"?>>
                        <span>Die email konnte nicht gesendet werden!</span>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input id="register" type="submit" value="ANMELDEN">
                    <input id="unsubscribe" type="submit" value="ABMELDEN">            
                </div>
            </div>
        </form>
    </div>

</body>
</html>

<script>
    document.getElementById("unsubscribe").onclick = function () 
    {
        document.forms[0].action = "../controller/unsubscribe.php";
        return document.forms[0].submit();
    }

    document.getElementById("register").onclick = function () 
    {
        document.forms[0].action = "../controller/register.php";
        return document.forms[0].submit();
    }
</script>
