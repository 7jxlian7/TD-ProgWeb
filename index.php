<?php

$tds = [
    1 => ["multiplications"],
    2 => ["test", "t2"]
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
</body>
</html>