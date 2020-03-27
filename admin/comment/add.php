<?php 
require("../access.php");
require("../common/layout.php");

require_once("./../../class/Utils/ctrlSaisies.php");
require_once("./../../class/Utils/connection.php");
require_once("./../../class/Blog/Comment.php");

$comment = NULL;

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['id']) AND $_POST['id'] == 0) {
        $_POST['DtCreC'] = date("Y-m-d H:i:s");
        if( Comment::paramsAllSet($_POST) ) {
            $comment = Comment::new($_POST, $conn);
        }
    }
}

$requete = "SELECT * FROM `article` WHERE 1";
$articles = $conn->query($requete);

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
    <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
</head>
<?php LAYOUT__(); ?>
    <div class="container">
        <h1>Ajouter un commentaire</h1>
        <?php if($comment && ($comment->error || $comment->success)) { ?>
            <div class="alert alert-<?php echo ($comment->error ? "danger" : "success")?>" role="alert">
                <?php echo $comment->error ? $comment->error : $comment->success; ?>
            </div>
        <?php } ?>
        <form method="post" action="add.php">
           <div class="form-group">
                <label for="PseudoAuteur">Pseudo</label>
                <input type="text" class="form-control" id="PseudoAuteur" name="PseudoAuteur" maxlength="25" placeholder="Pseudo" autofocus="autofocus" >
            </div>
            <div class="form-group">
                <label for="EmailAuteur">Email</label>
                <input type="email" class="form-control" id="EmailAuteur" name="EmailAuteur" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="TitrCom">Phrase d'accroche</label>
                <input type="text" class="form-control" id="TitrCom" name="TitrCom" placeholder="Titre">
            </div>  
            <div class="form-group">
                <label for="LibCom">Commentaire</label>
                <textarea class="form-control" id="LibCom" name="LibCom" rows="3" placeholder="Votre commentaire"></textarea>
            </div>
            <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="NumArt">Article</label>
                    </div>
                    <select class="custom-select" name="NumArt" id="NumArt">
                        <?php while($article = $articles->fetch()){ ?>
                            <option value="<?=$article["NumArt"]?>"><?= $article['LibTitrA'] ?></option>
                        <?php }?>
                    </select>
            </div>
            <button name="id" type="submit" name="Submit" class="btn btn-success">Valider</button>
            <a href="index.php" class="btn btn-primary">Retour</a>
        </form>
    </div>
<?php __LAYOUT(); ?>