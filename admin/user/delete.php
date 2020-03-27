<?php
require("../access.php");
require("../common/layout.php");

require_once("./../../class/Utils/ctrlSaisies.php");
require_once("./../../class/Utils/connection.php");
require_once("./../../class/Auth/User.php");

if($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["id"])) {
        try {
            $login = ctrlSaisies($_GET["id"]);
            if($login == $admin->getPseudo()) {
                $_SESSION["error"]="Vous ne pouvez pas supprimer votre propre compte";
            }else{
                $user = new User($login);
                $user->load($conn);
                $user->delete($conn);
                $_SESSION["success"]="L'utilisateur a bien été supprimé";
            }
        } catch (PDOException $error) {
            $_SESSION["error"]=$error;
        }

    }
}
header("Location: index.php");
?>