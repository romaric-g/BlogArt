<?php
session_start();

require_once("../class/Auth/User.php");
require_once("../class/Utils/connection.php");
require_once("../class/Utils/ctrlSaisies.php");

$user = User::getLoggedUser($conn);

if(!$user || !$user->isAdmin()) {
    //header("Location: ../index.php");
    exit();
}


?>