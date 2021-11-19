<?php
    $dsn = "mysql:dbname=etu_jforme;host=info-titania.iut.bx1";
    $user = "jforme";
    $password = "Dy4wZSsu";
    $db = new PDO($dsn, $user, $password);
    $db->query('SET CHARSET UTF8');

    $nomSite = "WatchingSeries";
?>