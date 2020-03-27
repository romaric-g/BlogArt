<?php
session_start();

require_once("../class/Auth/User.php");
require_once("../class/Utils/ctrlSaisies.php");
require_once("../class/Utils/connection.php");
require_once("../class/Blog/Comment.php");
require_once("../class/Auth/User.php");

$user = User::getLoggedUser();

if($_SERVER["REQUEST_METHOD"] == "GET" && $user) {
    if(isset($_GET["id"])) {
        $NumArt = ctrlSaisies($_GET["id"]);
        
        try {
            $pseudo = $user->getPseudo();
            if(!Comment::hasFakeComToLike($pseudo, $NumArt, $conn)) {
                echo Comment::newFakeComToLike($pseudo, $NumArt, $conn) . ":1";
            }else{
                echo Comment::removeFakeComToLike($pseudo, $NumArt, $conn) . ":0";
            }
        } catch (PDOException $error) {
        }
        
    }
}
?>