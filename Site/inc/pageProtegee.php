<?php
if(!isset($_SESSION['id'])){
    header('Location: login.php');
    $_SESSION['pagePrec'] = $_SERVER['REQUEST_URI'];
}
