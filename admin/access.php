<?php
session_start();

require_once("../../class/Auth/User.php");
require_once("../../class/Utils/connection.php");
require_once("../../class/Utils/ctrlSaisies.php");

$admin = User::getLoggedUser($conn);

if(!$admin || !$admin->isAdmin()) {
    header("Location: ../index.php");
    exit();
}


?>