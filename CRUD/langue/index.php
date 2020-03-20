<?php 
session_start();

require_once("./../../class/Utils/connection.php");
require_once("./../../class/Blog/Langue.php");

$success = isset($_SESSION["success"]) ? $_SESSION["success"] : NULL;
$error = isset($_SESSION["error"]) ? $_SESSION["error"] : NULL;

unset($_SESSION["success"]);
unset($_SESSION["error"]);

$langues = Langue::loadAll($conn, array(new Join("PAYS", "NumPays", "numPays")));

$HEADER = array("active" => "LANGUE");
include "../common/header.php"; 
?>
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
<?php include "../common/footer.php"; ?>