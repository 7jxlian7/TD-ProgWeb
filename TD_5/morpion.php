<?php

$nb_vues = 'X';

session_start();

$j1 = 'O';
$j2 = 'X';
$turn = rand(0, 1);

if(!isset($_SESSION['turn'])){
    $_SESSION['turn'] = $turn == 0 ? $j1 : $j2;
}

$morpion = [];

function remplirMorpion(){
    for($i = 0; $i < 3; $i++){
        $morpion[$i] = [];
        for($j = 0; $j < 3; $j++){
            $morpion[$i][$j] = 0;
        }   
    }
    return $morpion;
}

function afficherMorpion(){ ?>
<table>
    <?php
        $nb_case = 0;
        for($i = 0; $i < 3; $i++){
            for($j = 0; $j < 3; $j++){
                $nb_case++;
                if($j == 0){ ?>
                    <tr>
                <?php } ?>
                <td><a href="play.php?id=<?= $nb_case ?>">jouer</a></td>
            <?php if($j == 2){ ?>
                    </tr>
            <?php  }
            }
        }
    ?>
</table>

<?php } 

function genererChaineAleatoire($longueur = 10)
{
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $longueurMax = strlen($caracteres);
    $chaineAleatoire = '';
    for ($i = 0; $i < $longueur; $i++)
    {
    $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
    }
    return $chaineAleatoire;
}

if(isset($_COOKIE['id'])){
    $_SESSION['id'] = $_COOKIE['id'];
    echo "identifiant de session :" . $_SESSION['id'];
} else {
    setcookie("id", genererChaineAleatoire(10));
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
    <style>
        td{
            text-align: center;
            width: 150px;
            height: 150px;
            border: 1px solid black;
            font-size: 20px;
        }
    </style>
    <?php 
    $morpion = remplirMorpion();
    echo $morpion[0][0];
    afficherMorpion();
    ?>
</body>
</html>