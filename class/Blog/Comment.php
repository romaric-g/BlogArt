<?php 

require_once("Crud.php");

class Comment extends Crud {

    const VALUES = array("DtCreC","PseudoAuteur","EmailAuteur","TitrCom","LibCom","NumArt"); 
    const TABLE = "COMMENT";
    const PRIMARY = "NumCom";

    protected static function getNextID($postVar, $conn) : string
    {  
        $requete = "SELECT MAX(NumCom) AS NumCom FROM COMMENT";
        $result = $conn->query($requete);

        if($result) {
            $tuple = $result->fetch();
            $NumCom = $tuple["NumCom"];
            if(is_null($NumCom)) {
                $NumCom = 0;
            }
            $NumCom++;
            return  (($NumCom < 10 ? '00' : ($NumCom < 100 ? '0' : '') ) . $NumCom);
        }
    }    
}

?>