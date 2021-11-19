<?php
    // info-titania.iut.bx1
    // jforme
    // Dy4wZSsu
    $dsn = "mysql:dbname=etu_jforme;host=info-titania.iut.bx1";
    $user = "jforme";
    $password = "Dy4wZSsu";
    $db = new PDO($dsn, $user, $password);
    $db->query('SET CHARSET UTF8');
?>