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
    <title>Admin | Preview</title>
 </head>
<body>
 <div class="login-page">
  <p><?php echo (isset($_GET["info"])) ? $_GET["info"] : "ERROR"; ?></p>
 </div>
</body>
</html>
