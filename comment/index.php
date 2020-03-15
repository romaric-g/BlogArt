<?php 
session_start();

require_once("./../class/Utils/ctrlSaisies.php");
require_once("./../class/Utils/connection.php");
require_once("./../class/Blog/Comment.php");

$success = isset($_SESSION["success"]) ? $_SESSION["success"] : NULL;
$error = isset($_SESSION["error"]) ? $_SESSION["error"] : NULL;

unset($_SESSION["success"]);
unset($_SESSION["error"]);

$comments = Comment::loadAll($conn, array(new Join("ARTICLE","NumArt","NumArt")));
$artSeparator = 0;

$HEADER = array("active" => "COMMENT");
include "./../common/header.php";
?>
<div class="container">
    <h1>Liste des commentaires</h1>
    <?php if($error || $success) { ?>
            <div class="alert alert-<?php echo ($error ? "danger" : "success")?>" role="alert">
                <?php echo $error ? $error :  $success; ?>
            </div>
    <?php } ?>
    <div class="row">
        <?php foreach($comments as $comment){ ?>
            <?php
                $NumArt = $comment->tuple["NumArt"];
                if($NumArt != $artSeparator) {
                    $artSeparator = $NumArt;
            ?>
                <div class="col-12">
                    <h2 style="padding: 20px 0"><?= $comment->tuple["LibTitrA"] ?></h2>
                </div>
            <?php
                }
            ?>
            <div class="card col-md-4">
                <div class="card-body">
                    <h5 class="card-title"><?= $comment->values["TitrCom"] ?> <span class="badge badge-secondary"><?= $comment->values["DtCreC"] ?></span></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?= $comment->values["PseudoAuteur"] ?> - <?= $comment->values["EmailAuteur"] ?></h6>
                    <p class="card-text"><?= $comment->values["LibCom"] ?></p>
                    <a href="update.php?id=<?= $comment->primaryKeyValue ?>" class="btn btn-info">Update</a>
                    <a href="delete.php?id=<?= $comment->primaryKeyValue ?>" class="btn btn-danger">Supprimer</a>
                </div>
            </div>               
        <?php } ?> 
    </div>
    <a href="add.php" class="btn btn-primary">Ajouter</a>   
</div>
<?php include "./../common/footer.php"; ?>