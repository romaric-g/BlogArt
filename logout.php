<?php
session_start();
require_once("./class/Auth/User.php");
User::loggout();
header("Location: index")
?>