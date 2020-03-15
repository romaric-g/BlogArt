<?php 
session_start();

require_once("./../class/Utils/ctrlSaisies.php");
require_once("./../class/Utils/connection.php");
require_once("./../class/Blog/KeyWord.php");

$WHERE = "";

if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["lang"])) {
    $pays = ctrlSaisies($_GET["lang"]);
    $WHERE = "NumPays = '$pays'";
}

$elmts = KeyWord::loadAll($conn, array(new Join("LANGUE", "NumLang", "NumLang")), $WHERE);

$success = isset($_SESSION["success"]) ? $_SESSION["success"] : NULL;
$error = isset($_SESSION["error"]) ? $_SESSION["error"] : NULL;

unset($_SESSION["success"]);
unset($_SESSION["error"]);  

$HEADER = array("active" => "KEYWORD");
include "./../common/header.php";
?>
<div class="container">
    <h1>Liste des Mots clés</h1>
    <?php if($error || $success) { ?>
            <div class="alert alert-<?php echo ($error ? "danger" : "success")?>" role="alert">
                <?php echo $error ? $error :  $success; ?>
            </div>
    <?php } ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Mot Clé</th>
                <th scope="col">Langue</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($elmts as $elmt){ ?>
                <tr>
                    <td><?= $elmt->values["LibMoCle"] ?></td>
                    <td><?= $elmt->tuple["Lib1Lang"] ?></td>
                    <td>
                        <a href="delete.php?id=<?= $elmt->primaryKeyValue ?>" class="btn btn-danger">Supprimer</a>
                        <a href="update.php?id=<?= $elmt->primaryKeyValue ?>" class="btn btn-info">Update</a>
                    </td>
                </tr>
            <?php } ?> 
        </tbody>
    </table>
    <a href="add.php" class="btn btn-primary">Ajouter</a>   
</div>
<?php include "./../common/footer.php"; ?>