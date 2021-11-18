<?php

$nb_vues = 'X';

if(isset($_COOKIE['vue'])){
    $nb_vues = $_COOKIE['vue'];
    setcookie("vue", $_COOKIE['vue']+1);
} else {
    setcookie("vue", 1);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercices</title>
</head>
<body>
       <p>Salut, c'est la <?= $nb_vues ?> que tu viens sur cette page...</p>
</body>
</html>