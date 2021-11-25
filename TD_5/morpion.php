<?php

session_start();

$turn = rand(0, 1);

if(!isset($_SESSION['turn'])){
    $_SESSION['turn'] = $turn == 0 ? 'X' : 'O';
}

if(!isset($_SESSION['win'])){
    $_SESSION['win'] = false;
}

if(!isset($_SESSION['draw'])){
    $_SESSION['draw'] = false;
}

if(!isset($_SESSION['morpion'])){
    initMorpion();
}

function initMorpion(){
    $_SESSION['morpion'] = [];
    $_SESSION['win'] = false;
    $_SESSION['draw'] = false;
    for($i = 0; $i < 3; $i++){
        for($j = 0; $j < 3; $j++){
            if (!isset($_SESSION['morpion'][$i])) {
                $_SESSION['morpion'][$i] = [];
            }
            $_SESSION['morpion'][$i][$j] = '0';
        }   
    }
}

function afficherMorpion(){ ?>
<table>
    <?php
        for($i = 0; $i < 3; $i++){
            for($j = 0; $j < 3; $j++){
                if($j == 0){ ?>
                    <tr>
                        <?php } ?>
                        <?php
                    if($_SESSION['morpion'][$i][$j] == '0'){ ?>
                        <td><a href="play.php?id=<?= 3*$i + $j ?>">jouer</a></td>
                  <?php  } else { ?>
                    <td><?= $_SESSION['morpion'][$i][$j] ?></td>
              <?php    }
                if($j == 2){ ?>
                    
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
        afficherMorpion();
        if($_SESSION['win'] == true){ 
            ?>
            <p>Bravo, le joueur qui a gagné est le joueur <?= $_SESSION['turn'] ?></p>
            <button onclick="window.location.reload();">Recommencer ?</button>
        <?php 
        initMorpion();    
        } else if ($_SESSION['draw'] == true){ ?>
            <p>Ooooh... Égalité... On rejoue !</p>
            <button onclick="window.location.reload();">Recommencer ?</button>
        <?php initMorpion(); } ?>
</body>
</html>