<?php

include('db.php');

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
    header('Location: base_shows.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des saisons</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif;">
    <h2>Liste des saisons de la série : <?= $serie['title'] ?></h2>
    <ul>
    <?php
        while($season = $req3->fetch()){
            ?>
                <li>Saison <?= $season['number'] ?> (<?= $season[0] ?> épisodes)</li>
      <?php } 
    ?>
    </ul>
</body>
</html>