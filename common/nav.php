<?php

if($user) {
?>
    <nav>
        <a href="index.php" class="btn btn-top-second">Accueil</a>
        <a href="articles.php" class="btn btn-top-second">Articles</a>
        <a href="logout.php" class="btn btn-top-second">logout</a>
        <?php if($user->isAdmin()) { ?><a href="admin/index.php" class="btn btn-top-second">admin</a><?php } ?>
        <a href="profil.php" class="btn btn-top-main"><?= $user->firstname . " " . $user->lastname ?></a>
    </nav>
<?php
}else{
?>
    <nav>
        <a href="index.php" class="btn btn-top-second">Accueil</a>
        <a href="articles.php" class="btn btn-top-second">Articles</a>
        <a href="login.php" class="btn btn-top-second">Se connecter</a>
        <a href="register.php" class="btn btn-top-main">S'inscrire</a>
    </nav>
<?php
}

?>