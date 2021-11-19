<?php

include('inc/db.php');

if(isset($_GET['id']) && isset($_SESSION['user_id'])){
    $req_s = $db->prepare('SELECT * FROM series WHERE id = ?');
    $req_s->execute([$_GET['id']]);
    $serie = $req_s->fetch();

    $req_u_s = $db->prepare('SELECT * FROM user_serie WHERE user_id = ? AND series_id = ?');
    $req_u_s->execute([$_SESSION['user_id'], $_GET['id']]);
    //faire rowcount
}

?>