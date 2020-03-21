<?php
session_start();

var_dump($_SESSION["LANG"]);

require_once("./../class/Blog/Langue.php");
require_once("./../class/Utils/connection.php");

$page = "index.php";
if($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["id"])) {
        $lang = $_GET["id"];
        $langs = Langue::loadAll($conn, array(), "numLang = '$lang'");
        if(!empty($langs)) {
            $_SESSION["LANG"] = $langs[0]->primaryKeyValue;
        }

        if(!isset($_SESSION["LANG"])) {
            $langs = Langue::loadAll($conn);
            $_SESSION["LANG"] = "FRAN01";
        }
    }
}
header("Location: ../index.php");
?>