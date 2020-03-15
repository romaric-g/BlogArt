<?php 
include "./../verifText.php";
include "./../connection.php";

require_once("./../class/Blog/Langue.php");

$article = NULL;

if($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["id"])) {
        $NumLang = ctrlSaisies($_GET["id"]);
        $article = new Article($NumLang);
        $article->loadDataFromSQL($conn);
    }
}else if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["id"])) {
        $NumArt = $_POST["NumArt"];
        $article = new Article($NumArt);
        $article->DtCreA = ctrlSaisies($_POST["DtCreA"]);
        $article->LibTitrA = ctrlSaisies($_POST["LibTitrA"]);
        $article->LibChapoA = ctrlSaisies($_POST["LibChapoA"]);
        $article->LibAccrochA = ctrlSaisies($_POST["LibAccrochA"]);
        $article->Parag1A = ctrlSaisies($_POST["Parag1A"]);
        $article->LibSsTitr1 = ctrlSaisies($_POST["LibSsTitr1"]);
        $article->Parag2A = ctrlSaisies($_POST["Parag2A"]);
        $article->LibSsTitr2 = ctrlSaisies($_POST["LibSsTitr2"]);
        $article->Parag3A = ctrlSaisies($_POST["Parag3A"]);
        $article->LibConclA = ctrlSaisies($_POST["LibConclA"]);
        $article->UrlPhotA = ctrlSaisies($_POST["UrlPhotA"]);
        $article->Likes = ctrlSaisies($_POST["Likes"]);
        $article->NumAngl = ctrlSaisies($_POST["NumAngl"]);
        $article->NumThem = ctrlSaisies($_POST["NumThem"]);
        $article->NumLang = ctrlSaisies($_POST["NumLang"]);
        $article->updateDataToSQL($conn);
    }
}

$requete = "SELECT * FROM `pays` WHERE 1";
$countries = $conn->query($requete);

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
        <h1>Modifier une langue</h1>
        <?php if($langue && ($langue->error || $langue->success)) { ?>
            <div class="alert alert-<?php echo ($langue->error ? "danger" : "success")?>" role="alert">
                <?php echo $langue->error ? $langue->error :  $langue->success; ?>
            </div>
        <?php } ?>
        <form method="post" action="update.php">
            <input type="hidden" id="NumLang" name="NumLang" value="<?php echo $langue->NumLang?>">
            <div class="form-group">
                <label for="Lib1Lang">Libellé court</label>
                <input type="text" class="form-control" id="Lib1Langs" name="Lib1Langs" maxlength="25" placeholder="Libellé court" autofocus="autofocus" value="<?php echo $langue->Lib1Lang ?>">
            </div>
            <div class="form-group">
                <label for="Lib2Lang">Libellé long</label>
                <input type="text" class="form-control" id="Lib2Langs" name="Lib2Langs" maxlength="25" placeholder="Libellé long" value="<?php echo $langue->Lib2Lang ?>">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="TypPays">Pays</label>
                </div>
                <select class="custom-select" name="TypPays" id="TypPays">
                    <?php 
                    while($country = $countries->fetch()){ 
                        echo '<option value="' . $country["numPays"] . '"' . 
                        ' ' . ($country["numPays"] == "$langue->NumPays" ? 'selected' : '') . 
                        ' >' . $country['frPays']. '</option>';
                    }
                    ?>
                </select>
            </div>
                <button name="id" type="submit" name="Submit" class="btn btn-success">Modifier</button>
                <a href="index.php" class="btn btn-primary">Retour</a>
        </form>
    </div>
</body>
</html>