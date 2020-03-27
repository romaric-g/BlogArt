<?php
    session_start();

    require_once("./../Auth/User.php");
    require_once("connection.php");
    require_once("ctrlSaisies.php");

    $USER = User::getLoggedUser($conn);

    $img = "./../../assets/images/avatar.jpg";
    if(!isset($_GET["id"])){
        readfile($img);
        exit();
    }

	if($USER && ($USER->getPseudo() == $_GET["id"]) || $USER->isAdmin() ){
        $ext = array("png", "jpg");
        for ($i=0; $i < sizeof($ext); $i++) {
            $fileName = "./../../uploads/". $_GET["id"] . "." . $ext[$i];
            if(file_exists ($fileName) ){
                $img = $fileName;
                break;
            }
		}
	}
    readfile($img);
?>
