<?php

$tds = [
    1 => ["multiplications"],
    2 => ["calculatrice", "calendrier"],
    3 => ["base_shows"],
    4 => ["utilisateurs"],
    5 => ["cookies_sessions", "morpion"]
]

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercices</title>
</head>
<body>
        <?php
            foreach($tds as $k => $td){ ?>
                <h2>TD <?= $k ?></h2>
        <?php foreach($td as $t){ ?>
                <p><?= $t ?> : <a href='/TD_<?= $k ?>/<?= $t ?>.php'>lien</a>
        <?php }} ?>
        <h2>Site complet (résumé des TD)</h2>
        <p>Site : <a href='/Site'>lien</a>
</body>
</html>