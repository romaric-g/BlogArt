<?php 
session_start();

include "verifText.php";
include "connection.php";
include "blog/get_langue.php";
include "blog/insert_langue.php";

include "./class/Blog/Langue.php";

$success = isset($_SESSION["success"]) ? $_SESSION["success"] : NULL;
$error = isset($_SESSION["error"]) ? $_SESSION["error"] : NULL;

unset($_SESSION["success"]);
unset($_SESSION["error"]);

$langues = Langue::loadAll($conn);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
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
                    <td><?= $langue->Lib1Lang ?></td>
                    <td><?= $langue->Lib2Lang ?></td>
                    <td><?= $langue->tuple["frPays"] ?></td>
                    <td>
                        <a href="delete.php?id=<?= $langue->NumLang ?>" class="btn btn-danger">Supprimer</a>
                        <a href="update.php?id=<?= $langue->NumLang ?>" class="btn btn-info">Update</a>
                    </td>
                </tr>
            <?php } ?> 
        </tbody>
    </table>
    <a href="add.php" class="btn btn-primary">Ajouter</a>   
</div>
</body>
</html>