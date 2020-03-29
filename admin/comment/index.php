<?php 
require("../access.php");
require("../common/layout.php");

require_once("./../../class/Utils/ctrlSaisies.php");
require_once("./../../class/Utils/connection.php");
require_once("./../../class/Blog/Comment.php");

$success = isset($_SESSION["success"]) ? $_SESSION["success"] : NULL;
$error = isset($_SESSION["error"]) ? $_SESSION["error"] : NULL;

unset($_SESSION["success"]);
unset($_SESSION["error"]);

$comments = Comment::loadRealComment($conn, array(new Join("ARTICLE","NumArt","NumArt")),"","ORDER BY Comment.NumArt DESC");
$artSeparator = 0;

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
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<?php LAYOUT__(); ?>
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
            <div class="card col-md-4 bg-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?= $comment->values["PseudoAuteur"] ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?= $comment->values["EmailAuteur"] ?> <span class="badge badge-secondary"><?= $comment->values["DtCreC"] ?></span></h6>
                    <p class="card-text"><?= $comment->values["LibCom"] ?></p>
                    <a href="update.php?id=<?= $comment->primaryKeyValue ?>" class="btn btn-info">Update</a>
                    <a href="delete.php?id=<?= $comment->primaryKeyValue ?>" class="btn btn-danger">Supprimer</a>
                </div>
            </div>               
        <?php } ?> 
    </div>
    <a href="add.php" class="btn btn-primary">Ajouter</a>   
</div>
<?php __LAYOUT(); ?>