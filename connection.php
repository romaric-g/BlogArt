<?php
$host = "localhost";
$base = "blogart20";
$user = "root";
$pass = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$base;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
    catch(PDOException $e) {
    echo "Impossible de se connecter!";
}
?>