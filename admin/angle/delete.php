<?php
require("../access.php");
require("../common/layout.php");

require_once("./../../class/Utils/ctrlSaisies.php");
require_once("./../../class/Utils/connection.php");
require_once("./../../class/Blog/Angle.php");

if($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["id"])) {
        try {
            $angleID = ctrlSaisies($_GET["id"]);
            $req = $conn->exec("DELETE FROM " . Angle::TABLE . " WHERE `" . Angle::PRIMARY . "` = '$angleID'");
            $_SESSION["success"]="Un élement a bien été supprimé";
        } catch (PDOException $error) {
            $_SESSION["error"]=$error;
        }

    }
}
header("Location: index.php");
?>