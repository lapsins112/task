<?php
require_once("includes/doc-handler.inc.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avansa norēķinu atskaites</title>
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
</head>
<body>
<div class="container">
    <div class="heading">
        <h1>Avansa norēķinu atskaites.</h1>
        <a class="page-btn" href="index.php">Iesniegšana</a>
        <a class="page-btn" href="report.php">Apstiprināšana</a>
    </div>
    <div class="wrapper">
        <?php
            echo printDoc(newSelectOb());
        ?>
    </div>
</div> 
</body>
</html>