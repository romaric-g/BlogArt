<?php 
require("../access.php");
require("../common/layout.php");

require_once("./../../class/Utils/ctrlSaisies.php");
require_once("./../../class/Utils/connection.php");
require_once("./../../class/Blog/Angle.php");

$angle = NULL;

if($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["id"])) {
        $NumAngl = ctrlSaisies($_GET["id"]);
        $angle = new Angle($NumAngl);
        $angle->loadDataFromSQL($conn);
    }
}else if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["id"]) && Angle::paramsAllSet($_POST)) {
        $NumAngl = ctrlSaisies($_POST["NumAngl"]);
        $angle = new Angle($NumAngl);
        $angle->changeData($_POST);
        $angle->updateDataToSQL($conn);
    }
}

if($angle == NULL){
    header("Location: index.php");
}

$requete = "SELECT * FROM `langue` WHERE 1";
$langues = $conn->query($requete);

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
        <h1>Modifier un angle</h1>
        <?php if($angle && ($angle->error || $angle->success)) { ?>
            <div class="alert alert-<?php echo ($angle->error ? "danger" : "success")?>" role="alert">
                <?php echo $angle->error ? $angle->error :  $angle->success; ?>
            </div>
        <?php } ?>
        <form method="post" action="update.php">
            <input type="hidden" id="NumAngl" name="NumAngl" value="<?= $angle->primaryKeyValue ?>">
            <div class="form-group">
                <label for="LibAngl">Nom de l'angle</label>
                <input type="text" class="form-control" id="LibAngl" name="LibAngl" placeholder="Nom de l'angle" autofocus="autofocus" value="<?= $angle->values["LibAngl"] ?>" >
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="NumLang">Langue</label>
                </div>
                <select class="custom-select" name="NumLang" id="NumLang">
                    <?php while($langue = $langues->fetch()){ ?>
                        <option value="<?=$langue["NumLang"]?>"  <?= ($langue["NumLang"] == $angle->values["NumLang"] ? 'selected' : '')?>><?= $langue['Lib1Lang'] ?></option>
                    <?php }?>
                </select>
            </div>
            <button name="id" type="submit" name="Submit" class="btn btn-success">Valider</button>
            <a href="index.php" class="btn btn-primary">Retour</a>
        </form>
    </div>
<?php __LAYOUT(); ?>