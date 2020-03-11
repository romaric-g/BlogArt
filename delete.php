<?php
session_start();

include "verifText.php";
include "connection.php";

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