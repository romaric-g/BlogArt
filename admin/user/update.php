<?php 
require("../access.php");
require("../common/layout.php");

require_once("./../../class/Auth/User.php");
require_once("./../../class/Utils/connection.php");
require_once("./../../class/Utils/ctrlSaisies.php");


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
    global $user;
    if($_SERVER["REQUEST_METHOD"] == "GET") {
        switch ($name) {
            case 'email':
                return $user->email;
            case 'firstname':
                return $user->firstname;
            case 'lastname':
                return $user->lastname;
            case 'password':
            case 'passwordconfirm':
                return $user->getPass();
        }
        return "";
    } else{
        return (ctrlSaisies(isset($_POST[$name]) ? $_POST[$name] : ""));
    }
}
$success = NULL;
$error = NULL;
if($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["id"])) {
        $user = new User($_GET["id"]);
        $user->load($conn);
    }
    
} else if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["id"])) {
        $user = new User($_POST["id"]);
        $user->load($conn);

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
            }
        }
        if( !isset($requiredParams["password"]) && !isset($requiredParams["passwordconfirm"]) && $_POST["password"] != $_POST["passwordconfirm"] ) {
            $registerError["passwordconfirm"] = "Les mots de passe ne corresponde pas";
        }

        if(empty($registerError)) {
            try {
                $user->email = $_POST["email"];
                $user->firstname = $_POST["firstname"];
                $user->lastname = $_POST["lastname"];
                $user->setPass($_POST["password"]);
                if($user->getPseudo() != $admin->getPseudo()) {
                    $isAdmin = isset($_POST["admin"]);
                    $user->setAdminToSQL($isAdmin, $conn);
                }
                $user->update($conn);
                
                $success = "Les modifications ont bien été appliqué";
            } catch (\Exception $ex) {}
        }else{
            $error = "Des champs ne sont pas valide!";
        }
    }
}
if(!$user || !$user->loaded) {
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
    <link rel="stylesheet" href="../../styles/css/admin/commons.css">
    <link rel="stylesheet" href="../../styles/css/admin/layout.css">
    <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
</head>
<?php LAYOUT__(); ?>
    <div class="container">
        <h1>Modifier un compte</h1>
        <?php if($error || $success) { ?>
            <div class="alert alert-<?php echo ($error ? "danger" : "success")?>" role="alert">
                <?php echo $error ? $error : $success; ?>
            </div>
        <?php } ?>
        <form method="POST" action="">
                                <input type="hidden" name="id" value="<?= $user->getPseudo() ?>">
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
                                        <input class="form-check-input" type="checkbox" value="admin" name="admin" id="admin" <?= $user->isAdmin() ? "checked" : "" ?>>
                                        <label class="form-check-label" for="admin">
                                            Administrateur
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">Modifier le compte</button>
                                <a href="index.php" class="btn btn-info">Retour</a>   
        </form>
    </div>
<?php __LAYOUT(); ?>