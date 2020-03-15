<?php

require_once("Crud.php");

class Article extends Crud{

    const VALUES = array("DtCreA","LibTitrA","LibChapoA","LibAccrochA","Parag1A","LibSsTitr1","Parag2A","LibSsTitr2","Parag3A","LibConclA","UrlPhotA",
                         "Likes","NumAngl","NumThem","NumLang"); 
    const TABLE = "ARTICLE";
    const PRIMARY = "NumArt";

    protected static function getNextID($postVar, $conn) : string
    {  
        $requete = "SELECT MAX(NumArt) AS NumArt FROM ARTICLE";
        $result = $conn->query($requete);

        if($result) {
            $tuple = $result->fetch();
            $NumArt = $tuple["NumArt"];
            if(is_null($NumArt)) {
                $NumArt = 0;
            }
            $NumArt++;
            return  (($NumArt < 10 ? '0' : '') . $NumArt);
        }
    }
}

?>