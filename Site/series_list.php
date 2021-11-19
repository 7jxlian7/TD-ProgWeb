<?php

session_start();
include('inc/db.php');

if(!isset($_SESSION['user_id'])){
    header('Location: login.php');
}

if(isset($_GET['page'])){
    if($_GET['page'] < 1 || $_GET['page'] == NULL ){
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

$req = $db->prepare('SELECT * FROM user WHERE user_id = ?');
$req->execute([$_SESSION['user_id']]);
$user = $req->fetch();

class Series{

    public function __toString(): string {
        $end = $this->year_end ?? '?';
        return $this->title." (".$this->year_start." &rarr; ".$end.")";
    }

    public function getYoutubeUrl() {
        return explode("v=", $this->youtube_trailer)[1];
    }

    public function youtubeTrailerEmbed() {
        echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/'. explode("v=", $this->youtube_trailer)[1] .'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
    }
}

if(isset($_GET['page'])){
    $pageId = $_GET['page'];
} else {
    $pageId = 1;
}

$limit1 = 15*($pageId-1);
$req_s = $db->query("SELECT * FROM series ORDER BY title ASC LIMIT $limit1, 15");
$req_s->setFetchMode(PDO::FETCH_CLASS, Series::class);
$series = $req_s->fetchAll();

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
        <h3>Bienvenue, <?= $user['name'] ?></h3>
        <div class="series-content">
        <?php
        if(isset($req_s)){
            if($req_s->rowCount() == 0){ ?>
                <p>Il n'y a rien à afficher ici...</p>
    <?php    }
        }
        foreach($series as $s){ ?>
            <div class="serie">
                <img src="poster.php?id=<?= $s->id ?>" alt="<?= $s->title ?>">
                <div class="info-serie">
                    <h3><a href="liste_saisons.php?id=<?= $s->id ?>"><?php echo $s->title . " (" . $s->id . ")"; ?></a></h3>
                    <p><?php
                    $end = $s->year_end ?? '?';
                    echo $s->year_start . " - " . $end?></p>
                    <a href="https://www.youtube.com/watch?v=<?= $s->getYoutubeUrl() ?>" alt="<?= $s->title ?>">Voir le trailer</a>
                    <br>
                    <a style="font-size: 16px;" href="like.php?id=<?= $s->id ?>">&#x2661;</a>
                </div>
            </div>
        <?php } ?>
        </div>
        <div style="text-align: center; margin-top: 25px;">
            <a id="pagination" href="series_list.php?page=<?php if(isset($_GET['page'])) echo $_GET['page']-1; else echo "1"; ?>#pagination">&#129044;</a>
            <span>Page <?php if(isset($_GET['page'])) echo $_GET['page']; else echo "1"; ?></span>
            <a href="series_list.php?page=<?php if(isset($_GET['page'])) echo $_GET['page']+1; else echo "2"; ?>#pagination">&#129046;</a>
        </div>
    </main>
</body>
</html>