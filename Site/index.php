<?php

session_start();
include('inc/db.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $nomSite ?></title>
    
</head>
<body>
    <?php include('inc/header.php') ?>
    <main>
        <h3>Bienvenue sur le site.</h3>
        <p>Vous pouvez retrouver une liste de séries !</p>
    </main>
</body>
</html>