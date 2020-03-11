<?php 
include "../connection.php";
include "../verifText.php";

if($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["id"])) {
        $languageID = ctrlSaisies($_GET["id"]);
        echo $languageID;
        $req = $conn->exec("DELETE FROM `langue` WHERE `NumLang` = '$languageID'");
    }
}

header("Location: ./../index.php");



?>