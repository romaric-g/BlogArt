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

        if(empty($registerError)) {
            try {
                $USER->email = $_POST["email"];
                $USER->firstname = $_POST["firstname"];
                $USER->lastname = $_POST["lastname"];
                $USER->setPass($_POST["password"]);
                $USER->update($conn);
                
                $success = "Les modifications ont bien été appliqué";
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
                    <img src="https://www.gravatar.com/avatar/9d7ccc9ba7020ed15feccc1c21846ca5?d=https%3A%2F%2Fwww.cierpgaud.fr%2Fwp-content%2Fuploads%2F2018%2F07%2Favatar.jpg&s=40" height="300px" width="300px">
                </div>
            </div>
            
            <div class="col-md-7 right">
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
                        <button type="submit" class="btn btn-edit">Modifier</button>
                    </form>
            </div>
        </div>
    </div>
    </main>
</body>
</html>