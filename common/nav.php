<?php

if($user) {
?>
    <nav>
        <p><?= $user->firstname . " " . $user->lastname ?></p>
        <a href="loggout" class="btn btn-top-main">Loggout</a>
    </nav>
<?php
}else{
?>
    <nav>
        <a href="login" class="btn btn-top-second">Se connecter</a>
        <a href="register" class="btn btn-top-main">S'inscrire</a>
    </nav>
<?php
}

?>