<?php
session_start();

require_once("./class/Auth/User.php");
require_once("./class/Utils/connection.php");
require_once("./class/Utils/ctrlSaisies.php");
require_once("./class/Blog/Article.php");

require_once("./common/header.php");

/* LANGUAGE SYSTEM */
require_once("./lang/language.php");

$LANG = $_SESSION["LANG"];
$LANGUAGE = Language::INIT($LANG, "./");

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
    <link rel="stylesheet" href="styles/css/nav.css">
    <link rel="stylesheet" href="styles/css/nav_dark.css">
    <link rel="stylesheet" href="styles/css/articles.css">
</head>
<body>
    <?php PAGEHEADER($LANG, $user, $LANGUAGE, "./", $conn) ?>
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