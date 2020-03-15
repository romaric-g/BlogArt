<?php
session_start();

require_once("./../class/Utils/ctrlSaisies.php");
require_once("./../class/Utils/connection.php");
require_once("./../class/Blog/Theme.php");

if($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["id"])) {
        try {
            $themeID = ctrlSaisies($_GET["id"]);
            $req = $conn->exec("DELETE FROM " . Theme::TABLE . " WHERE `" . Theme::PRIMARY . "` = '$themeID'");
            $_SESSION["success"]="Un élement a bien été supprimé";
        } catch (PDOException $error) {
            $_SESSION["error"]=$error;
        }

    }
}
header("Location: index.php");
?>