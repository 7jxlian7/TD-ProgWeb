<?php

include('db.php');

header("Content-Type: image/jpeg");

$req = $db->prepare("SELECT poster FROM series WHERE id = ?");
$req->execute([$_GET['id']]);
$serie = $req->fetch();

echo $serie['poster'];
