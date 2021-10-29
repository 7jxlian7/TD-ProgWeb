<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiplications</title>
</head>
<body>
    <?php
        $nombre = 9;
        $nb1 = -1;
        $nb2 = -1;
        if(isset($_GET['nb1']) && isset($_GET['nb2'])){
            if(!empty($_GET['nb1']) && !empty($_GET['nb2'])){
                $nb1 = $_GET['nb1'];
                $nb2 = $_GET['nb2'];
            }
        }
    ?>
    <table>
    <?php
        for ($i = 1; $i <= $nombre; $i++) { ?>
            <tr>
                <?php
                    for ($j = 1; $j <= $nombre; $j++) { 
                    $type = ($i == 1 || $j == 1) ? "th" : "td";
                    $click = ($i == 1 || $j == 1) ? false : true;
                ?>
                <<?= $type ?><?php 
                if($nb1 == $i || $nb2 == $j) {?>
                 style="background-color: yellow;"
                <?php } ?>>
                <?php
                    if($click){ ?>
                    <a href="multiplications.php?nb1=<?= $i ?>&nb2=<?= $j ?>">
                  <?php } ?>
                        <?= $i*$j ?> 
                  <?php
                    if($click){ ?>
                    </a>
                <?php } ?>
                </<?= $type ?>>
                <?php } ?>
            </tr>
        <?php } ?>
    </table>
</body>
</html>