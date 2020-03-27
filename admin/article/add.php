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

$langue = NULL;
$feedbacks = NULL;
$feedbackMessage = array();

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['id']) AND $_POST['id'] == 0) {
        $_POST['DtCreA'] = date("Y-m-d");
        $_POST['Likes'] = 0;
        $noset = Article::getParamsNoSet($_POST);
        if( empty($noset) ) {
            $keywords = $_POST["Keywords"];
            unset($_POST["Keywords"]);
            $langue = Article::new($_POST, $conn);
            $langue->setKeywordsFromString($keywords);
            $langue->updateKeywords($conn);
            $feedbackMessage["error"] = $langue->error;
            $feedbackMessage["success"] = $langue->success;

            if($feedbackMessage["success"]) {
                $_SESSION["success"] = $feedbackMessage["success"];
                header("Location: index.php");
            }
        }else{
            $feedbacks = Article::getFeedbackMessages($noset);
            $feedbackMessage["error"] = "Impossible de créer l'Article";
        }
    }
}


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
        <h1>Créer un nouvelle article</h1>
        <?= (new Alert($feedbackMessage))->HTML() ?>
        <form method="post" action="add.php">
            <?= (new Input("LibTitrA", "Titre de l'Article"))->first()->feedback($feedbacks, $_POST)->HTML(); ?>
            <?= (new TextArea("LibChapoA", "Chapeau de l'Article"))->row(3)->feedback($feedbacks, $_POST)->HTML(); ?>
            <?= (new Input("LibAccrochA", "Phrase d'accroche"))->feedback($feedbacks, $_POST)->HTML(); ?>
            <?= (new TextArea("Parag1A", "Paragraphe 1"))->row(3)->feedback($feedbacks, $_POST)->HTML(); ?>
            <?= (new TextArea("LibSsTitr1", "LibSsTitr1"))->row(3)->feedback($feedbacks, $_POST)->HTML(); ?>
            <?= (new TextArea("Parag2A", "Paragraphe 2"))->row(3)->feedback($feedbacks, $_POST)->HTML(); ?>
            <?= (new TextArea("LibSsTitr2", "LibSsTitr2"))->row(3)->feedback($feedbacks, $_POST)->HTML(); ?>
            <?= (new TextArea("Parag3A", "Paragraphe 3"))->row(3)->feedback($feedbacks, $_POST)->HTML(); ?>
            <?= (new TextArea("LibConclA", "Conclusion"))->row(3)->feedback($feedbacks, $_POST)->HTML(); ?>
            <?= (new TextArea("UrlPhotA", "Lien de la photo"))->feedback($feedbacks, $_POST)->HTML(); ?>


            <div class="form-group mb-9">
                <div class="input-group mb-3">
                        <?= (new SelectInput("NumLang","Langue"))->set($langues, "NumLang","Lib1Lang")->select('FRAN01')->HTML() ?>
                        <?= (new SelectInput("NumThem","Thématique"))->set($thematiques, "NumThem","LibThem")->HTML() ?>
                        <?= (new SelectInput("NumAngl","Angle"))->set($angles, "NumAngl","LibAngl")->HTML() ?>
                </div>
            </div>
            
            <?php  (new KeywordsInput($keywords))->print("./../../") ?>

            <div class="form-group mb-9">
                <button name="id" type="submit" name="Submit" class="btn btn-success">Valider</button>
                <a href="index.php" class="btn btn-primary">Retour</a>
            </div>
        </form>
    </div>
<?php __LAYOUT(); ?>