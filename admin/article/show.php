<?php 

require("../access.php");
require("../common/layout.php");

require_once("./../../class/Utils/ctrlSaisies.php");
require_once("./../../class/Utils/connection.php");
require_once("./../../class/Utils/articleImage.php");
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

$article->valuesDecode();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La pression bordelaise</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../styles/css/admin/commons.css">
    <link rel="stylesheet" href="../../styles/css/admin/layout.css">
    <link rel="stylesheet" href="../../styles/css/admin/article/article.css">
    <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
</head>
<?php LAYOUT__(); ?>
    <div class="container">
            <h1><?= $article->values["LibTitrA"]; ?></h1>
            <img src="<?= getArticleImageUrl("./../../",$article->values["UrlPhotA"]); ?>" class="img-fluid mx-auto d-block" alt="Responsive image" style="max-height: 400px;">
            <p><?= $article->values["LibChapoA"]; ?></p>
            <p><?= $article->values["LibAccrochA"]; ?></p>
            <p><?= $article->values["Parag1A"]; ?></p>
            <h2><?= $article->values["LibSsTitr1"]; ?></h2>
            <p><?= $article->values["Parag2A"]; ?></p>
            <h2><?= $article->values["LibSsTitr2"]; ?></h2>
            <p><?= $article->values["Parag3A"]; ?></p>
            <p><?= $article->values["LibConclA"]; ?></p>
            <div class="like-button" id="like-btn">
                <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.8518 7.37981L13.6016 8.58333H14.8308H21.6667C22.306 8.58333 22.8333 9.11062 22.8333 9.75V11.9167C22.8333 12.0599 22.8076 12.1929 22.7554 12.3302L19.4908 19.9512L19.4907 19.9512L19.4869 19.9604C19.3138 20.3758 18.9035 20.6667 18.4167 20.6667H8.66667C8.02728 20.6667 7.5 20.1394 7.5 19.5V8.66667C7.5 8.34303 7.62757 8.05919 7.83652 7.85589L7.8417 7.85085L7.84681 7.84574L14.2714 1.4114L14.7087 1.84461C14.7091 1.84502 14.7096 1.84544 14.71 1.84585C14.8144 1.95093 14.8823 2.09639 14.8914 2.25032L14.8696 2.4836L13.8518 7.37981ZM3.33333 9.66667V20.6667H1V9.66667H3.33333Z" stroke="#FFEED3" stroke-width="2"/></svg>
                <span class="count" id="like-value"><?= $article->values["Likes"]; ?></span>
            </div> 
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