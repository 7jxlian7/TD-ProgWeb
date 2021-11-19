<?php

include('db.php');

$country = [];

$req = $db->query('SELECT * FROM country');
$req->execute();

// Code retrouvé sur internet
function genererChaineAleatoire($longueur = 10)
{
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';
    for($i=0; $i<$longueur; $i++){
        $string .= $chars[rand(0, strlen($chars)-1)];
    }
    return $string;
}

if(isset($_POST['submit'])){
    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['country']) && isset($_POST['password'])){
        $username = htmlspecialchars($_POST['username']);
        $password = sha1($_POST['password']);
        $country = $_POST['country'];
        $email = htmlspecialchars($_POST['email']);

        if($country == "autrePays" && isset($_POST['otherCountry'])){
            if(!empty($_POST['otherCountry'])){
                $ins = $db->prepare('INSERT INTO country(name) VALUES(?)');
                $ins->execute([$_POST['otherCountry']]);
                $country = $db->lastInsertId();
            }
        }
        if(strlen($username) > 5){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $user_id = genererChaineAleatoire(30);
                $ins = $db->prepare('INSERT INTO user(name, email, password, register_date, admin, country_id, user_id) VALUES(?,?,?,?,?,?,?)');
                $ins->execute(array($username, $email, $password, date('Y-m-d G-i-s'), 0, $country, $user_id));
                $success = "Votre compte a bien été créé";
            } else {
                $err = "Votre email est invalide.";
            }
        } else {
            $err = "Votre pseudo doit comporter plus de 5 caractères.";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateurs</title>
</head>
<body>
    <h3>Inscription utilisateur :</h3>
    <form method="POST">
        <input type="text" name="username" placeholder="Pseudo...">
        <input type="text" name="email" placeholder="Email...">
        <input type="password" name="password" placeholder="Mot de passe...">
        <select name="country">
            <?php
                while($c = $req->fetch()){ ?>
                    <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
          <?php } ?>
            <option value="autrePays">Autre (spécifier)</option>
        </select>
        <input type="text" placeholder="Autre..." name="otherCountry" />
        <input type="submit" name="submit" value="M'inscrire">
        <?php
            if(isset($err)){ ?>
            <p style="color: red;">Erreur : <?= $err ?><p>
        <?php } ?>
        <?php
            if(isset($success)){ ?>
            <p style="color: green;"><?= $success ?><p>
        <?php } ?>
    </form>
</body>
</html>