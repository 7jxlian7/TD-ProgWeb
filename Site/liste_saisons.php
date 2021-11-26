<?php

session_start();

include('inc/db.php');
require_once('inc/pageProtegee.php');

if(isset($_GET['id'])){
    $req = $db->prepare("SELECT * FROM series WHERE id = ?");
    $req->execute([$_GET['id']]);
    $serie = $req->fetch();

    $req2 = $db->prepare("SELECT * FROM season WHERE series_id = ? ORDER BY number ASC");
    $req2->execute([$_GET['id']]);

    $req3 = $db->prepare("SELECT COUNT(episode.id), season.number
        FROM episode
        JOIN season ON season.id = episode.season_id
        WHERE season.series_id = ?
        GROUP BY season_id 
        ORDER BY season.number ASC");
    $req3->execute([$_GET['id']]);
    
} else {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $nomSite ?> - Liste des séries</title>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>
    <?php include('inc/header.php') ?>
    <main>
        <h2><?= $serie['title'] ?></h2>
        <p><?php $end = $serie['year_end'] ?? '?';
                 echo $serie['year_start'] . " - " . $end ?></p>
        <img src="poster.php?id=<?= $serie['id'] ?>" alt="<?= $serie['title'] ?>">
        <h3>Liste des saisons de la série : <?= $serie['title'] ?></h3>
    <ul>
    <?php
        while($season = $req3->fetch()){
            ?>
                <li>Saison <?= $season['number'] ?> (<?= $season[0] ?> épisodes)</li>
      <?php } 
    ?>
    </ul>
    <p><a href="series_list.php" style="text-decoration: underline;">Revenir à la liste des séries.</a></p>
</body>
</html>
