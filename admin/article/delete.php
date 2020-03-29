<?php
session_start();

require("../access.php");
require("../common/layout.php");

require_once("./../../class/Utils/ctrlSaisies.php");
require_once("./../../class/Utils/connection.php");
require_once("./../../class/Blog/Article.php");

if($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["id"])) {
        try {
            $languageID = ctrlSaisies($_GET["id"]);
            $requestKeywords = "DELETE FROM motclearticle WHERE `NumArt` = '$languageID'";
            $requestComments = "DELETE FROM comment WHERE `NumArt` = '$languageID'";
            $request = "DELETE FROM " . Article::TABLE . " WHERE `" . Article::PRIMARY . "` = '$languageID'";
            $req = $conn->exec($requestKeywords);
            $req = $conn->exec($requestComments);
            $req = $conn->exec($request);
            $_SESSION["success"]="Un élement a bien été supprimé";
        } catch (PDOException $error) {
            $_SESSION["error"]=$error;
        }

    }
}
header("Location: index.php");
?>