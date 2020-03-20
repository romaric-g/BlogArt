<?php 
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

$HEADER = array("active" => "ARTICLE");
include "./../common/header.php";
?>
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
<?php include "./../common/footer.php"; ?>