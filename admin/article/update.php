<?php 

require("../access.php");
require("../common/layout.php");

require_once("./../../class/Utils/ctrlSaisies.php");
require_once("./../../class/Utils/connection.php");
require_once("./../../class/Blog/Article.php");

require_once("./../../class/Forms/Input.php");
require_once("./../../class/Forms/TextArea.php");
require_once("./../../class/Forms/SelectInput.php");
require_once("./../../class/Forms/Alert.php");
require_once("./../../class/Forms/KeywordsInput.php");
require_once("./../../class/Forms/UploadImage.php");

$langue = NULL;
$feedbacks = NULL;

if($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["id"])) {
        $NumArt = ctrlSaisies($_GET["id"]);
        $langue = new Article($NumArt);
        $langue->loadDataFromSQL($conn);
        $langue->loadKeywords($conn);
    }
}else if($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_POST["NumArt"]) {
        $NumArt = $_POST["NumArt"];
        $langue = new Article($NumArt);
        $langue->loadDataFromSQL($conn);
        $imageError = NULL;
        if ((isset($_FILES['UrlPhotA']) AND $_FILES['UrlPhotA']['error'] == 0)) {
            // Test si fichier pas trop gros
            if ($_FILES['UrlPhotA']['size'] <= 4000000) {
                // Test si extension autorisée
                $infosfile = pathinfo($_FILES['UrlPhotA']['name']);
                $extension_upload = $infosfile['extension'];
                $extensions_OK = array('jpg', 'jpeg', 'gif', 'png');
                $name = $infosfile['filename'];
                $file = '' .time() . '.' .$extension_upload;
                $path = '../../uploads/articles/';
                if ( ! is_dir($path)) {
                    mkdir($path);
                }
                if (in_array($extension_upload, $extensions_OK)) {
                    move_uploaded_file($_FILES['UrlPhotA']['tmp_name'], $path . $file);
                    $_POST["UrlPhotA"] = $file;
                }else $imageError = "Seuls les fichiers jpg, jpeg, gif, png sont acceptés";
            }else $imageError = "(Poids limité à 8Mo) !";
        }else $imageError = "Veuillez selectionner un fichier...";
        if($imageError && isset($_POST["UrlPhotA"])) {
            $imageError = NULL;
        }
        if(isset($_POST["id"]) && Article::paramsAllSet($_POST, array("DtCreA","Likes","LibAccrochA"))) {
            $keywords = $_POST["Keywords"];
            unset($_POST["Keywords"]);
            $langue->changeData($_POST, FALSE);
            $langue->updateDataToSQL($conn);
            $langue->setKeywordsFromString($keywords);
            $langue->updateKeywords($conn);

        }
        $langue->loadKeywords($conn);
    }
}
if(!$langue) {
    header("Location: index.php");
}

$values = $langue->values;

$requete = "SELECT * FROM `langue` WHERE 1";
$langues = $conn->query($requete);

$requete = "SELECT * FROM `angle` WHERE 1";
$angles = $conn->query($requete);

$requete = "SELECT * FROM `thematique` WHERE 1";
$thematiques = $conn->query($requete);

$requete = "SELECT * FROM `motcle` WHERE 1";
$keywords = $conn->query($requete);

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
        <h1>Metre à jour l'article</h1>
        <?php if($langue && ($langue->error || $langue->success)) { ?>
            <div class="alert alert-<?php echo ($langue->error ? "danger" : "success")?>" role="alert">
                <?php echo $langue->error ? $langue->error : $langue->success; ?>
            </div>
        <?php } ?>
        <form enctype="multipart/form-data" method="post" action="update.php">
           <input type="hidden" id="NumArt" name="NumArt" value="<?php echo $langue->primaryKeyValue ?>">
           <?= (new Input("LibTitrA", "Titre de l'Article"))->first()->feedback($feedbacks, $values)->HTML(); ?>
            <?= (new TextArea("LibChapoA", "Chapeau de l'Article"))->row(3)->feedback($feedbacks, $values)->HTML(); ?>
            <?= (new Input("LibAccrochA", "Phrase d'accroche"))->feedback($feedbacks, $values)->HTML(); ?>
            <?= (new TextArea("Parag1A", "Paragraphe 1"))->row(3)->feedback($feedbacks, $values)->HTML(); ?>
            <?= (new TextArea("LibSsTitr1", "LibSsTitr1"))->row(3)->feedback($feedbacks, $values)->HTML(); ?>
            <?= (new TextArea("Parag2A", "Paragraphe 2"))->row(3)->feedback($feedbacks, $values)->HTML(); ?>
            <?= (new TextArea("LibSsTitr2", "LibSsTitr2"))->row(3)->feedback($feedbacks, $values)->HTML(); ?>
            <?= (new TextArea("Parag3A", "Paragraphe 3"))->row(3)->feedback($feedbacks, $values)->HTML(); ?>
            <?= (new TextArea("LibConclA", "Conclusion"))->row(3)->feedback($feedbacks, $values)->HTML(); ?>
                
            <?= (new UploadImage("UrlPhotA", "Lien de la photo"))->setRoot("../../")->feedback($feedbacks, $values)->HTML(); ?>


            <div class="input-group mb-3">
                <?= (new SelectInput("NumLang","Langue"))->set($langues, "NumLang","Lib1Lang")->select($values["NumLang"])->HTML() ?>
                <?= (new SelectInput("NumThem","Thématique"))->set($thematiques, "NumThem","LibThem")->select($values["NumThem"])->HTML() ?>
                <?= (new SelectInput("NumAngl","Angle"))->set($angles, "NumAngl","LibAngl")->select($values["NumAngl"])->HTML() ?>
            </div>

            <?php  (new KeywordsInput($keywords))->select($langue->keywords)->print("./../../") ?>

            <button name="id" type="submit" name="Submit" class="btn btn-success">Valider</button>
            <a href="index.php" class="btn btn-primary">Retour</a>
        </form>
    </div>
<?php __LAYOUT(); ?>