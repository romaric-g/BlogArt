<?php 
session_start();

require_once("./class/Auth/User.php");
require_once("./class/Utils/connection.php");
require_once("./class/Utils/ctrlSaisies.php");

require_once("./common/home.php");


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
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
</head>
<body>
    <?php HOME__() ?>
                <?php include("common/nav.php") ?>
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
                                <p class="already-accound">Vous n'avez pas encore compte ? <br><a href="register">Inscrivez-vous</a></p>
                            </form>
                        </div>
                </div>
    <?php __HOME() ?>
    <main>

    </main>
</body>
</html>