<?php
require_once("includes/doc-handler.inc.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumenta apstiprināšana</title>
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
</head>
<body>
<div class="container">
    <div class="heading">
        <h1>Dokumenta apstiprināšana.</h1>
        <a class="page-btn" href="index.php">Iesniegšana</a>
        <a class="page-btn" href="documents.php">Atskaites</a>
    </div>
    <div class="wrapper">
        <?php
            echo printData(newSelectOb());
        ?>
    </div>
</div> 
</body>
</html>