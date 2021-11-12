<?php

include('db.php');

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

$req = $db->query("SELECT * FROM series");
$req->setFetchMode(PDO::FETCH_CLASS, Series::class);
$series = $req->fetchAll();

/*
$premiereLettre = "L";
$req = $db->prepare("SELECT * FROM series WHERE title LIKE ?");
$results = $req->execute(array($premiereLettre . "%"));

while($liste_series = $req->fetch()){ ?>
    <h3><?php echo $liste_series['title'] . " (" . $liste_series['id'] . ")"; ?></h3>
<?php } ?>
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base Shows</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">
    <h2>Liste de toutes les séries de la base de données</h2>
    <div style="display: flex; flex-wrap: wrap; justify-content: space-around;">
    <?php
        foreach($series as $s){ ?>
           <div style="width:200px; display:flex; justify-content: space-between; border: 2px solid black; border-radius: 5px; background-color: #b8e994; padding: 5px;">
           <div>     
                <h3><a style="text-decoration: none; color: black;" href="liste_saisons.php?id=<?= $s->id ?>"><?php echo $s->title . " (" . $s->id . ")"; ?></a></h3>
                <p><?php
                 $end = $s->year_end ?? '?';
                 echo $s->year_start . " - " . $end?></p>
                 <a style="color: black;" href="https://www.youtube.com/watch?v=<?= $s->getYoutubeUrl() ?>" alt="<?= $s->title ?>">Voir le trailer</a>
            </div>
                <img style="height: 100px;" src="poster.php?id=<?= $s->id ?>" alt="<?= $s->title ?>">
            </div>
            <br>
    <?php } ?>
    </div>
    <form method="POST" action="form_traitement.php">
        <input type="text" placeholder="Initiale de la série..." name="initiale">
        <input type="submit" name="submit">
    </form>
</body>
</html>