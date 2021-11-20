<?php

session_start();

include('db.php');

if(isset($_GET['id']) && isset($_SESSION['id'])){
    $req = $db->prepare('SELECT id FROM series WHERE id = ?');
    $req->execute([$_GET['id']]);
    $count = $req->rowCount();
    $serieId = $_GET['id'];
    if($count == 1){
        $req = $db->prepare('SELECT * FROM user_series WHERE user_id = ? AND series_id = ?');
        $req->execute([$_SESSION['id'], $serieId]);
        $isLiked = $req->rowCount() == 0 ? false : true;
        if(!$isLiked){
            echo $_SESSION['id'];
            $req1 = $db->prepare('INSERT INTO user_series(user_id, series_id) VALUES (?,?)');
            $req1->execute([$_SESSION['id'], $serieId]);
        } else {
            $req = $db->prepare('DELETE FROM user_series WHERE user_id = ? AND series_id = ?');
            $req->execute([$_SESSION['id'], $serieId]);
        }
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    header('Location: ../index.php');
}
exit();