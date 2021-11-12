<?php

include('db.php');

$req = $db->prepare("SELECT * FROM series WHERE title LIKE ?");
if(isset($_POST['initiale'])){
    $results = $req->execute(array($_POST['initiale'] . "%"));
} else {
    $results = "Erreur...";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base Shows</title>
</head>
<body>
    <?php
        while($liste_series = $req->fetch()){ ?>
            <h3><?php echo $liste_series['title'] . " (" . $liste_series['id'] . ")"; ?></h3>
    <?php } ?>
    <form method="POST" action="form_traitement.php">
        <input type="text" placeholder="Initiale de la série..." name="initiale">
        <input type="submit" name="submit">
    </form>
</body>
</html>