<?php
session_start();

require_once("./class/Auth/User.php");
require_once("./class/Utils/connection.php");
require_once("./class/Utils/ctrlSaisies.php");
require_once("./class/Blog/Article.php");

/* COMPOSANTS */
require_once("./common/header.php");

/* LANGUAGE SYSTEM */
require_once("./lang/language.php");

$LANG = $_SESSION["LANG"];
$LANGUAGE = Language::INIT($LANG, "./");

$USER = User::getLoggedUser($conn);

if(!$USER) {
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
    <link rel="stylesheet" href="styles/css/header.css">
    <link rel="stylesheet" href="styles/css/m-header.css">
    <link rel="stylesheet" href="styles/css/nav.css">
    <link rel="stylesheet" href="styles/css/nav_dark.css">
    <link rel="stylesheet" href="styles/css/profil.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <script src="https://code.createjs.com/1.0.0/createjs.min.js"></script>
    <script src="https://code.createjs.com/1.0.0/tweenjs.min.js"></script>
</head>
<body>
    <?php PAGEHEADER($LANG, $USER, $LANGUAGE, "./", $conn) ?>
    <main>
   
    <div class="container">
  <div class="row">
    <div class="col">
    <div class="image-user">
            <img src="https://www.gravatar.com/avatar/9d7ccc9ba7020ed15feccc1c21846ca5?d=https%3A%2F%2Fwww.cierpgaud.fr%2Fwp-content%2Fuploads%2F2018%2F07%2Favatar.jpg&s=40" height="300px" width="300px">
        </div>
      <div>
      <button type="submit" class="btn btn-primary" id="change-user">Modifier le nom d'utilisateur</button>
      </div>
    </div>
  
    <div class="col-6">
        <h1>Informations actuelles:</h1>
    <form>
        <div class="form-group">
          <label class="changerutilisateur" for="exampleInputprénom1">Modifier votre Nom d'utilisateur</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ex: bièrette3322">
        </div>
        <div class="form-group">
            <label class="changeremail" for="exampleInputemail1">Modifier votre adresse email</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="ex: jacques@hotmail.fr">
          </div>
        <div class="form-group">
            <label class="changerpassword" for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Nouveau mot de passe">
          </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
      </form>
    </div>
    </div>
</div>
    </main>
</body>
</html>