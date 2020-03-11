<?php 

function getNextLangueID($numPays, $conn){  
    $numPaysSelect = $numPays;
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

function getLangueList($conn)  {
    $requete = "SELECT * FROM LANGUE WHERE 1";
    return $conn->query($requete);
}
?>