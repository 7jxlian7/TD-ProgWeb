<?php
    // etu_jforme
    // info-titania.iut.bx1
    // jforme
    // Dy4wZSsu
    $dsn = "mysql:dbname=etu_jforme;host=localhost";
    $user = "root";
    $password = "";
    $db = new PDO($dsn, $user, $password);
    $db->query('SET CHARSET UTF8');

    $nomSite = "WatchingSeries";
?>