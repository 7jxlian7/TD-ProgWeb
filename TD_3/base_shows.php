<?php

include('db.php');

class Series{

    public function __toString(): string {
        $end = $this->year_end ?? '?';
        return $this->title." (".$this->year_start." &rarr; ".$end.")";
    }

    public function youtubeTrailerEmbed() {
        echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/'. explode("v=", $this->youtube_trailer)[1] .'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
    }
}

$req = $db->query("SELECT * FROM series");
$req->setFetchMode(PDO::FETCH_CLASS, Series::class);
$serie = $req->fetchAll();

echo $serie[0]->youtubeTrailerEmbed();

exit();

$premiereLettre = "L";
$req = $db->prepare("SELECT * FROM series WHERE title LIKE ?");
$results = $req->execute(array($premiereLettre . "%"));

while($liste_series = $req->fetch()){ ?>
    <h3><?php echo $liste_series['title'] . " (" . $liste_series['id'] . ")"; ?></h3>
<?php } ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base Shows</title>
</head>
<body>
    <form method="POST" action="form_traitement.php">
        <input type="text" placeholder="Initiale de la série..." name="initiale">
        <input type="submit" name="submit">
    </form>
</body>
</html>