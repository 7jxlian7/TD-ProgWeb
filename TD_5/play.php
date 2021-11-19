<?php

session_start();

function checkWin(){
    for($i = 0; $i <= 2; $i++){
        // Check ligne
        if($_SESSION['morpion'][$i][0] != '0' && $_SESSION['morpion'][$i][0] == $_SESSION['morpion'][$i][1] && $_SESSION['morpion'][$i][1] == $_SESSION['morpion'][$i][2]){
            return true;
        }
        // Check colonne
        if($_SESSION['morpion'][0][$i] != '0' && $_SESSION['morpion'][0][$i] == $_SESSION['morpion'][1][$i] && $_SESSION['morpion'][1][$i] == $_SESSION['morpion'][2][$i]){
            return true;
        }
        // Check diag
        if($_SESSION['morpion'][0][0] != '0' && $_SESSION['morpion'][0][0] == $_SESSION['morpion'][1][1] && $_SESSION['morpion'][1][1] == $_SESSION['morpion'][2][2]){
            return true;
        }
        if($_SESSION['morpion'][2][0] != '0' && $_SESSION['morpion'][2][0] == $_SESSION['morpion'][1][1] && $_SESSION['morpion'][1][1] == $_SESSION['morpion'][0][2]){
            return true;
        }
    }
    return false;
}

if(isset($_SESSION['turn']) && isset($_GET['id'])){
    $idCase = $_GET['id'];
    $turn = $_SESSION['turn'];
    if($idCase >= 0 && $idCase <= 9 && ($_SESSION['turn'] == 'X' || $_SESSION['turn'] == 'O')){
        $y = $idCase % 3;
        $x = ($idCase - $y) / 3;
        if($_SESSION['morpion'][$x][$y] == '0'){
            $_SESSION['morpion'][$x][$y] = $_SESSION['turn'];
            if(checkWin()){
                echo "hello";
                $_SESSION['win'] = true;
            } else {
                $_SESSION['turn'] = $_SESSION['turn'] == 'X' ? 'O' : 'X';
            }
        }
    }
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
