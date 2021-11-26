<?php

session_start();

include('inc/db.php');
require_once('inc/pageProtegee.php');

if (isset($_GET['page'])) {
    if ($_GET['page'] < 1 || $_GET['page'] == NULL) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}

$req = $db->prepare('SELECT * FROM user WHERE user_id = ?');
$req->execute([$_SESSION['user_id']]);
$user = $req->fetch();

$req_like = $db->prepare('SELECT series_id FROM user_series WHERE user_id = ?');
$req_like->execute([$_SESSION['id']]);
$likes = $req_like->fetchAll();

class Series
{

    public function __toString(): string
    {
        $end = $this->year_end ?? '?';
        return $this->title . " (" . $this->year_start . " &rarr; " . $end . ")";
    }

    public function getYoutubeUrl()
    {
        return explode("v=", $this->youtube_trailer)[1];
    }

    public function youtubeTrailerEmbed()
    {
        echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . explode("v=", $this->youtube_trailer)[1] . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
    }
}

if (isset($_GET['page'])) {
    $pageId = $_GET['page'];
} else {
    $pageId = 1;
}

$req_sql = "SELECT * FROM series";
$params = [];

if(isset($_GET['likees']) && !empty($_GET['likees'])){
    $params['user_id'] = $_SESSION['id'];
    $req_sql .= " INNER JOIN user_series ON (series.id = user_series.series_id AND user_series.user_id = :user_id)";
}

if(isset($_GET['search']) && !empty($_GET['search'])){
    $params['title'] = '%' . $_GET['search'] . '%';
    $req_sql .= " WHERE series.title LIKE :title";
}

$limit = 15 * ($pageId - 1);

// Requete pour le nombre de pages totales
$req = $db->prepare($req_sql);
$req->execute($params);

$series_number = $req->rowCount();
$pages_number = $series_number / 15;

$req_sql .= " ORDER BY title ASC 
                        LIMIT " . intval($limit) . " , 15";

// Requete pour récupérer les séries
$req = $db->prepare($req_sql);
$req->execute($params);                      
$req->setFetchMode(PDO::FETCH_CLASS, Series::class);
$series = $req->fetchAll();


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
        <h3>Bienvenue, <?= $user['name'] ?>.</h3>
        <p> Quelle série souhaitez-vous regarder aujourd'hui ?</p>
        <form class="recherche-serie" method="GET">
            <input type="text" name="search" placeholder="Ex: My Hero Academia">
            <button type="submit"><i class="fa fa-search"></i></button>
            <input type="checkbox" class="likees" name="likees" <?php if(isset($_GET['likees'])) echo "checked"; ?>>
            <label for="likees">Séries suivies</label>
        </form>
        <div class="series-content">
            <?php
            if (isset($req_s)) {
                if ($req_s->rowCount() == 0) { ?>
                    <p>Il n'y a rien à afficher ici...</p>
        <?php  }
            }
            foreach ($series as $s) { ?>
                <div class="serie" id="<?= $s->id ?>">
                    <img src="poster.php?id=<?= $s->id ?>" alt="<?= $s->title ?>">
                    <div class="info-serie">
                        <h3><a href="liste_saisons.php?id=<?= $s->id ?>"><?php echo $s->title . " (" . $s->id . ")"; ?></a></h3>
                        <p><?php
                            $end = $s->year_end ?? '?';
                            echo $s->year_start . " - " . $end ?></p>
                        <a href="https://www.youtube.com/watch?v=<?= $s->getYoutubeUrl() ?>" alt="<?= $s->title ?>">Voir le trailer</a>
                        <br>
                        <!-- href="inc/like.php?id=<?= $s->id ?>#<?= $s->id ?>" -->
                        <a class="bouton_like" data-id="<?= $s->id ?>">
                            <i class="fa fa-heart
                        <?php
                            foreach ($likes as $liked_serie) {
                                if ($liked_serie['series_id'] == $s->id) {
                                    echo "liked";
                                }
                            } ?>" data-heart-id="<?= $s->id ?>"></i>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div style="text-align: center; margin-top: 25px;">
        <?php if($pageId > 1) { ?>
            <a id="pagination" href="series_list.php?page=<?php if (isset($_GET['page'])) echo $_GET['page'] - 1;
                                                            else echo "1"; ?><?php if (isset($_GET['search'])) { echo "&search=" . $_GET['search']; } if (isset($_GET['likees'])) { echo "&likees=on"; }  ?>#pagination">&#129044;</a>
        <?php } ?>
            <span>Page <?php if (isset($_GET['page'])) echo $_GET['page']; else echo "1"; ?></span>
            <?php if($pageId <= $pages_number) { ?>
            <a href="series_list.php?page=<?php if (isset($_GET['page'])) echo $_GET['page'] + 1; else echo "2"; ?><?php if (isset($_GET['search'])) {echo "&search=" . $_GET['search'];} if (isset($_GET['likees'])) { echo "&likees=on"; } ?>#pagination">&#129046;</a>
            <?php } ?>
        </div>
    </main>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.bouton_like').click(function () {
                let serie_id = $(this).attr('data-id');
                $.get("inc/like.php?id="+serie_id, function(data){
                    let coeurSerie = $("[data-heart-id='" + serie_id + "']");
                    if(data == "0"){
                        coeurSerie.removeClass('liked');
                    } else {
                        coeurSerie.addClass('liked');
                    }
                })
            });
        });
    </script>
</body>
</html>