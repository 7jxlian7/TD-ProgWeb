<header>
    <h3><a href="index.php"><?= $nomSite ?></a></h3>
    <ul class="menu">
    <a href="index.php"><li>Accueil</li></a>
        <?php
            if(!empty($_SESSION['user_id'])){ ?>
        <a href="series_list.php"><li>Liste des séries</li></a>
        <a href="logout.php"><li>Déconnexion</li></a>
    <?php } else { ?>
        <a href="register.php"><li>Inscription</li></a>
        <a href="login.php"><li>Connexion</li></a>
    <?php  } ?>
    </ul>
</header>