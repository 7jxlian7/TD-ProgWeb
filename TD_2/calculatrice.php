<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculatrice</title>
</head>
<body>
    <h2>Calculatrice GET</h2>
    <form method="GET">
        <input type="text" name="nb1">
        <span>+</span>
        <input type="text" name="nb2">
        <span>=</span>
        <input type="submit">
    </form>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'GET'){ 
            $nb1 = $_GET['nb1'];
            $nb2 = $_GET['nb2'];
            if(!empty($nb1) && !empty($nb2)){?>
        <p>Le résultat est : <?= $nb1+$nb2 ?></p>
    <?php }} ?>
    <h2>Calculatrice POST</h2>
    <form method="POST">
        <input type="text" name="nb1">
        <span>+</span>
        <input type="text" name="nb2">
        <span>=</span>
        <input type="submit">
    </form>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
            $nb1 = $_POST['nb1'];
            $nb2 = $_POST['nb2'];
            if(!empty($nb1) && !empty($nb2)){?>
        <p>Le résultat est : <?= $nb1+$nb2 ?></p>
    <?php }} ?>
</body>
</html>