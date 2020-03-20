<?php 
require_once("./../../class/Utils/ctrlSaisies.php");
require_once("./../../class/Utils/connection.php");
require_once("./../../class/Blog/Comment.php");

$langue = NULL;

if($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["id"])) {
        $NumCom = ctrlSaisies($_GET["id"]);
        $comment = new Comment($NumCom);
        $comment->loadDataFromSQL($conn);
    }
}else if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["id"]) && Comment::paramsAllSet($_POST, array("DtCreC"))) {
        $NumCom = $_POST["NumCom"];
        $comment = new Comment($NumCom);
        $comment->loadDataFromSQL($conn);
        $comment->changeData($_POST, FALSE);
        $comment->updateDataToSQL($conn);
    }
}
if($comment == NULL){
    header("Location: index.php");
}

$requete = "SELECT * FROM `article` WHERE 1";
$articles = $conn->query($requete);

$HEADER = array("active" => "COMMENT");
include "./../common/header.php";
?>
    <div class="container">
        <h1>Metre à jour l'article</h1>
        <?php if($comment && ($comment->error || $comment->success)) { ?>
            <div class="alert alert-<?php echo ($comment->error ? "danger" : "success")?>" role="alert">
                <?php echo $comment->error ? $comment->error : $comment->success; ?>
            </div>
        <?php } ?>
        <form method="post" action="update.php">
           <input type="hidden" id="NumCom" name="NumCom" value="<?php echo $comment->primaryKeyValue ?>">
           <div class="form-group">
                <label for="PseudoAuteur">Pseudo</label>
                <input type="text" class="form-control" id="PseudoAuteur" name="PseudoAuteur" maxlength="25" placeholder="Pseudo" autofocus="autofocus" value="<?= $comment->values["PseudoAuteur"]?>">
            </div> 
            <div class="form-group">
                <label for="EmailAuteur">Email</label>
                <input type="email" class="form-control" id="EmailAuteur" name="EmailAuteur" placeholder="Email" value="<?= $comment->values["EmailAuteur"]?>">
            </div>
            <div class="form-group">
                <label for="TitrCom">Phrase d'accroche</label>
                <input type="text" class="form-control" id="TitrCom" name="TitrCom" placeholder="Titre" value="<?= $comment->values["TitrCom"]?>">
            </div>  
            <div class="form-group">
                <label for="LibCom">Commentaire</label>
                <textarea class="form-control" id="LibCom" name="LibCom" rows="3" placeholder="Votre commentaire"><?= $comment->values["LibCom"]?></textarea>
            </div>
            <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="NumArt">Article</label>
                    </div>
                    <select class="custom-select" name="NumArt" id="NumArt">
                        <?php while($article = $articles->fetch()){ ?>
                            <option value="<?=$article["NumArt"]?>" <?= ($comment->values["NumArt"] == $article["NumArt"] ? 'selected' : '')?>><?= $article['LibTitrA'] ?></option>
                        <?php }?>
                    </select>
            </div>
            <button name="id" type="submit" name="Submit" class="btn btn-success">Valider</button>
            <a href="index.php" class="btn btn-primary">Retour</a>
        </form>
    </div>
<?php include "./../common/footer.php"; ?>