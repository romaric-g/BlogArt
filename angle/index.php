<?php 
session_start();

require_once("./../class/Utils/ctrlSaisies.php");
require_once("./../class/Utils/connection.php");
require_once("./../class/Blog/Angle.php");

$lang = NULL;
$WHERE = "";

if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["lang"])) {
    $lang = ctrlSaisies($_GET["lang"]);
    $WHERE = "LANGUE.NumLang = '$lang'";
}

$elmts = Angle::loadAll($conn, array(new Join("LANGUE", "NumLang", "NumLang")), $WHERE);

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

$HEADER = array("active" => "ANGLE");
include "./../common/header.php";
?>
<div class="container">
    <h1>Liste des angles</h1>
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
                <th scope="col">Angle</th>
                <th scope="col">Langue</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($elmts as $elmt){ ?>
                <tr>
                    <td><?= $elmt->values["LibAngl"] ?></td>
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