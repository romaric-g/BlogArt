<?php
session_start();

require_once("./../../class/Utils/ctrlSaisies.php");
require_once("./../../class/Utils/connection.php");

if($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["id"])) {
        try {
            $languageID = ctrlSaisies($_GET["id"]);
            $req = $conn->exec("DELETE FROM `langue` WHERE `NumLang` = '$languageID'");
            $_SESSION["success"]="Un élement a bien été supprimé";
        } catch (PDOException $error) {
            $_SESSION["error"]=$error;
        }

    }
}
header("Location: index.php");
?>