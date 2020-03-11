<?php
$host = "localhost";
$base = "blogart20";
$user = "root";
$pass = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$base;charset=utf8", $user, $pass);
}
    catch(PDOException $e) {
    echo "Impossible de se connecter!";
}

?>