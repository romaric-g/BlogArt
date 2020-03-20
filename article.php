<?php
require_once("class/Auth/User.php");
require_once("class/Utils/ctrlSaisies.php");
require_once("class/Utils/connection.php");
require_once("class/Blog/Article.php");
require_once("class/Blog/KeyWord.php");

$user = User::getLoggedUser($conn);
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
    }else{
        header("Location: index.php");
    }
}else{
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/css/common.css">
    <link rel="stylesheet" href="styles/css/header.css">
    <link rel="stylesheet" href="styles/css/article.css">
    <title>Document</title>
</head>
<body>
    <?php require("common/header.php") ?>
    <main>
        <div class="container article">
            <section class="head">
                <h1 class="title"><?= $article->values["LibTitrA"]; ?></h1>
                <p class="chapo"><?= $article->values["LibChapoA"]; ?></p>
                <p class="accroche"><?= $article->values["LibAccrochA"]; ?></p>
                <p class="text"><?= $article->values["Parag1A"]; ?></p>
            </section>
    
            <section class="para">
                <h2 class="stitre"><?= $article->values["LibSsTitr1"]; ?></h2>
                <p class="text"><?= $article->values["Parag2A"]; ?></p>
            </section>

            <section class="para">
                <h2 class="stitre"><?= $article->values["LibSsTitr2"]; ?></h2>
                <p class="text"><?= $article->values["Parag3A"]; ?></p>
            </section>
                
            <section class="concl">
                    <p class="text"><?= $article->values["LibConclA"]; ?></p>
            </section>
        </div>
    </main>
</body>
</html>