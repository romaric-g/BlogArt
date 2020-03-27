<?php
session_start();

require_once("./class/Auth/User.php");
require_once("./class/Utils/connection.php");
require_once("./class/Utils/ctrlSaisies.php");
require_once("./class/Blog/Article.php");

/* COMPOSANTS */
require_once("./common/header.php");

/* LANGUAGE SYSTEM */
require_once("./lang/language.php");


define('TARGET', 'uploads/');    // Repertoire cible
define('MAX_SIZE', 100000000);    // Taille max en octets du fichier
define('WIDTH_MAX', 4000);    // Largeur max de l'image en pixels
define('HEIGHT_MAX', 4000);    // Hauteur max de l'image en pixels

$tabExt = array('jpg','png','jpeg');    // Extensions autorisees
$infosImg = array();
 
$extension = '';
$message = '';
$nomImage = '';

$LANG = $_SESSION["LANG"];
$LANGUAGE = Language::INIT($LANG, "./");

$USER = User::getLoggedUser($conn);
if(!$USER) {
    header("Location: index.php");
}

$registerError = array();

function printFeedback($name) {
    global $registerError;
    if(!empty($registerError)) {
        $set = isset($registerError[$name])
?>
        <div class="<?= $set ? "invalid" : "valid"; ?>-feedback"><?= $set ? $registerError[$name] : "saisie valide" ?></div>
<?php
    }
}
function getFeedbackClass($name) {
    global $registerError;
    if(!empty($registerError)) {
        return " is-" . (isset($registerError[$name]) ? "invalid" : "valid");
    }
}
function getSet($name) {
    global $USER;
    if($_SERVER["REQUEST_METHOD"] == "GET") {
        switch ($name) {
            case 'email':
                return $USER->email;
            case 'firstname':
                return $USER->firstname;
            case 'lastname':
                return $USER->lastname;
            case 'password':
            case 'passwordconfirm':
                return $USER->getPass();
        }
        return "";
    } else{
        return (ctrlSaisies(isset($_POST[$name]) ? $_POST[$name] : ""));
    }
}
$success = NULL;
$error = NULL;
if($_SERVER["REQUEST_METHOD"] == "POST") {
        $requiredParams = array("email","firstname","lastname","password","passwordconfirm");
        $maxLength = array(50,30,30,15,15);
        $i = 0;
        foreach($requiredParams as $param){
            if(!isset($_POST[$param]) || empty($_POST[$param])) {
                $registerError[$param] = "Ce champ est obligatoire";
            }else{
                if( strlen($_POST[$param]) > $maxLength[$i]){
                    $registerError[$param] = "Champ limité à ". $maxLength[$i] . " caractères";
                }
            }
            $i++;
        }
        if( !isset($registerError["email"]) ) { 

            if(!preg_match(" /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ ", $_POST["email"])) {
                $registerError["email"] = "Adresse email invalide";
            }else if(User::emailIsUsed($_POST["email"], $conn) && $_POST["email"] != $USER->email) {
                $registerError["email"] = "Adresse email déjà utilisée";
            }
        }
        if( !isset($requiredParams["password"]) && !isset($requiredParams["passwordconfirm"]) && $_POST["password"] != $_POST["passwordconfirm"] ) {
            $registerError["passwordconfirm"] = "Les mots de passe ne corresponde pas";
        }
        if( !empty($_FILES['file']['name']) ) {
            $extension  = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            if(in_array(strtolower($extension),$tabExt) && !empty($_FILES['file']['tmp_name'])){
                $infosImg = getimagesize($_FILES['file']['tmp_name']);
                if($infosImg[2] >= 1 && $infosImg[2] <= 14){
                    if(($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX) && (filesize($_FILES['file']['tmp_name']) <= MAX_SIZE)){
                        if(isset($_FILES['file']['error']) && UPLOAD_ERR_OK === $_FILES['file']['error']){
                            $nomImage = $USER->getPseudo() . "." . $extension;
                            if(move_uploaded_file($_FILES['file']['tmp_name'], TARGET.$nomImage)){
                                for ($i=0; $i < sizeof($tabExt); $i++) {
                                    $fileName = TARGET. $USER->getPseudo() . "." . $tabExt[$i];
                                    if(file_exists ($fileName) && $extension != $tabExt[$i] ){
                                        unlink($fileName);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        if(empty($registerError)) {
            try {
                $USER->email = $_POST["email"];
                $USER->firstname = $_POST["firstname"];
                $USER->lastname = $_POST["lastname"];
                $USER->setPass($_POST["password"]);
                $USER->update($conn);
                
                $success = "Les modifications ont bien été appliqués";
            } catch (\Exception $ex) {}
        }else{
            $error = "Des champs ne sont pas valide!";
        }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La pression bordelaise</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/css/common.css">
    <link rel="stylesheet" href="styles/css/auth.css">

    <link rel="stylesheet" href="styles/css/menu/nav.css">
    <link rel="stylesheet" href="styles/css/menu/nav_dark.css">
    <link rel="stylesheet" href="styles/css/menu/header.css">
    <link rel="stylesheet" href="styles/css/menu/m-header.css">

    <link rel="stylesheet" href="styles/css/pages/profil.css">
    <link rel="stylesheet" href="styles/css/footer.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <script src="https://code.createjs.com/1.0.0/createjs.min.js"></script>
    <script src="https://code.createjs.com/1.0.0/tweenjs.min.js"></script>
</head>
<body>
    <?php PAGEHEADER($LANG, $USER, $LANGUAGE, "./", $conn) ?>
    <main>
   
    <div class="container profil">
        <form enctype="multipart/form-data" method="POST" action="">
            <div class="row justify-content-center">
                <div class="col-10 head">
                    <h1 class="title">Vos informations</h1>
                    <?php if($error || $success) { ?>
                        <div class="alert alert-<?php echo ($error ? "danger" : "success")?>" role="alert">
                            <?php echo $error ? $error : $success; ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-md-3 left">
                    <div class="image-user">
                        <img src="<?= "./class/Utils/privateProfileImage.php?id=" . urlencode($USER->getPseudo()); ?>" height="300px" width="300px">
                    </div>
                    <input class="inputfile" name="file" type="file" id="file" accept=".png,.jpg,.jpeg"/>
                    <label for="file">Change image</label>
                </div>
                
                <div class="col-md-7 right">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <label for="firstname">First name</label>
                                        <input type="text" class="form-control<?= getFeedbackClass("firstname") ?>" name="firstname" placeholder="First name" value="<?= getSet('firstname') ?>">
                                        <?php printFeedback("firstname"); ?>
                                </div>
                                <div class="col">
                                    <label for="lastname">Last name</label>
                                    <input type="text" class="form-control <?= getFeedbackClass("lastname") ?>" name="lastname" placeholder="Last name" value="<?= getSet('lastname') ?>">
                                    <?php printFeedback("lastname"); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control <?= getFeedbackClass("email") ?>" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="<?= getSet('email') ?>">
                            <?php printFeedback("email"); ?>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control<?= getFeedbackClass("password") ?>" name="password" placeholder="Password" value="<?= getSet('password') ?>">
                                    <?php printFeedback("password"); ?>
                                </div>
                                <div class="col">
                                    <label for="passwordconfirm">Repeat Password</label>
                                    <input type="password" class="form-control<?= getFeedbackClass("passwordconfirm") ?>" name="passwordconfirm" placeholder="Repeat Password" value="<?= getSet('passwordconfirm') ?>">
                                    <?php printFeedback("passwordconfirm"); ?>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-edit">Modifier</button>
                    
                </div>
            </div>
        </form>
    </div>
    </main>
</body>
</html>