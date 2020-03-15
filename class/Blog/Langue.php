<?php

require_once("Crud.php");

class Langue extends Crud{

    const VALUES = array("Lib1Lang","Lib2Lang","NumPays"); 
    const TABLE = "LANGUE";
    const PRIMARY = "NumLang";

    protected static function getNextID($postVar, $conn) : string
    {  
        $numPaysSelect = ctrlSaisies($postVar["NumPays"]);
        $parmNumLang = $numPaysSelect . '%';
        $requete = "SELECT MAX(NumLang) AS NumLang FROM LANGUE WHERE NumLang LIKE '$parmNumLang';";

        $result = $conn->query($requete);

        if($result) {
            $tuple = $result->fetch();
            $NumLang = $tuple["NumLang"];
            $numSeqLang = 0;
            $StrLang = $numPaysSelect;
            if(!is_null($NumLang)) {
                $StrLang = substr($NumLang, 0, 4);
                $numSeqLang = (int)substr($NumLang, 4);
            }
            $numSeqLang++;
            return $StrLang . ($numSeqLang < 10 ? '0' : '') . $numSeqLang;
        }
    }
}

?>