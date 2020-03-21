<?php
session_start();

require_once("./class/Auth/User.php");
require_once("./class/Utils/connection.php");
require_once("./class/Utils/ctrlSaisies.php");
require_once("./class/Blog/Article.php");

/* COMPOSANTS */
require_once("./common/home.php");
require_once("./common/nav.php");

/* LANGUAGE SYSTEM */
require_once("./lang/language.php");

$LANG = $_SESSION["LANG"];
$LANGUAGE = Language::INIT($LANG, "./");

$USER = User::getLoggedUser($conn);
$articles = Article::loadAll($conn, array(), "NumLang = '$LANG'", "ORDER BY DtCreA DESC LIMIT 5");

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La pression bordelaise</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/css/common.css">
    <link rel="stylesheet" href="styles/css/nav.css">
    <link rel="stylesheet" href="styles/css/home.css">
    <link rel="stylesheet" href="styles/css/index.css">
    <link rel="stylesheet" href="styles/css/articles.css">
</head>
<p style="margin: 0; color: white">Les CRUDs ont été déplacés <a href="CRUD/">ici</a></p>
<body>
    <?php HOME__() ?>
                <?php NAV($LANG, $USER, $LANGUAGE, "./", $conn) ?>
                <div class="container content">
                    <h1 class="bigtitle">
                        <span><?= $LANGUAGE->for("title","start") ?></span>
                        <span><?= $LANGUAGE->for("title","end") ?></span>
                    </h1>
                </div>
    <?php __HOME() ?>
    <main>
        <section class="articles container">
            <div style="position: absolute; height: 0;">
                <svg><defs><clipPath id="courbe" clipPathUnits="objectBoundingBox"><path d="M0,1 V0 C0.376,0.473,0.594,0.495,1,0 V1"/></svg></clipPath></defs></svg>
            </div>
            <h2 class="section-title"><?= $LANGUAGE->for("article","newtitle") ?></h2>
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
                            <a href="article.php?id=<?= $article->primaryKeyValue ?>" class="btn btn-read"><?= $LANGUAGE->for("article","read") ?></a>
                        </div>
                    </div>
                </article>
            <?php }?>
            <div class="showmore">
                <a href="articles" class="btn btn-show"><?= $LANGUAGE->for("article","allarticles") ?></a>
            </div>
        </section>
    </main>
</body>
</html>