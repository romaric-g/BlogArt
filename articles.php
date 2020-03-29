<?php
session_start();

require_once("./class/Auth/User.php");
require_once("./class/Utils/connection.php");
require_once("./class/Utils/ctrlSaisies.php");
require_once("./class/Utils/articleImage.php");
require_once("./class/Blog/Article.php");

require_once("./common/header.php");
require_once("./common/articlecard.php");

/* LANGUAGE SYSTEM */
require_once("./lang/language.php");

$LANG = $_SESSION["LANG"];
$LANGUAGE = Language::INIT($LANG, "./");

$where = "";
$themeName = "";

if(isset($_GET["id"])) {
    $themeID = $_GET["id"];
    $where = "NumThem = '$themeID'";
    $res = $conn->query("SELECT LibThem FROM THEMATIQUE WHERE NumThem = '$themeID'");
    $themeName = ($res->fetch())["LibThem"];
}
$user = User::getLoggedUser($conn);
$articles = Article::loadAll($conn, array(), $where, "ORDER BY DtCreA DESC");

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La pression bordelaise</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/css/common.css">

    <link rel="stylesheet" href="styles/css/menu/header.css">
    <link rel="stylesheet" href="styles/css/menu/m-header.css">
    <link rel="stylesheet" href="styles/css/menu/nav.css">
    <link rel="stylesheet" href="styles/css/menu/nav_dark.css">

    <link rel="stylesheet" href="styles/css/articles/articles.css">
    <link rel="stylesheet" href="styles/css/articles/articlecard.css">

    <link rel="stylesheet" href="styles/css/footer.css">
    <script src="https://code.createjs.com/1.0.0/createjs.min.js"></script>
    <script src="https://code.createjs.com/1.0.0/tweenjs.min.js"></script>
</head>
<body>
    <?php PAGEHEADER($LANG, $user, $LANGUAGE, "./", $conn) ?>
    <main>
        <section class="articles container">
            <h2 class="section-title">Nos Articles<span><?= $themeName; ?></span></h2>
            <?php foreach( $articles as $article ) {
                $article->loadKeywords($conn);
                printArticleCard($article, $LANGUAGE, $article->keywords, getArticleImageUrl("./", $article->values["UrlPhotA"]));
            }?>
        </section>
    </main>
    <?php include "common/footer.php"; ?>
</body>
</html>