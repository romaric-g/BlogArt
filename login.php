<?php 
session_start();

require_once("./class/Auth/User.php");
require_once("./class/Utils/connection.php");
require_once("./class/Utils/ctrlSaisies.php");

/* COMPOSANTS */
require_once("./common/home.php");

/* LANGUAGE SYSTEM */
require_once("./lang/language.php");


$LANG = $_SESSION["LANG"];
$LANGUAGE = Language::INIT($LANG, "./");
$user = User::getLoggedUser();

$error = NULL;
if(!$user) {
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["email"]) && isset($_POST["pass"])){
            try {
                $user = User::connectFromEmail($_POST["email"], $_POST["pass"], $conn);
            } catch (AuthException $exception) {
                $error = $exception->getMessage();
            }
        }
    }
}
if($user) {
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La pression bordelaise</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/css/common.css">
    <link rel="stylesheet" href="styles/css/auth.css">

    <link rel="stylesheet" href="styles/css/menu/nav.css">
    <link rel="stylesheet" href="styles/css/menu/m-home.css">

    <link rel="stylesheet" href="styles/css/footer.css">

    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <script src="https://code.createjs.com/1.0.0/createjs.min.js"></script>
    <script src="https://code.createjs.com/1.0.0/tweenjs.min.js"></script>
</head>
<body>
    <?php HOME__($LANG, $user, $LANGUAGE, "./", $conn) ?>
                <div class="container content">
                    <div class="form-box">
                            <h1 class="title">Connectez-Vous</h1>
                            <form method="POST" action="">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email" value="<?= isset($_POST["email"]) ? $_POST["email"] : '' ?>">
                                </div>
                                <div class="form-group">
                                    <label for="pass">Mot de passe</label>
                                    <input type="password" class="form-control" name="pass" placeholder="mot de passe">
                                </div>
                                <?php
                                    if($error) {
                                ?>
                                <div class="alert alert-danger">
                                    <?= $error ?>
                                </div>
                                <?php     
                                    }
                                ?>
                                <div class="form-group">
                                <button type="submit" class="btn btn-login anim">Se connecter</button>
                                <p class="already-accound">Vous n'avez pas encore compte ? <br><a href="register.php">Inscrivez-vous</a></p>
                            </form>
                        </div>
                </div>
    <?php __HOME() ?>
    <main>

    </main>
    <?php include "common/footer.php"; ?>
</body>
</html>