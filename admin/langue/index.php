<?php 
require("../access.php");
require("../common/layout.php");

require_once("./../../class/Utils/connection.php");
require_once("./../../class/Blog/Langue.php");

$success = isset($_SESSION["success"]) ? $_SESSION["success"] : NULL;
$error = isset($_SESSION["error"]) ? $_SESSION["error"] : NULL;

unset($_SESSION["success"]);
unset($_SESSION["error"]);

$langues = Langue::loadAll($conn, array(new Join("PAYS", "NumPays", "numPays")));

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
    <h1>Liste des langues</h1>
    <?php if($error || $success) { ?>
            <div class="alert alert-<?php echo ($error ? "danger" : "success")?>" role="alert">
                <?php echo $error ? $error :  $success; ?>
            </div>
    <?php } ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Langue</th>
                <th scope="col">Nom complet</th>
                <th scope="col">Pays</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($langues as $langue){ ?>
                <tr>
                    <td><?= $langue->values["Lib1Lang"] ?></td>
                    <td><?= $langue->values["Lib2Lang"] ?></td>
                    <td><?= $langue->tuple["frPays"] ?></td>
                    <td>
                        <a href="delete.php?id=<?= $langue->primaryKeyValue ?>" class="btn btn-danger">Supprimer</a>
                        <a href="update.php?id=<?= $langue->primaryKeyValue ?>" class="btn btn-info">Update</a>
                    </td>
                </tr>
            <?php } ?> 
        </tbody>
    </table>
    <a href="add.php" class="btn btn-primary">Ajouter</a>   
</div>
<?php __LAYOUT(); ?>