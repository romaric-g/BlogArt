<?php 
session_start();

require_once("./../../class/Utils/ctrlSaisies.php");
require_once("./../../class/Utils/connection.php");
require_once("./../../class/Blog/Article.php");

$success = isset($_SESSION["success"]) ? $_SESSION["success"] : NULL;
$error = isset($_SESSION["error"]) ? $_SESSION["error"] : NULL;

unset($_SESSION["success"]);
unset($_SESSION["error"]);

$articles = Article::loadAll($conn);

$HEADER = array("active" => "ARTICLE");
include "./../common/header.php";
?>
<div class="container">
    <h1>Liste des Articles</h1>
    <?php if($error || $success) { ?>
            <div class="alert alert-<?php echo ($error ? "danger" : "success")?>" role="alert">
                <?php echo $error ? $error :  $success; ?>
            </div>
    <?php } ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Titre</th>
                <th scope="col">Date</th>
                <th scope="col">Like</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($articles as $article){ ?>
                <tr>
                    <td><?= $article->values["LibTitrA"] ?></td>
                    <td><?= $article->values["DtCreA"] ?></td>
                    <td><?= $article->values["Likes"] ?></td>
                    <td>
                    <a href="show.php?id=<?= $article->primaryKeyValue ?>" class="btn btn-success">Afficher</a>
                    <a href="update.php?id=<?= $article->primaryKeyValue ?>" class="btn btn-info">Update</a>
                        <a href="delete.php?id=<?= $article->primaryKeyValue ?>" class="btn btn-danger">Supprimer</a>
                    </td>
                </tr>
            <?php } ?> 
        </tbody>
    </table>
    <a href="add.php" class="btn btn-primary">Ajouter</a>   
</div>
<?php include "./../common/footer.php"; ?>