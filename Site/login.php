<?php

session_start();
include('inc/db.php');

if(isset($_SESSION['user_id'])){
    header('Location: series_list.php');
}

if(isset($_POST['submit'])){
    if(isset($_POST['email']) && isset($_POST['password'])){
        $email = htmlspecialchars($_POST['email']);
        $password = sha1($_POST['password']);
        $req = $db->prepare('SELECT user_id FROM user WHERE email = ? AND password = ?');
        $req->execute([$email, $password]);
        if($req->rowCount() == 1){
            $u= $req->fetch();
            $_SESSION['user_id'] = $u['user_id'];
            header('Location: series_list.php');
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $nomSite ?> - Connexion</title>
    
</head>
<body>
    <?php include('inc/header.php') ?>
    <main>
        <h3>Connexion</h3>
        <form method="POST">
            <input type="text" name="email" placeholder="Email...">
            <input type="password" name="password" placeholder="Mot de passe...">
            <input type="submit" name="submit" value="Connexion">
        </form>
    </main>
</body>
</html>