<?php 
require("../access.php");
require("../common/layout.php");

require_once("./../../class/Utils/ctrlSaisies.php");
require_once("./../../class/Utils/connection.php");
require_once("./../../class/Blog/Theme.php");

$theme = NULL;

if($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["id"])) {
        $NumThem = ctrlSaisies($_GET["id"]);
        $theme = new Theme($NumThem);
        $theme->loadDataFromSQL($conn);
    }
}else if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["id"]) && Theme::paramsAllSet($_POST)) {
        $NumThem = ctrlSaisies($_POST["NumThem"]);
        $theme = new Theme($NumThem);
        $theme->changeData($_POST);
        $theme->updateDataToSQL($conn);
    }
}

if($theme == NULL){
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
        <h1>Modifier une thématique</h1>
        <?php if($theme && ($theme->error || $theme->success)) { ?>
            <div class="alert alert-<?php echo ($theme->error ? "danger" : "success")?>" role="alert">
                <?php echo $theme->error ? $theme->error :  $theme->success; ?>
            </div>
        <?php } ?>
        <form method="post" action="update.php">
            <input type="hidden" id="NumThem" name="NumThem" value="<?= $theme->primaryKeyValue ?>">
            <div class="form-group">
                <label for="LibThem">Nom de la thématique</label>
                <input type="text" class="form-control" id="LibThem" name="LibThem" placeholder="Nom de la thématique" autofocus="autofocus" value="<?= $theme->values["LibThem"] ?>" >
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="NumLang">Langue</label>
                </div>
                <select class="custom-select" name="NumLang" id="NumLang">
                    <?php while($langue = $langues->fetch()){ ?>
                        <option value="<?=$langue["NumLang"]?>"  <?= ($langue["NumLang"] == $theme->values["NumLang"] ? 'selected' : '')?>><?= $langue['Lib1Lang'] ?></option>
                    <?php }?>
                </select>
            </div>
            <button name="id" type="submit" name="Submit" class="btn btn-success">Valider</button>
            <a href="index.php" class="btn btn-primary">Retour</a>
        </form>
    </div>
<?php __LAYOUT(); ?>