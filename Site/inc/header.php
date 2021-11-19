<header>
    <h3><?= $nomSite ?></h3>
    <ul>
        <li><a href="index.php">Accueil</a></li>
        <?php
            if(!empty($_SESSION['user_id'])){ ?>
        <li><a href="series_list.php">Liste des séries</a></li>
        <li><a href="logout.php">Déconnexion</a></li>
    <?php } else { ?>
        <li><a href="register.php">Inscription</a></li>
        <li><a href="login.php">Connexion</a></li>
    <?php  } ?>
    </ul>
</header>