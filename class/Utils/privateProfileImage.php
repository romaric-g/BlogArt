<?php
    session_start();

    require_once("./class/Auth/User.php");
    require_once("./class/Utils/connection.php");
    require_once("./class/Utils/ctrlSaisies.php");

    $USER = User::getLoggedUser($conn);

    $img = "assets/avatar.jpg";
    if(!isset($_GET["id"])){
        readfile($img);
        exit();
    }

	if($USER){
        $ext = array("png", "jpg");
        for ($i=0; $i < sizeof($ext); $i++) {
            $fileName = "uploads/". $USER->getPseudo() . "." . $ext[$i];
            if(file_exists ($fileName) ){
                $img = $fileName;
                break;
            }
		}
	}
    readfile($img);
?>
