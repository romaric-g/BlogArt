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

if(isset($_REQUEST["id"])) {
    $NumArt = ctrlSaisies($_REQUEST["id"]);
    $article = new Article($NumArt);
    $joins = array(
        new Join("THEMATIQUE", "NumThem", "NumThem"),
        new Join("ANGLE", "NumAngl", "NumAngl"),
        new Join("LANGUE", "NumLang", "NumLang")
    );
    $article->loadDataFromSQL($conn, $joins);
    $article->loadKeywords($conn);

    $comments = Comment::loadRealComment($conn, array(), "NumArt = '$NumArt'");
}else{
    header("Location: index.php");
}
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["LibCom"]) && $user) {
        $comment = Comment::newRealComment($_POST, $user, $NumArt, $conn);
        header("Location: article?id=" . $NumArt);
    }
}

$likeActiveClass = $user ? (Comment::hasFakeComToLike($user->getPseudo(), $NumArt, $conn) ? " active" : "") : " nologged";
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
    <link rel="stylesheet" href="styles/css/m-header.css">
    <link rel="stylesheet" href="styles/css/nav.css">
    <link rel="stylesheet" href="styles/css/nav_dark.css">
    <link rel="stylesheet" href="styles/css/article.css">
    <link rel="stylesheet" href="styles/css/article/comments.css">
    <script src="https://code.createjs.com/1.0.0/createjs.min.js"></script>
    <script src="https://code.createjs.com/1.0.0/tweenjs.min.js"></script>
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
                    
                    <div class="like-button<?= $likeActiveClass ?>" id="like-btn">
                            <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.8518 7.37981L13.6016 8.58333H14.8308H21.6667C22.306 8.58333 22.8333 9.11062 22.8333 9.75V11.9167C22.8333 12.0599 22.8076 12.1929 22.7554 12.3302L19.4908 19.9512L19.4907 19.9512L19.4869 19.9604C19.3138 20.3758 18.9035 20.6667 18.4167 20.6667H8.66667C8.02728 20.6667 7.5 20.1394 7.5 19.5V8.66667C7.5 8.34303 7.62757 8.05919 7.83652 7.85589L7.8417 7.85085L7.84681 7.84574L14.2714 1.4114L14.7087 1.84461C14.7091 1.84502 14.7096 1.84544 14.71 1.84585C14.8144 1.95093 14.8823 2.09639 14.8914 2.25032L14.8696 2.4836L13.8518 7.37981ZM3.33333 9.66667V20.6667H1V9.66667H3.33333Z" stroke="#FFEED3" stroke-width="2"/></svg>
                            <span class="count" id="like-value"><?= $article->values["Likes"]; ?></span>
                            <?php if($user) { ?>
                                <script>
                                    document.getElementById("like-btn").addEventListener("click", function (event) {
                                        var xmlhttp = new XMLHttpRequest();
                                        xmlhttp.onreadystatechange = function() {
                                            if (this.readyState == 4 && this.status == 200) {
                                                let res =  this.responseText.split(':');
                                                if(res.length > 1) {
                                                    document.getElementById("like-value").innerHTML = res[0];
                                                    newClass = res[1];
                                                    classList =  document.getElementById("like-btn").classList;
                                                    if(newClass == 1) {
                                                        classList.add("active");
                                                    }else {
                                                        classList.remove("active");
                                                    }
                                                }
                                            }
                                        };
                                        xmlhttp.open("GET", "like.php?id=" + <?= $NumArt ?>, true);
                                        xmlhttp.send();
                                        
                                    })
                                </script>
                            <?php } ?>
                    </div>
            </section>
            <section class="section-comments" id="comments">
                <h2 class="title"><?= $LANGUAGE->for("article","comments","title") ?></h2>
                <div class="row justify-content-center">
                    <?php if($user) { ?>
                        <div class="comment-form col-md-10">
                                <form method="POST" action="article.php#comments">
                                    <input type="hidden" name="id" value="<?= $NumArt ?>">
                                    <div class="form-group">
                                        <label for="LibCom">Votre message</label>
                                        <textarea type="text" class="form-control" name="LibCom" placeholder="Votre message" rows="5"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Envoyer</button>
                                </form>
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-danger col-md-10">
                            Vous devez être connecté pour envoyer des commentaires, <a href="login.php">connectez-vous</a>!
                        </div>
                    <?php } ?>
                </div>
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