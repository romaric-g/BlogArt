<?php 

require("../access.php");
require("../common/layout.php");

require_once("./../../class/Utils/ctrlSaisies.php");
require_once("./../../class/Utils/connection.php");
require_once("./../../class/Blog/Article.php");
require_once("./../../class/Blog/KeyWord.php");

$article = NULL;

if($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["id"])) {
        $NumArt = ctrlSaisies($_GET["id"]);
        $article = new Article($NumArt);
        $joins = array(
            new Join("THEMATIQUE", "NumThem", "NumThem"),
            new Join("ANGLE", "NumAngl", "NumAngl"),
            new Join("LANGUE", "NumLang", "NumLang")
        );
        $article->loadDataFromSQL($conn, $joins);
        $article->loadKeywords($conn);
    }
}else{
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
    <link rel="stylesheet" href="../../styles/css/admin/commons.css">
    <link rel="stylesheet" href="../../styles/css/admin/commentaires.css">
    <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
</head>
<?php LAYOUT__(); ?>
    <div class="container">
            <h1><?= $article->values["LibTitrA"]; ?></h1>
            <img src="<?= $article->values["UrlPhotA"]; ?>" alt="" srcset="">
            <p><?= $article->values["LibChapoA"]; ?></p>
            <p><?= $article->values["LibAccrochA"]; ?></p>
            <h2><?= $article->values["LibSsTitr1"]; ?></h2>
            <p><?= $article->values["Parag1A"]; ?></p>
            <h2><?= $article->values["LibSsTitr2"]; ?></h2>
            <p><?= $article->values["Parag2A"]; ?></p>
            <h2><?= $article->values["LibSsTitr2"]; ?></h2>
            <p><?= $article->values["Parag2A"]; ?></p>
            <p><?= $article->values["LibConclA"]; ?></p>
            <a href="" class="btn btn-success">Likes <?= $article->values["Likes"]; ?></a>
            <div>
                <?php foreach($article->keywords as $keyword) { ?>
                    <span class="badge badge-dark"><?= $keyword->values["LibMoCle"]; ?></span>
                    
                <?php } ?>
                </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Langue</th>
                        <th scope="col">Theme</th>
                        <th scope="col">Angle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $article->tuple["Lib1Lang"] ?></td>
                        <td><?= $article->tuple["LibThem"] ?></td>
                        <td><?= $article->tuple["LibAngl"] ?></td>
                    </tr>
                </tbody>
            </table>
    </div>
<?php __LAYOUT(); ?>