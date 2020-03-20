<?php
session_start();

require_once("./../../class/Utils/ctrlSaisies.php");
require_once("./../../class/Utils/connection.php");
require_once("./../../class/Blog/Article.php");

if($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["id"])) {
        try {
            $languageID = ctrlSaisies($_GET["id"]);
            $request = "DELETE FROM " . Article::TABLE . " WHERE `" . Article::PRIMARY . "` = '$languageID'";
            $req = $conn->exec($request);
            $_SESSION["success"]="Un élement a bien été supprimé";
        } catch (PDOException $error) {
            $_SESSION["error"]=$error;
        }

    }
}
header("Location: index.php");
?>