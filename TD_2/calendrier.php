<?php

if(isset($_GET['m']) && isset($_GET['d']) && isset($_GET['y'])){
    $day = $_GET['d'];
    $month = $_GET['m'];
    $year = $_GET['y'];
} else {
    $day = date("d");
    $month = date("m");
    $year = date("y");
}



$premierJourMoisTS = mktime(0, 0, 0, $month, 1, $year);

$premierJourMois = date('d', $premierJourMoisTS);
$premierJourSemaineMois = date('N', $premierJourMoisTS);

$dernierJourMois = date('t', $premierJourMoisTS);

$numeroSemaine = date("W", mktime(0, 0, 0, $month, $day, $year));

$monthTexte = date('F', mktime(0, 0, 0, $month, $day, $year));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier</title>
</head>
<body>
    <style>
        .blue{
            background-color: lightskyblue;
        }
        a{
            text-decoration: none;
        }
    </style>
    <div>
        <a href="calendrier.php?m=<?= $month ?>&d=<?= $day ?>&y=<?= $year ?>">&larr;</a>
        <span><?= $monthTexte ?></span>
        <a href="">&rarr;</a>
    </div>
    <table>
        <tr>
            <td class="blue"></td>
            <td class="blue">lun.</td>
            <td class="blue">mar.</td>
            <td class="blue">mer.</td>
            <td class="blue">jeu.</td>
            <td class="blue">ven.</td>
            <td class="blue">sam.</td>
            <td class="blue">dim.</td>
        </tr>
        <?php
        $jour = 2-$premierJourSemaineMois;
        $currDay = 0;
            for($lig = 0; $lig < 6; $lig++) {
                ?> <tr> <?php
                for($col = 0; $col < 8; $col++){
                    $currDay++;
                    if($col == 0){ ?>
                        <td class="blue"><?= $numeroSemaine ?></td>
                <?php 
                $numeroSemaine++;    
            } else { ?>
                <td <?php
                if($currDay == $day){
                    echo "style='background-color: yellow;'";
                }
                ?>><?= date('d', mktime(0,0,0,$month,$jour++,$year)) ?></td>
        <?php } } ?> </tr> 
        <?php } ?>
    </table>
</body>
</html>