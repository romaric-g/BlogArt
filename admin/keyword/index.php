<?php 
require("../access.php");
require("../common/layout.php");

require_once("./../../class/Utils/ctrlSaisies.php");
require_once("./../../class/Utils/connection.php");
require_once("./../../class/Blog/KeyWord.php");

$lang = NULL;
$WHERE = "";

if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["lang"])) {
    $lang = ctrlSaisies($_GET["lang"]);
    $WHERE = "LANGUE.NumLang = '$lang'";
}

$elmts = KeyWord::loadAll($conn, array(new Join("LANGUE", "NumLang", "NumLang")), $WHERE);

$success = isset($_SESSION["success"]) ? $_SESSION["success"] : NULL;
$error = isset($_SESSION["error"]) ? $_SESSION["error"] : NULL;

unset($_SESSION["success"]);
unset($_SESSION["error"]);  

$requete = "SELECT * FROM `langue` WHERE 1";
$langues = $conn->query($requete);
$langAll = array("Lib1Lang"=>"Toutes", "NumLang"=>"");

$langChoices = array();
$langueSlct = NULL;

if($lang != NULL && $lang != ""){
    foreach($langues as $langue) {
        if($langue["NumLang"] != $lang) {
            array_push($langChoices, $langue);
        }else{
            $langueSlct = $langue;
        }
    }
    array_unshift($langChoices, $langAll);
}else{
    $langChoices = $langues;
    $langueSlct = $langAll;
}

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
    <h1>Liste des mots clés</h1>
    <div class="dropdown">
        Filtre: 
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?= $langueSlct["Lib1Lang"] ?>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <?php foreach($langChoices as $choice) {?>
                <a class="dropdown-item" href="index.php<?= $choice["NumLang"] != "" ? "?lang=" . $choice["NumLang"] : "" ?>"><?= $choice["Lib1Lang"] ?></a>
            <?php } ?>
        </div>
    </div>
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
<?php __LAYOUT(); ?>