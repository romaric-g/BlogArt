<?php
session_start();

require_once("./../class/Utils/ctrlSaisies.php");
require_once("./../class/Utils/connection.php");
require_once("./../class/Blog/Comment.php");

if($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["id"])) {
        try {
            $commentID = ctrlSaisies($_GET["id"]);
            $request = "DELETE FROM " . Comment::TABLE . " WHERE `" . Comment::PRIMARY . "` = '$commentID'";
            $req = $conn->exec($request);
            $_SESSION["success"]="Le commentaire a bien été supprimé";
        } catch (PDOException $error) {
            $_SESSION["error"]=$error;
        }

    }
}
header("Location: index.php");
?>