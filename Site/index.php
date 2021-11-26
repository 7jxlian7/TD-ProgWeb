<?php

session_start();
include('inc/db.php');

if(isset($_SESSION['id'])){
    $req = $db->prepare('SELECT * FROM user WHERE id = ?');
    $req->execute([$_SESSION['id']]);
    $user = $req->fetch();

    $req = $db->prepare('SELECT * FROM series INNER JOIN user_series ON (series.id = user_series.series_id AND user_series.user_id = ?)');
    $req->execute([$_SESSION['id']]);
    $series = $req->fetchAll();
    $nbSeriesAimees = $req->rowCount();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $nomSite ?></title>
    
</head>
<body>
    <?php include('inc/header.php') ?>
    <main>
        <h3>Bienvenue sur le site<?php
            if(isset($_SESSION['id'])){
                echo ", " . $user['name'];
            }
        ?>.</h3>
        <p>Sur ce site vous pouvez accéder à notre base de séries 🎬</p>
        <?php
            if(isset($_SESSION['id'])){ ?>
                <p>Voici les dernières séries que vous aimez (<span class="bold"><?= $nbSeriesAimees ?> séries</span>) 🙂</p>
                <div class="series-content">
            <?php
            if (isset($req_s)) {
                if ($req_s->rowCount() == 0) { ?>
                    <p>Il n'y a rien à afficher ici...</p>
        <?php  }
            }
            foreach ($series as $s) { ?>
                <div class="serie" id="<?= $s['id'] ?>">
                    <img src="poster.php?id=<?= $s['id'] ?>" alt="<?= $s['title'] ?>">
                    <div class="info-serie">
                        <h3><a href="liste_saisons.php?id=<?= $s['id'] ?>"><?php echo $s['title'] . " (" . $s['id'] . ")"; ?></a></h3>
                        <p><?php
                            $end = $s['year_end'] ?? '?';
                            echo $s['year_start'] . " - " . $end ?></p>                      
                    </div>
                </div>
            <?php } ?>
        </div>
            <?php }

        ?>
    </main>
</body>
</html>