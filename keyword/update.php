<?php 
require_once("./../class/Utils/ctrlSaisies.php");
require_once("./../class/Utils/connection.php");
require_once("./../class/Blog/KeyWord.php");

$keyword = NULL;

if($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["id"])) {
        $NumMoCle = ctrlSaisies($_GET["id"]);
        $keyword = new KeyWord($NumMoCle);
        $keyword->loadDataFromSQL($conn);
    }
}else if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["id"]) && KeyWord::paramsAllSet($_POST)) {
        $NumMoCle = $_POST["NumMoCle"];
        $keyword = new KeyWord($NumMoCle);
        $keyword->changeData($_POST);
        $keyword->updateDataToSQL($conn);
    }
}

if($keyword == NULL){
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
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Modifier un mot clé</h1>
        <?php if($keyword && ($keyword->error || $keyword->success)) { ?>
            <div class="alert alert-<?php echo ($keyword->error ? "danger" : "success")?>" role="alert">
                <?php echo $keyword->error ? $keyword->error :  $keyword->success; ?>
            </div>
        <?php } ?>
        <form method="post" action="update.php">
            <input type="hidden" id="NumMoCle" name="NumMoCle" value="<?php echo $keyword->primaryKeyValue ?>">
            <div class="form-group">
                <label for="LibMoCle">Mot clé</label>
                <input type="text" class="form-control" id="LibMoCle" name="LibMoCle" maxlength="25" placeholder="Mot clé" autofocus="autofocus" value="<?= $keyword->values["LibMoCle"] ?>" >
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="NumLang">Langue</label>
                </div>
                <select class="custom-select" name="NumLang" id="NumLang">
                    <?php while($langue = $langues->fetch()){ ?>
                        <option value="<?=$langue["NumLang"]?>"  <?= ($langue["NumLang"] == $keyword->values["NumLang"] ? 'selected' : '')?>><?= $langue['Lib1Lang'] ?></option>
                    <?php }?>
                </select>
            </div>
            <button name="id" type="submit" name="Submit" class="btn btn-success">Valider</button>
            <a href="index.php" class="btn btn-primary">Retour</a>
        </form>
    </div>
</body>
</html>