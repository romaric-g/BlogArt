<?php

if($user) {
?>
    <nav>
        <a href="logout.php" class="btn btn-top-second">logout</a>
        <a href="profil.php" class="btn btn-top-main"><?= $user->firstname . " " . $user->lastname ?></a>
    </nav>
<?php
}else{
?>
    <nav>
        <a href="login.php" class="btn btn-top-second">Se connecter</a>
        <a href="register.php" class="btn btn-top-main">S'inscrire</a>
    </nav>
<?php
}

?>