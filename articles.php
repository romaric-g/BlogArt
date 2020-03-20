<?php
session_start();

require_once("./class/Auth/User.php");
require_once("./class/Utils/connection.php");
require_once("./class/Utils/ctrlSaisies.php");
require_once("./class/Blog/Article.php");

require_once("./common/home.php");

$user = User::getLoggedUser($conn);
$articles = Article::loadAll($conn, array(), "", "ORDER BY DtCreA DESC");

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La pression bordelaise</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/css/common.css">
    <link rel="stylesheet" href="styles/css/header.css">
    <link rel="stylesheet" href="styles/css/articles.css">
</head>
<body>
    <?php include("common/header.php"); ?>
    <main>
        <section class="articles container">
            <h2 class="section-title">Nos Articles</h2>
            <?php foreach( $articles as $article ) {?>
                <article class="article row">
                    <div class="article-illu col-md-6">
                        <img src="<?= $article->values["UrlPhotA"] ?>" alt="">
                    </div>
                    <div class="article-content col-md-6">
                        <div class="title">
                            <p><?= $article->values["LibTitrA"] ?></p>
                        </div>
                        <div class="text">
                            <p><?= $article->values["LibChapoA"] ?></p>
                            <a href="article.php?id=<?= $article->primaryKeyValue ?>" class="btn btn-read">Lire</a>
                        </div>
                    </div>
                </article>
            <?php }?>
        </section>
    </main>
</body>
</html>