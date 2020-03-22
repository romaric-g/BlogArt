<?php
session_start();

require_once("class/Auth/User.php");
require_once("class/Utils/ctrlSaisies.php");
require_once("class/Utils/connection.php");
require_once("class/Blog/Article.php");
require_once("class/Blog/KeyWord.php");
require_once("class/Blog/Comment.php");

require_once("./common/header.php");

/* LANGUAGE SYSTEM */
require_once("./lang/language.php");


$LANG = $_SESSION["LANG"];
$LANGUAGE = Language::INIT($LANG, "./");

$user = User::getLoggedUser($conn);
$comment = NULL;
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

        $comments = Comment::loadAll($conn, array(), "NumArt = '$NumArt'");
    }else{
        header("Location: index.php");
    }
}else{
    header("Location: index.php");
}

$default = "https://www.cierpgaud.fr/wp-content/uploads/2018/07/avatar.jpg";
$size = 40;   

?>
<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/css/common.css">
    <link rel="stylesheet" href="styles/css/header.css">
    <link rel="stylesheet" href="styles/css/nav.css">
    <link rel="stylesheet" href="styles/css/nav_dark.css">
    <link rel="stylesheet" href="styles/css/article.css">
    <link rel="stylesheet" href="styles/css/article/comments.css">
    <title>Document</title>
</head>
<body>
    <?php PAGEHEADER($LANG, $user, $LANGUAGE, "./", $conn) ?>
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
                    <div class="like-button">
                        <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.8518 7.37981L13.6016 8.58333H14.8308H21.6667C22.306 8.58333 22.8333 9.11062 22.8333 9.75V11.9167C22.8333 12.0599 22.8076 12.1929 22.7554 12.3302L19.4908 19.9512L19.4907 19.9512L19.4869 19.9604C19.3138 20.3758 18.9035 20.6667 18.4167 20.6667H8.66667C8.02728 20.6667 7.5 20.1394 7.5 19.5V8.66667C7.5 8.34303 7.62757 8.05919 7.83652 7.85589L7.8417 7.85085L7.84681 7.84574L14.2714 1.4114L14.7087 1.84461C14.7091 1.84502 14.7096 1.84544 14.71 1.84585C14.8144 1.95093 14.8823 2.09639 14.8914 2.25032L14.8696 2.4836L13.8518 7.37981ZM3.33333 9.66667V20.6667H1V9.66667H3.33333Z" stroke="#FFEED3" stroke-width="2"/></svg>
                        <span class="count"><?= $article->values["Likes"]; ?></span>
                    </div>
            </section>
            <section class="section-comments">
                <h2 class="title">Laisser un commentaire</h2>
                <div class="comments row justify-content-center">
                    <?php foreach($comments as $comment) { 
                        $email = $comment->values["EmailAuteur"];
                        $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
 
                    ?>
                        <div class="comment col-md-10">
                            <div class="photo">
                                <img src="<?= $grav_url ?>" alt="">
                            </div>
                            <div class="comment-texts">
                                <div class="comment-title-section">
                                    <h3 class="comment-title"><?= $comment->values["PseudoAuteur"] ?></h3>
                                    <span><?= $comment->values["DtCreC"] ?></span>
                                </div>
                                <p class="comment-lib"><?= $comment->values["LibCom"] ?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </section>
        </div>
    </main>
</body>
</html>