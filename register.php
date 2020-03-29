<?php 
session_start();

require_once("./class/Auth/User.php");
require_once("./class/Utils/connection.php");
require_once("./class/Utils/ctrlSaisies.php");

require_once("./common/home.php");

require_once("./lang/language.php");

$LANG = $_SESSION["LANG"];
$LANGUAGE = Language::INIT($LANG, "./");
$user = User::getLoggedUser();

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
    return ctrlSaisies(isset($_POST[$name]) ? $_POST[$name] : "");
}

if(!$user) {
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
            }else if(User::emailIsUsed($_POST["email"], $conn)) {
                $registerError["email"] = "Adresse email déjà utilisée";
            }

            
        }
        if( !isset($requiredParams["password"]) && !isset($requiredParams["passwordconfirm"]) && $_POST["password"] != $_POST["passwordconfirm"] ) {
            $registerError["passwordconfirm"] = "Les mots de passe ne corresponde pas";
        }
        if(!isset($_POST["conditions"])) {
            $registerError["conditions"] = "Vous devez accepter nos conditions";
        }

        if(empty($registerError)) {
            try {
                $user = User::new($_POST["email"],$_POST["firstname"],$_POST["lastname"],$_POST["password"],$conn);
                $user->connect($_POST["email"],$_POST["password"]);
            } catch (\Exception $ex) {}
        }
    }
}
if($user) {
    header("Location: index.php");
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
    <link rel="stylesheet" href="styles/css/menu/m-home.css">

    <link rel="stylesheet" href="styles/css/footer.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <script src="https://code.createjs.com/1.0.0/createjs.min.js"></script>
    <script src="https://code.createjs.com/1.0.0/tweenjs.min.js"></script>
</head>
<body>
    <?php HOME__($LANG, $user, $LANGUAGE, "./", $conn) ?>
                <div class="container content">
                    <div class="form-box">
                            <h1 class="title">Inscrivez-Vous</h1>
                            <form method="POST" action="">
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
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input is-invalid" type="checkbox" name="conditions" id="gridCheck">
                                        
                                        <label class="form-check-label" for="gridCheck">
                                            J'ai lu et j'accepte les Conditions Générales d'Utilisation et la Politique de Protection des Données Personnelles.
                                        </label>
                                        <?php 
                                            if(isset($registerError["conditions"])) {
                                        ?>
                                            <div class="invalid-feedback"><?= $registerError["conditions"] ?></div>
                                        <?php } ?>

                                    </div>
                                </div>
                                <button type="submit" class="btn btn-inscription">S'inscrire</button>
                                <p class="already-accound">Vous avez déjà un compte ? <br><a href="login.php">Connectez-vous</a></p>
                            </form>
                        </div>
                </div>
    <?php __HOME() ?>
    <?php include "common/footer.php"; ?>
</body>
</html>